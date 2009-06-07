<?php
namespace net\keeko\cms\utils;

use net\keeko\cms\core\KeekoRuntime;
use net\keeko\cms\core\KeekoException;

class I18nHelper {
	private $dom;

	public function __construct() {

	}

	public function load($filepath) {
		if (file_exists($filepath)) {
			$this->dom = new \DOMDocument();
			$this->dom->load($filepath);
		} else {
			throw new KeekoException('File not Found: ' . $filepath);
		}
	}

	public function loadModuleI18nByAction(\net\keeko\cms\core\AbstractAction $action, $file) {
		$filepath = sprintf('%s/%s/i18n/%s/%s',
			KEEKO_PATH_MODULES,
			$action->getModule()->getUnixname(),
			KeekoRuntime::getInterfaceLanguage(),
			$file);

		$this->load($filepath);
	}

	public function query($query) {
		$xpath = new \DOMXPath($this->dom);
		$items = $xpath->query($query);

		if (!is_null($items)) {
			return $items->item(0)->nodeValue;
		}

		return null;
	}
}
?>