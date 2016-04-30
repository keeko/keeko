<?php
namespace keeko\keeko;

use Composer\IO\NullIO;

class WebIO extends NullIO {

	/**
	 * {@inheritDoc}
	 */
	public function write($messages, $newline = true, $verbosity = self::NORMAL) {
		echo $messages;
		if ($newline) {
			echo '<br>';
		}
	}
}