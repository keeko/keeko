<?php
namespace net::keeko::utils::webform;

class Submit extends Control {
	
	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function toXml() {
		$xml = new DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->name);
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('type', 'Submit');
		$root->setAttribute('value', $this->default);
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');

		$xml->appendChild($root);

		return $xml;
	}
}
?>