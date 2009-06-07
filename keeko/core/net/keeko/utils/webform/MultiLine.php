<?php
namespace net\keeko\utils\webform;

class MultiLine extends Control {

	private $rows = 3;

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function setRows($rows) {
		$this->rows = $rows;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('type', 'MultiLine');
		$root->setAttribute('error', $this->error ? 'yes' : 'no');
		$root->setAttribute('value', $this->getRequestValue() == null ? $this->default : $this->getRequestValue());
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');
		$root->setAttribute('readonly', $this->readonly ? 'yes' : 'no');
		$root->setAttribute('rows', $this->rows);

		$xml->appendChild($root);

		return $xml;
	}
}
?>