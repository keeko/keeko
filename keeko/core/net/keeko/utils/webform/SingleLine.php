<?php
namespace net\keeko\utils\webform;

class SingleLine extends Control {

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('error', $this->error ? 'yes' : 'no');
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('type', 'SingleLine');
		$root->setAttribute('value', $this->getRequestValue() == null ? $this->default : $this->getRequestValue());
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');
		$root->setAttribute('readonly', $this->readonly ? 'yes' : 'no');

		$xml->appendChild($root);
		$this->appendValidators($xml);

		return $xml;
	}
}
?>