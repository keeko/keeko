<?php/************************************************************************  			core/output/Renderer.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/output/Renderer.php**************************************************************************/namespace net\keeko\cms\core\output;
/** * class Renderer * The Renderer holds a collection of stylesheets that are put into one that holds * all and is thrown against the source xml document to transit the output result
 *
 * @package net.keeko.cms.core.output
 */class Renderer {	/**	 * Contains the XML-Document that is parsed against the stylesheet(s)	 * @access private	 */	private $source = null;	/**	 * Internally generated Stylesheet containing references to all added stylesheets	 * @access private	 */	private $styleSheet = null;	/**	 * A list holding path information to stylesheets that should run against the	 * source	 * @access private	 */	private $styleSheets = array();	public function __construct() {}	/**	 * Adding a StyleSheet to the list of stylesheets that run against the source	 *	 * @param string styleSheet path to the stylesheet	 * @return	 * @access public	 */	public function addStyleSheet($styleSheet) {		if (!in_array($styleSheet, $this->styleSheets)) {
			$this->styleSheets[] = $styleSheet;
			$this->styleSheet = null;
		}	}	/**	 * Returns the source	 *	 * @return DOMDocument	 * @access public	 */	public function getSource() {		return $this->source;	}	/**	 * Removes a StyleSheet from the path collection
	 *	 * @param string styleSheet Path to the StyleSheet that is removed from the list	 * @return	 * @access public	 */	public function removeStyleSheet($styleSheet) {		$offset = array_search($styleSheet, $this->styleSheets);
		if ($offset) {
			unset($this->styleSheets[$offset]);
			$this->styleSheet = null;
		}
	}	/**	 * Returns the overall-stylesheet generated by generateStyleSheet	 *	 * @return DOMDocument	 * @access public	 */	public function getStyleSheet() {		if (is_null($this->styleSheet)) {
			$this->generateStyleSheet();
		}

		return $this->styleSheet;	}	/**	 * Renders the source against the stylesheet(s)	 *	 * @return string	 * @access public	 */	public function render() {		if (is_null($this->source)) {
			throw new Exception('no source data');
		}

		$processor = new \XSLTProcessor();
		$processor->importStyleSheet($this->getStyleSheet());
		return $processor->transformToXML($this->source);	}	/**	 * Sets the source XML-Document that is rendered against all stylesheet(s)	 *	 * @param DOMDocument source XML-Document the renderer should render	 * @return	 * @access public	 */	public function setSource(\DOMDocument $source) {		$this->source = $source;	}	/**	 * Internal creation of a dummy style sheet, containing imports with all style	 * sheets in the style sheet list	 *	 * @return DOMDocument	 * @access private	 */	private function generateStyleSheet() {		$xsl = new \DOMDocument('1.0', 'utf-8');
		$stylesheet = $xsl->createElementNS('http://www.w3.org/1999/XSL/Transform', 'xsl:stylesheet');
		$stylesheet->setAttribute('version', '1.0');
		$xsl->appendChild($stylesheet);

		foreach ($this->styleSheets as $styleSheetPath) {
			$include = $xsl->createElementNS('http://www.w3.org/1999/XSL/Transform', 'import');
			$include->setAttribute('href', $styleSheetPath);
			$stylesheet->appendChild($include);
		}

		$this->styleSheet = $xsl;	}}?>