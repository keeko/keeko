<?php
/************************************************************************
 * 
 * @package net.keeko.core
 * @subpackage page
	public function __construct() {}
		$link = $this->xml->createElement('link');
		$this->xml->appendChild($link);

		if (!empty($this->href)) {
			$link->setAttribute('href', $this->href);
		}

		if (!empty($this->media)) {
			$link->setAttribute('media', $this->media);
		}
		
		if (!empty($this->rel)) {
			$link->setAttribute('rel', $this->rel);
		}
		
		if (!empty($this->title)) {
			$link->setAttribute('title', $this->title);
		}
		
		if (!empty($this->type)) {
			$link->setAttribute('type', $this->type);
		}
?>