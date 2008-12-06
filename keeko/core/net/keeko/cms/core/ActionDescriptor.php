<?php
namespace net\keeko\cms\core;

use net\keeko\cms\core\page\Css;
use net\keeko\cms\core\page\JavaScript;

/**
 * Class for describing action of Keeko modules
 *
 * @package net.keeko.core
 */
class ActionDescriptor {

	private $css = array();
	private $js = array();
	private $i18n = array();
	private $className;
	private $xsl;

	public function __construct() {

	}

	public function getClassName() {
		return $this->className;
	}

	public function setXSL($xsl) {
		$this->xsl = $xsl;
	}

	public function getXSL() {
		return $this->xsl;
	}

	public function setClassName($className) {
		$this->className = $className;
	}

	public function addCss($file, $media) {
		$this->css[] = array($file, $media);
	}

	public function addJs($file) {
		$this->js[] = $file;
	}

	public function addI18n($file) {
		$this->i18n[] = $file;
	}

	/**
	 * This method applies all values to Keekos context. This will add css, js
	 * and js files to KeekoRuntime
	 *
	 */
	public function apply() {
		$page = KeekoRuntime::getPage();

		foreach ($this->css as $c) {
			$css = new Css();
			$css->setHref($c[0]);
			if ($c[1]) {
				$css->setMedia($c[1]);
			}
			$page->addHeadElement($css);
		}

		foreach ($this->js as $j) {
			$js = new Javascript();
			$js->setSrc($j);
			$page->addHeadElement($js);
		}

		foreach($this->i18n as $i18n) {
			KeekoRuntime::addI18n($i18n);
		}
	}
}
?>