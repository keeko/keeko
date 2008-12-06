<?php
namespace net\keeko\cms\core\page;/************************************************************************  			core/page/Css.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/page/Css.php**************************************************************************//** * class Css * Represents a &lt;style&gt; element
 *
 * @package net.keeko.core
 * @subpackage page */class Css extends HeadElement {
	/**	 * The href attribute	 * @access private	 */	private $href;	/**	 * The media attribute	 * @access private	 */	private $media;	/**	 * The css code within the element	 * @access private	 */	private $content;	public function __construct() {}	/**	 * Returns css code	 *	 * @return string	 * @access public	 */	public function getContent() {		return $this->content;	}	/**	 * Sets css code	 *	 * @param string content css code	 * @return string	 * @access public	 */	public function setContent($content) {		$this->content = $content;	}	/**	 * Sets the href attribute	 *	 * @param string href path for css file	 * @return string	 * @access public	 */	public function setHref($href) {		$this->href = $href;	}	/**	 * Returns the href attribute	 *	 * @return string	 * @access public	 */	public function getHref() {		return $this->href;	}	/**	 * Returns the media attribute	 *	 * @return string	 * @access public	 */	public function getMedia() {		return $this->media;	}	/**	 * Sets the media attribute	 *	 * @param string media media attribute	 * @return string	 * @access public	 */	public function setMedia($media) {		$this->media = $media;	}	/**	 * Internally method for generating the xml-document	 *	 * @return	 * @access private	 */	protected function generateXML() {		if (!is_null($this->href)) {
			$before = sprintf("@import url('%s') %s;\n", $this->href,
				$this->media);
			$this->content = trim($before . $this->content);
		}
		$this->xml = new \DOMDocument();
		$content = $this->xml->createCDATASection($this->content);
		$css = $this->xml->createElement('style');
		$css->setAttribute('type', 'text/css');
		$css->appendChild($content);
		$this->xml->appendChild($css);	}}?>