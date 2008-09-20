<?php
namespace net::keeko::cms::core;
 *
 * @package net.keeko.core

	protected $module;

	protected $page;

	protected $xml;

	protected $name;
		$this->page = KeekoRuntime::getInstance()->getPage();

		$this->xml = new DOMDocument('1.0', 'utf-8');
		$action = $this->xml->createElement('action');
		$this->xml->appendChild($action);
	}


	public function setName($name) {
		$this->name = $name;
		$this->xml->documentElement->setAttribute('name', $name);
	}

		$this->module = $module;
		$this->xml->documentElement->setAttribute('module', $this->module->getUnixname());
	}
}