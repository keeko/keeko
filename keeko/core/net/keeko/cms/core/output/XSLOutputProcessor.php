<?php/************************************************************************  			core/output/RAWOutputProcessor.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/output/RAWOutputProcessor.php**************************************************************************/namespace net\keeko\cms\core\output;/** * class RAWOutputProcessor * Raw OutputProcessor bringing the internal XML-Document to the front.
 *
 * @package net.keeko.cms.core.output */class XSLOutputProcessor extends OutputProcessor{	public function display( ) {		header('Content-Type: application/xhtml+xml; charset=utf-8');

		$src = $this->renderer->getStyleSheet();
		$src->formatOutput = true;
		echo $src->saveXML();	}} // end of RAWOutputProcessor?>