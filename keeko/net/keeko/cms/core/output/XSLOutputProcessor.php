<?php
 * 
 * @package net.keeko.cms.core.output
		
		$src = $this->renderer->getStyleSheet();
		$src->formatOutput = true;
		echo $src->saveXML();