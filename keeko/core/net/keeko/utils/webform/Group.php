<?php
namespace net\keeko\utils\webform;

class Group extends Control {

	const HORIZONTAL = 'horizontal';
	const VERTICAL = 'vertical';

	private $direction = Group::HORIZONTAL;
	private $controls = array();

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function addControl(Control $control) {
		if (!in_array($control, $this->controls)) {
			$this->controls[] = $control;
		}
	}

	public function setDirection($direction) {
		$this->direction = $direction;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('type', 'Group');
		$root->setAttribute('direction', $this->direction);

		foreach($this->controls as $control) {
			$import = $xml->importNode($control->toXml()->documentElement, true);
			$root->appendChild($import);
		}

		$xml->appendChild($root);

		return $xml;
	}
}
?>