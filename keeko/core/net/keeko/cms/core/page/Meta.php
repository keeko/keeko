<?php
namespace net\keeko\cms\core\page;
 *
 * @package net.keeko.core
 * @subpackage page

		$this->httpEquiv = $httpEquiv;
		$meta = $this->xml->createElement('meta');
		$this->xml->appendChild($meta);

		if (!empty($this->name)) {
			$meta->setAttribute('name', $this->name);
		}

		if (!empty($this->httpEquiv)) {
			$meta->setAttribute('http-equiv', $this->httpEquiv);
		}

		if (!empty($this->content)) {
			$meta->setAttribute('content', $this->content);
		}

		if (!empty($this->scheme)) {
			$meta->setAttribute('scheme', $this->scheme);
		}

		if (!empty($this->lang)) {
			$meta->setAttribute('lang', $this->lang);
		}

		if (!empty($this->dir)) {
			$meta->setAttribute('dir', $this->dir);
		}