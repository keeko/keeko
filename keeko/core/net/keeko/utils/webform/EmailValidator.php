<?php
namespace net::keeko::utils::webform;

class EmailValidator extends Validator {

	public function validate($string) {
		if (!preg_match('/(([a-z0-9_\-\.])+@([a-z0-9\-]\.?)+(\.[a-z]{2,4})+)/i', $string)) {
			throw new WebformException(sprintf($this->webform->getI18n('error/invalid'), $this->control->getLabel()));
		}
	}
	
	public function parse(DOMNode $node) {
		
	}
}
?>