<?php
namespace net::keeko::utils::webform;

abstract class Validator {

	protected $control;
	protected $webform;

	public function setControl(Control $control) {
		$this->control = $control;
		$this->webform = $control->getWebform();
	}

	abstract public function parse(DOMNode $node);
	abstract public function validate($string);
}
?>