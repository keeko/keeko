<?php
 * 
 * @package net.keeko.cms.core.output
		
		$src = $this->renderer->getSource();
		$src->formatOutput = true;
		echo $src->saveXML();