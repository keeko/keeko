<?php
 *
 * @package net.keeko.cms.core.output
	public function display( ) {
		header('Content-Type: text/plain; charset=utf-8');

		echo $this->renderer->render();
	}