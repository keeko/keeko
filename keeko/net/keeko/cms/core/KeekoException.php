<?php
namespace net::keeko::cms::core;
/**
 * blabla
 * 
 * @package net.keeko.core
 */


/**
 * Keeko Exception
 *
 * @package net.keeko.core
 */
class KeekoException extends ::Exception {

	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}

	public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
?>