<?php
namespace net\keeko\utils\webform;

class Hidden extends Control {

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('value', $this->default);
		$root->setAttribute('name', $this->name);
		$root->setAttribute('type', 'Hidden');

		$xml->appendChild($root);

		return $xml;
	}
}
?>