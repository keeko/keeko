<?php
namespace net::keeko::cms::core::page;
 * 
 * @package net.keeko.core
 * @subpackage page
	public function __construct() {}
		
		if (!is_null($this->content)) {
			$this->content = sprintf("\n%s\n", $this->content);
		}

		$script = $this->xml->createElement('script', $this->content);
		$script->setAttribute('type', 'text/javascript');
		if ($this->src) {
			$script->setAttribute('src', $this->src);
		}
		$this->xml->appendChild($script);