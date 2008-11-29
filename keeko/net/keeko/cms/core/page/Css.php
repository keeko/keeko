<?php
namespace net::keeko::cms::core::page;
 * 
 * @package net.keeko.core
 * @subpackage page
	/**
			$before = sprintf("@import url('%s') %s;\n", $this->href, 
				$this->media);
			$this->content = trim($before . $this->content);
		}
		$this->xml = new DOMDocument();
		$content = $this->xml->createCDATASection($this->content);
		$css = $this->xml->createElement('style');
		$css->setAttribute('type', 'text/css');
		$css->appendChild($content);
		$this->xml->appendChild($css);