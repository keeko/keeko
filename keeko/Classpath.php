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
		$dirName = str_replace('\\', '/', $className);
		$fileName = $dirName . '.php';


		foreach ($this->paths as $path) {
			$pathFileName = $path . '/' . $fileName;
			if (file_exists($pathFileName)) {
				return require_once($pathFileName);
			}

//			$pathDirName = $path . '/' . $dirName;
//			if (is_dir($pathDirName)) {
//				echo 'added: ' . $pathDirName;
//				return $this->addPath($pathDirName);
//			}
		}
	}
}
?>