<?php

 *
 * @package net.keeko.cms.core.output
		header('Content-Type: application/xhtml+xml; charset=utf-8');

		$xhtml = $this->renderer->render();

		if (\browser_detection('browser') == 'ie'
				&& (float)\browser_detection('number') <= 6) {
			$xhtml = str_ireplace("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n", '', $xhtml);
			header('Content-Type: text/html; charset=utf-8');
		}

		echo $xhtml;