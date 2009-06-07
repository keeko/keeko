<?php

namespace net\keeko\utils\webform;

abstract class Custom extends Control {

	public function __construct(Webform $webform) {
		parent::__construct($webform);
	}

	public abstract function getStyleSheet();
}
?>