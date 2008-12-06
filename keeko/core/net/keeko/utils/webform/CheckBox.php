<?php
namespace net::keeko::utils::webform;

class CheckBox extends Control {

	private $checked = false;

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public function setChecked($checked) {
		$this->checked = $checked;
	}

	public function toXml() {
		$value = $this->getRequestValue() == null ? $this->default : $this->getRequestValue();

		$r = null;
		switch ($this->getWebform()->getMethod()) {
			case Webform::GET:
				$r = &$_GET;
				break;

			case Webform::POST:
				$r = &$_POST;
				break;
		}

		// see wether this CheckBox is checked by a passed formular

		// means array
		if (substr($this->name, -2) == '[]') {
			$name = substr($this->name, 0, -2);

			if (isset($r[$name]) && in_array($value, $r[$name])) {
				$this->checked = true;
			}
		}

		// anyway natural
		else {
			if (isset($r[$this->name]) && $r[$this->name] == $value) {
				$this->checked = true;
			}
		}

		$xml = new DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->name);
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('value', $value);
		$root->setAttribute('type', 'CheckBox');
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');
		$root->setAttribute('checked', $this->checked ? 'yes' : 'no');

		$xml->appendChild($root);

		return $xml;
	}
}
?>
