<?php
namespace net\keeko\utils\webform;

class Option {

	private $value;
	private $label;
	private $checked;

	public function __construct() {
	}

	public function setChecked($checked) {
		$this->checked = $checked;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function setValue($val) {
		$this->value = $val;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('option');
		$root->setAttribute('label', $this->label);
		$root->setAttribute('value', $this->value);
		$root->setAttribute('checked', $this->checked ? 'yes' : 'no');

		$xml->appendChild($root);

		return $xml;
	}
}
?>