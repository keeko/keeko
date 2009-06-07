<?php
namespace net\keeko\cms\utils;

use net\keeko\cms\core\KeekoRuntime;
use net\keeko\utils\webform\Webform;

class KeekoWebform extends Webform {

	public function __construct($addTemplate = true, $addI18n = true) {
		$lang = KeekoRuntime::getInterfaceLanguage();
		parent::__construct($lang);

		if ($addTemplate) {
			KeekoRuntime::getRenderer()->addStyleSheet($this->getTemplate());
		}

		if ($addI18n) {
			KeekoRuntime::addI18n($this->getI18nFile());
		}
	}

	public function getTemplate() {
		if ($this->template === null) {
			return KEEKO_PATH_CORE.'net/keeko/utils/webform/templates/webform.xsl';
		} else {
			return $this->template;
		}
	}

	public static function parseXML($filePath, $i18n) {
		if (file_exists($filePath)) {
			$doc = new \DOMDocument();
			$doc->load($filePath);
			return KeekoWebform::parseXMLDoc($doc, $i18n);
		}
	}

	public static function parseXMLDoc(\DOMDocument $doc, $i18n) {
		return KeekoWebform::parseXMLNode($doc->documentElement, $i18n);
	}

	public static function parseXMLNode(\DOMNode $node, $i18n) {
		$parser = new KeekoWebformParser($node, $i18n);
		return $parser->parse();
	}
}
?>