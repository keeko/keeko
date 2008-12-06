<?php
class Classpath {

	private $paths = array();

	public function __construct() {
		$this->paths[] = '.';
	}

	public function addPath($path) {
		$this->paths[] = $path;
	}

	public function load($className) {
		$fileName = str_replace('\\', '/', $className) . '.php';

		foreach ($this->paths as $path) {
			$pathName = $path . '/' . $fileName;
			if (file_exists($pathName)) {
				return require_once($pathName);
			}
		}
	}
}
?>