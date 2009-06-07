<?php
namespace net\keeko\utils\webform;

class ControlFactory {

	/**
	 *
	 * @return \net\keeko\utils\webform\Control
	 */
	public static function createControl($type, $form) {
		$className = '\\net\\keeko\\utils\\webform\\'.$type;
		return new $className($form);
	}
}
?>