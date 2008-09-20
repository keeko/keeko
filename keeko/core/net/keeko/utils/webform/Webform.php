<?php
namespace net::keeko::utils::webform;

class Webform {

	const POST = 'post';
	const GET = 'get';

	private $target;
	private $method = Webform::POST;
	private $areas = array();
	private $lang;
	private $i18n = null;
	private $template = 'net/keeko/utils/webform/templates/webform.xsl';

	public function __construct($lang = 'en') {
		$this->lang = $lang;
		$this->loadLanguage();
	}

	public function addArea(Area $area) {
		if (!array_key_exists($area->getId(), $this->areas)) {
			$this->areas[$area->getId()] = $area;
		}
	}
	
	public function removeArea(Area $area) {
		if ($offset = array_search($area, $this->areas)) {
			unset($this->areas[$offset]);
		}
	}

	public function getI18n($path) {
		if (!is_null($this->i18n)) {
			$xpath = new DOMXPath($this->i18n);
			$entries = $xpath->query($path, $this->i18n->documentElement);
			if ($entries->length) {
				return $entries->item(0)->nodeValue;
			}
		}
	}

	public function getMethod() {
		return $this->method;
	}
	
	public function getTarget() {
		return $this->target;
	}

	private function loadLanguage() {
		$langFile = sprintf('%s/i18n/%s.xml', dirname(__FILE__), $this->lang);
		if (file_exists($langFile)) {
			$this->i18n = new DOMDocument();
			$this->i18n->load($langFile);
		}
	}

	public function setMethod($method) {
		$this->method = $method;
	}

	public function setTarget($target) {
		$this->target = $target;
	}

	public function toXml() {
		$xml = new DOMDocument();
		$root = $xml->createElement('webform');
		$root->setAttribute('target', $this->target);
		$root->setAttribute('method', $this->method);

		foreach($this->areas as $area) {
			$import = $xml->importNode($area->toXml()->documentElement, true);
			$root->appendChild($import);
		}

		$xml->appendChild($root);
		return $xml;
	}
	
	public static function parseXML($filePath) {
		if (file_exists($filePath)) {
			$doc = new DOMDocument();
			$doc->load($filePath);
			return Webform::parseXMLDoc($doc);
		}
	}
	
	public static function parseXMLDoc(DOMDocument $doc) {
		return Webform::parseXMLNode($doc->documentElement);
	}
	
	/**
	 * Parsing a given tree by passing the root node.
	 * 
	 * @return Webform
	 */
	public static function parseXMLNode(DOMNode $node) {
		$parser = new Parser($node);
		return $parser->parse();	
	}

	/**
	 * 
	 * @throws WebformException
	 */
	public function validate() {
		$e = new WebformException();
		foreach ($this->areas as $area) {
			try {
				$area->validate();
			} catch (WebformException $ex) {
				$e->addErrors($ex->getErrors());
			}
		}

		if ($e->size()) {
			throw $e;
		}
	}
}
?>