<?php
namespace net\keeko\utils\webform;

class ValidatorFactory {

	/**
	 *
	 * @return net::keeko::utils::webform::Validator
	 */
	public static function createValidator($type) {
		$className = '\\net\\keeko\\utils\\webform\\'.$type.'Validator';

		return new $className();
	}
}
?>
