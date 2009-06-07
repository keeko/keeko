<?php
namespace net\keeko\cms\utils;

class JSONResponse {
	const ERROR_UNKNOWN = '0';
	const ERROR_PARAMS = '1';

	private $error = null;
	private $json = array();

	public function __construct() {

	}

	public function setError($code) {
		$this->error = $code;
	}

	public function addJson(\DOMDocument $jsonDoc) {
		if (!in_array($jsonDoc, $this->json)) {
			$this->json[] = $jsonDoc;
		}
	}

	public function appendTo(\DOMNode $node) {
		$doc = $node->ownerDocument;

		if ($this->error != null) {
			$error = $doc->createElement('error');
			$error->setAttribute('code', $this->error);
			$node->appendChild($error);
		}

		$json = $doc->createElement('json');
		foreach ($this->json as $j) {
			$jsonNode = $doc->importNode($j->documentElement, true);
			$json->appendChild($jsonNode);
		}
		$node->appendChild($json);
	}
}
?>