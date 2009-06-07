<?php
namespace net\keeko\utils\wizard;

class Step {

	private $id;
	private $title;
	private $description;
	private $required = true;
	private $active = false;

	private $wizard;
	private $area;

	public function __construct(Wizard $wizard, $id) {
		$this->wizard = $wizard;
		$this->area = new \net\keeko\utils\webform\Area($wizard->getWebform());
		$this->id = $id;
	}

	public function getArea() {
		return $this->area;
	}

	public function getId() {
		return $this->id;
	}

	public function isActive() {
		return $this->active;
	}

	public function isRequired() {
		return $this->required;
	}

	public function setRequired($required) {
		$this->required = $required;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function addControl(\net\keeko\utils\webform\Control $control) {
		$this->area->addControl($control);
	}

	public function addArea(\net\keeko\utils\webform\Area $area) {
		$this->area->addArea($area);
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('step');
		$root->setAttribute('title', $this->title);
		$root->setAttribute('description', $this->description);
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('active', $this->active ? 'yes' : 'no');

		$imported = $xml->importNode($this->area->toXml()->documentElement, true);
		$root->appendChild($imported);

		$xml->appendChild($root);

		return $xml;
	}

	/* For extending the step */
	public function canFinish() {
		return null;
	}

	public function getNextStep() {
		return null;
	}

	public function getPreviousStep() {
		return null;
	}

}
?>