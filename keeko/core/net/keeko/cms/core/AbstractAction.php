<?php
namespace net\keeko\cms\core;
 *
 * @package net.keeko.core

	protected $module;

	protected $page;

	protected $xml;

	protected $name;

	protected $descriptor;
		$this->page = KeekoRuntime::getPage();

		$this->xml = new \DOMDocument('1.0', 'utf-8');
		$action = $this->xml->createElement('action');
		$this->xml->appendChild($action);
	}


	public function setDescriptor(ActionDescriptor $descriptor) {
		$this->descriptor = $descriptor;
	}
		return $this->descriptor->getXSL();
	}

	public function getModule() {
		return $this->module;
	}

	protected function getFile($path) {
		return sprintf('%s/%s/%s', KEEKO_PATH_MODULES, $this->getModule()->getUnixname(), $path);
	}

	protected function getI18nFile($path) {
		return sprintf('%s/%s/i18n/%s/%s', KEEKO_PATH_MODULES, $this->getModule()->getUnixname(), KeekoRuntime::getInterfaceLanguage(), $path);
	}

	public function setName($name) {
		$this->name = $name;
		$this->xml->documentElement->setAttribute('name', $name);
	}

		$this->module = $module;
		$this->xml->documentElement->setAttribute('module', $this->module->getUnixname());
	}

	public function toXML() {
		return $this->xml;
	}
}