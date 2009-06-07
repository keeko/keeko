<?php
namespace net\keeko\cms\utils;

use net\keeko\utils\webform\Parser;

class KeekoWebformParser extends Parser {

	private $i18n;

	public function __construct(\DOMNode $node, $i18n) {
		parent::__construct($node);
		$this->i18n = new I18nHelper();
		$this->i18n->load($i18n);
	}

	protected function getWebform() {
		return new KeekoWebform();
	}

	protected function getText($value) {
		if (\is_numeric($value)) {
			return $value;
		}
		return $this->i18n->query($value);
	}
}
?>