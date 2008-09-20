<?php

namespace net::keeko::utils::webform;

class Area {

	private $id;
	private $label;

	private $areas = array();
	private $controls = array();
	
	private $webform;

	public function __construct(Webform $webform, $label = '') {
		$this->webform = $webform;
		$this->id = uniqid('wa');
		$this->label = $label;
	}

	public function addControl(Control $control) {
		if (!in_array($control, $this->controls)) {
			$this->controls[] = $control;			
		}
	}

	public function addArea(Area $area) {
		if (!array_key_exists($area->getId(), $this->areas)) {
			$this->areas[$area->getId()] = $area;
		}
	}
	
	public function getControls() {
		return $this->controls;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getId() {
		return $this->id;
	}

	public function removeArea(Area $area) {
		if (array_key_exists($area->getId(), $this->areas)) {
			unset($this->areas[$area->getId()]);
		}
	}

	public function removeControl(Control $control) {
		$offset = array_search($control, $this->controls);
		if ($offset) {
			unset($this->controls[$offset]);
		}
	}
	
	public function setWebform(Webform $webform) {
		$this->webform = $webform;
	}
	
	public function setId($id) {
		$this->id = $id;
	}

	public function toXml() {
		$xml = new DOMDocument();
		$root = $xml->createElement('area');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);

		foreach($this->areas as $area) {
			$import = $xml->importNode($area->toXml()->documentElement, true);
			$root->appendChild($import);
		}

		foreach($this->controls as $control) {
			$import = $xml->importNode($control->toXml()->documentElement, true);
			$root->appendChild($import);
		}

		$xml->appendChild($root);

		return $xml;
	}

	/**
	 * 
	 * @throws WebformException
	 */
	public function validate() {
		$e = new WebformException();
		foreach ($this->areas as $area) {
			try {
				$area->validate();
			} catch (WebformException $ex) {
				$e->addErrors($ex->getErrors());
			}
		}

		foreach ($this->controls as $control) {
			try {
				$control->validate();
			} catch (WebformException $ex) {
				$e->addErrors($ex->getErrors());
			}
		}

		if ($e->size()) {
			throw $e;
		}
	}
}
?>