<?php
namespace net\keeko\utils\webform;

class Webform {

	const POST = 'post';
	const GET = 'get';

	private $target;
	private $method = Webform::POST;
	private $areas = array();
	private $lang;
	private $i18n = null;
	private $i18nFile = null;
	private $errors = null;
	protected $template = null;
	private $controls = Array();

	public function __construct($lang = 'en') {
		$this->lang = $lang;
		$this->loadLanguage();
	}

	public function addArea(Area $area) {
		if (!\array_key_exists($area->getId(), $this->areas)) {
			$this->areas[$area->getId()] = $area;
		}
	}

	public function removeArea(Area $area) {
		if ($offset = array_search($area, $this->areas)) {
			unset($this->areas[$offset]);
		}
	}

	public function getArea($id) {
		if (\array_key_exists($id, $this->areas)) {
			return $this->areas[$id];
		}
		return null;
	}

	public function getI18n($path) {
		if (!is_null($this->i18n)) {
			$xpath = new \DOMXPath($this->i18n);
			$entries = $xpath->query($path, $this->i18n->documentElement);
			if ($entries->length) {
				return $entries->item(0)->nodeValue;
			}
		}
	}

	public function getI18nFile() {
		if (is_null($this->i18nFile)) {
			$this->i18nFile = sprintf('%s/i18n/%s.xml', dirname(__FILE__), $this->lang);
		}
		return $this->i18nFile;
	}

	public function getMethod() {
		return $this->method;
	}

	public function getTarget() {
		return $this->target;
	}

	public function getTemplate() {
		// get default template
		if ($this->template === null) {
			return dirname(__FILE__).'/templates/webform.xsl';
		} else {
			return $this->template;
		}
	}

	private function loadLanguage() {
		$langFile = $this->getI18nFile();
		if (file_exists($langFile)) {
			$this->i18n = new \DOMDocument();
			$this->i18n->load($langFile);
		}
	}

	public function setErrors(WebformException $e) {
		$this->errors = $e;
	}

	public function setMethod($method) {
		$this->method = $method;
	}

	public function setTarget($target) {
		$this->target = $target;
	}

	public function setTemplate($template) {
		$this->template = $template;
	}

	public function registerControl($id, Control $control) {
		if (\array_key_exists($id, $this->controls)) {
			throw WebformException('Control with given id ('+$id+') already exists in this Webform');
		}
		$this->controls[$id] = $control;
	}

	public function updateControlRegistration($oldId, $newId, $control) {
		if (!\array_key_exists($oldId, $this->controls)) {
			throw WebformException('Control with given id ('+$oldId+') does not exists in this Webform');
		}
		unset($this->controls[$oldId]);
		$this->controls[$newId] = $control;
	}

	public function getControl($id) {
		if (\array_key_exists($id, $this->controls)) {
			return $this->controls[$id];
		}
		return null;
	}

	public function toXml() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('webform');
		$root->setAttribute('target', $this->target);
		$root->setAttribute('method', $this->method);

		if (!is_null($this->errors)) {
			$root->appendChild($xml->importNode($this->errors->toXml()->documentElement, true));
		}

		foreach($this->areas as $area) {
			$root->appendChild($xml->importNode($area->toXml()->documentElement, true));
		}

		$xml->appendChild($root);
		return $xml;
	}

	public static function parseXML($filePath) {
		if (file_exists($filePath)) {
			$doc = new \DOMDocument();
			$doc->load($filePath);
			return Webform::parseXMLDoc($doc);
		}
	}

	public static function parseXMLDoc(\DOMDocument $doc) {
		return Webform::parseXMLNode($doc->documentElement);
	}

	/**
	 * Parsing a given tree by passing the root node.
	 *
	 * @return Webform
	 */
	public static function parseXMLNode(\DOMNode $node) {
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