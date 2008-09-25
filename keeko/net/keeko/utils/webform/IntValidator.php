<?php
namespace net::keeko::utils::webform;

class IntValidator extends Validator {

	public function validate($string) {
		if (preg_match('/\D/', $string)) {
			throw new WebformException(sprintf($this->webform->getI18n('error/invalid'), $this->control->getLabel()));
		}
	}
	
	public function parse(DOMNode $node) {
		
	}
}
?>