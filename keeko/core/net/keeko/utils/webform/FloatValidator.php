<?php
namespace net::keeko::utils::webform;

class FloatValidator extends Validator {

	public function validate($string) {
		if (!is_numeric($string)) {
			throw new WebformException(sprintf($this->webform->getI18n('error/invalid'), $this->control->getLabel()));
		}
	}
	
	public function parse(DOMNode $node) {
		
	}
}
?>