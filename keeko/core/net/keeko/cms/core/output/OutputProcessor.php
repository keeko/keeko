<?php/************************************************************************  			core/output/OutputProcessor.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/output/OutputProcessor.php**************************************************************************/namespace net\keeko\cms\core\output;/** * class OutputProcessor * The OutputProcessor manages the output of the page content's
 *
 * @package net.keeko.cms.core.output */abstract class OutputProcessor {	protected $gzip;	protected $renderer;	public function setGzipLevel($level) {	}	abstract public function display();	/**	 * Sets the used renderer for the OutputProcessor.	 *	 * @param core::output::Renderer renderer The renderer for the OutputProcessor	 * @return	 * @access public	 */	public function setRenderer($renderer) {		$this->renderer = $renderer;	}	/**	 * Returns the used Renderer	 *	 * @return core::output::Renderer	 * @access public	 */	public function getRenderer() {		return $this->renderer;	}}
?>