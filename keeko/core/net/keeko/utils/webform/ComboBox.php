<?php
namespace net\keeko\utils\webform;

class ComboBox extends Control {

	private $options = array();

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function addOption($value, $label, $checked = false) {
		// by incoming request
		$val = $this->getRequestValue();
		if ($val != null && $val == $value) {
			$checked = true;
		} else if ($val != null && $val != $value) {
			$checked = false;
		}

		$option = new Option();
		$option->setValue($value);
		$option->setLabel($label);
		$option->setChecked($checked);
		$this->options[] = $option;

		return $option;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('type', 'ComboBox');
		$root->setAttribute('error', $this->error ? 'yes' : 'no');
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');

		foreach($this->options as $option) {
			$import = $xml->importNode($option->toXml()->documentElement, true);
			$root->appendChild($import);
		}

		$xml->appendChild($root);

		return $xml;
	}
}
?>