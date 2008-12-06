<?php
namespace net::keeko::utils::webform;

class Radio extends Control {
	
	private $checked = false;
	
	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}
	
	public function setChecked($checked) {
		$this->checked = $checked;
	}
	
	public function toXml() {
		$r = null;
		switch ($this->getWebform()->getMethod()) {
			case Webform::GET:
				$r = &$_GET;
				break;

			case Webform::POST:
				$r = &$_POST;
				break;
		}
		
		if (isset($r[$this->name]) && $r[$this->name] == $this->default) {
			$this->checked = true;
		}
		
		$xml = new DOMDocument();
		$root = $xml->createElement('control');
		$root->setAttribute('id', $this->id);
		$root->setAttribute('label', $this->label);
		$root->setAttribute('name', $this->name);
		$root->setAttribute('description', $this->description);
		$root->setAttribute('title', $this->title);
		$root->setAttribute('value', $this->default);
		$root->setAttribute('type', 'Radio');
		$root->setAttribute('required', $this->required ? 'yes' : 'no');
		$root->setAttribute('disabled', $this->disabled ? 'yes' : 'no');
		$root->setAttribute('checked', $this->checked ? 'yes' : 'no');

		$xml->appendChild($root);

		return $xml;
	}
}
?>