<?php/************************************************************************  			core/output/XHTML1OutputProcessor.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/output/XHTML1OutputProcessor.php**************************************************************************/namespace net::keeko::cms::core::output;
require_once 'libs/browser_detection/browser_detection.php';/** * class XHTML1OutputProcessor * OutputProcessor for XHTML1 strict output.
 * 
 * @package net.keeko.cms.core.output */class XHTML1OutputProcessor extends OutputProcessor {	public function display() {
		header('Content-Type: application/xhtml+xml; charset=utf-8');
		
		$xhtml = $this->renderer->render();
		
		if (::browser_detection('browser') == 'ie' 
				&& (float)::browser_detection('number') <= 6) {
			$xhtml = str_ireplace("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n", '', $xhtml);
			header('Content-Type: text/html; charset=utf-8');
		}
		
		echo $xhtml;	}}?>