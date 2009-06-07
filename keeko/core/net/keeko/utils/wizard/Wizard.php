<?php
namespace net\keeko\utils\wizard;

use net\keeko\utils\webform\Webform;
use net\keeko\utils\webform\Area;
use net\keeko\utils\webform\Submit;
use net\keeko\utils\webform\Hidden;
use net\keeko\utils\webform\WebformException;

class Wizard {

	// setup
	private $title;
	private $description;
	private $steps = array();
	private $stepsMap = array();

	// evalutaion & controlling
	private $currentStep;
	private $currentStepOffset = null;
	private $error = null;

	// controls
	private $webform;
	private $buttonBar;
	private $backButton;
	private $nextButton;
	private $finishButton;
	private $cancelButton;

	// settings
	private $template = null;
	private $lang;
	private $i18n = null;

	public function __construct($lang = 'en') {
//		session_start();
		if (!isset($_SESSION['wizard'])) {
			$_SESSION['wizard'] = array('step' => array());
		}
		$this->lang = $lang;
		$this->loadLanguage();

		$this->webform = new Webform($lang);

		$this->buttonBar = new Area($this->webform);
		$this->buttonBar->setId('wizardButtonBar');
		$this->webform->addArea($this->buttonBar);

		$this->backButton = new Submit($this->webform);
		$this->backButton->setName('wizard_go');
		$this->backButton->setDefault($this->getI18n('labels/back'));

		$this->nextButton = clone $this->backButton;
		$this->nextButton->setDefault($this->getI18n('labels/next'));

		$this->finishButton = clone $this->backButton;
		$this->finishButton->setDefault($this->getI18n('labels/finish'));

		$this->cancelButton = clone $this->backButton;
		$this->cancelButton->setDefault($this->getI18n('labels/cancel'));

		$this->buttonBar->addControl($this->backButton);
		$this->buttonBar->addControl($this->nextButton);
		$this->buttonBar->addControl($this->finishButton);
		$this->buttonBar->addControl($this->cancelButton);
	}

	public function getI18n($path) {
		if (!is_null($this->i18n)) {
			$xpath = new \DOMXPath($this->i18n);
			$entries = $xpath->query($path, $this->i18n->documentElement);
			if ($entries->length) {
				return $entries->item(0)->nodeValue;
			}
		}
	}

	private function loadLanguage() {
		$langFile = sprintf('%s/i18n/%s.xml', dirname(__FILE__), $this->lang);
		if (file_exists($langFile)) {
			$this->i18n = new \DOMDocument();
			$this->i18n->load($langFile);
		}
	}

	public function getTemplate() {
		// get default template
		if ($this->template === null) {
			return dirname(__FILE__).'/templates/wizard.xsl';
		} else {
			return $this->template;
		}
	}

	/**
	 *
	 * @return net\keeko\utils\webform\Webform
	 */
	public function getWebform() {
		return $this->webform;
	}

	public function setTarget($target) {
		$this->webform->setTarget($target);
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function addStep(Step $step) {
		if (!in_array($step, $this->steps)) {
			$this->steps[] = $step;
			$this->stepsMap[$step->getId()] = count($this->steps) - 1;
		}
	}

	public function getStep($id) {
		if (array_key_exists($id, $this->stepsMap)) {
			return $this->steps[$this->stepsMap[$id]];
		}
		return null;
	}

	public function run() {
		if (isset($_REQUEST['wizard_step'])) {
			$this->currentStepOffset = $_REQUEST['wizard_step'];
		} else {
			$this->currentStepOffset = 0;
		}

		// special steps
		switch($this->currentStepOffset) {
			case 'finish':
				$this->performFinish();
				return;

			case 'cancel':
				$this->performCancel();
				return;
		}

		// evaluating previous, current and next step
		if ($this->currentStepOffset !== null && count($this->steps)) {
			$this->currentStep = $this->steps[$this->currentStepOffset];
			$this->currentStep->setActive(true);

			if (isset($_SESSION['wizard']['step'][$this->currentStepOffset])) {
				$controls = $this->currentStep->getArea()->getControls();
				foreach ($controls as $control) {
					$control->setDefault($_SESSION['wizard']['step'][$this->currentStepOffset][$control->getName()]);
				}
			}
		}

		//$fromStep = null;
		$prevStep = $this->currentStepOffset - 1;
		$nextStep = null;
		if ($this->currentStepOffset == count($this->steps) - 1) {
			$nextStep = 'finish';
		} else {
			$nextStep = $this->currentStepOffset + 1;
		}

		$stepButton = new Hidden($this->webform);
		$stepButton->setName('wizard_step');
		$stepButton->setDefault($this->currentStepOffset);
		$this->buttonBar->addControl($stepButton);

		// setting buttons enabled...
		if ($nextStep == 'finish') {
			$this->nextButton->setDisabled(true);
		}

		if ($this->currentStepOffset == 0) {
			$this->backButton->setDisabled(true);
		}

		if (is_numeric($nextStep) && $this->steps[$nextStep]->isRequired()) {
			$this->finishButton->setDisabled(true);
		}

		try {
			if (isset($_REQUEST['wizard_go'])) {
				switch ($_REQUEST['wizard_go']) {
					case $this->getI18n('labels/back'):
						if (!isset($_REQUEST['wizard_error'])) {
							$this->storeData();
							$this->webform->addArea($this->currentStep->getArea());
							$this->webform->validate();
						}
						$this->goToStep($prevStep);
						break;

					case $this->getI18n('labels/next'):
						$this->storeData();
						$this->webform->addArea($this->currentStep->getArea());
						$this->webform->validate();
						$this->goToStep($nextStep);
						break;

					case $this->getI18n('labels/finish'):
						$this->storeData();
						$this->webform->addArea($this->currentStep->getArea());
						$this->webform->validate();
						$this->goToStep('finish');
						break;

					case $this->getI18n('labels/cancel'):
						$this->goToStep('cancel');
						break;
				}
			}
		} catch(WebformException $e) {
			$stepButton->setDefault($this->currentStepOffset + 1);
			$error = new Hidden($this->webform);
			$error->setName('wizard_error');
			$error->setDefault('yes');
			$this->buttonBar->addControl($error);

			$this->backButton->setDisabled(false);
			$this->nextButton->setDisabled(true);
			$this->finishButton->setDisabled(true);
			$this->cancelButton->setDisabled(false);

			$this->error = $e;
		}
	}

	private function storeData() {
		$controls = $this->currentStep->getArea()->getControls();

		if (!isset($_SESSION['wizard']['step'][$this->currentStepOffset])) {
			$_SESSION['wizard']['step'][$this->currentStepOffset] = array();
		}
		foreach ($controls as $control) {
			$_SESSION['wizard']['step'][$this->currentStepOffset][$control->getName()] = $control->getRequestValue();
		}
	}

	private function goToStep($step) {
		$location = $this->webform->getTarget();
		if (strstr($location, '?')) {
			$location .= '&wizard_step='.$step;
		} else {
			$location .= '?wizard_step='.$step;
		}
		$uri = $_SERVER['HTTP_HOST'];
		if (!strstr($location, dirname($_SERVER['PHP_SELF']))) {
			$uri .= dirname($_SERVER['PHP_SELF']);
		}
		$uri = str_replace('//', '/', $uri . '/' . $location);

		header('location: http://' . $uri);
		exit;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('wizard');
		$root->setAttribute('title', $this->title);
		$root->setAttribute('description', $this->description);

		$webform = $xml->importNode($this->webform->toXml()->documentElement, true);

		foreach ($this->steps as $step) {
			$imported = $xml->importNode($step->toXml()->documentElement, true);
			$webform->appendChild($imported);
		}

		if ($this->error !== null) {
			$e = $xml->importNode($this->error->toXml()->documentElement, true);
			$webform->appendChild($e);
		}

		$root->appendChild($webform);
		$xml->appendChild($root);

		return $xml;
	}

	/**
	 * For extending the wizard
	 */
	protected function canFinish() {
		return $this->currentStep->canFinish();
	}

	protected function performFinish() {

	}

	protected function performCancel() {

	}
}
?>