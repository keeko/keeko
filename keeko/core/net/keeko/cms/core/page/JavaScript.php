<?php
namespace net\keeko\cms\core\page;/************************************************************************  			core/page/JavaScript.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/page/JavaScript.php**************************************************************************//** * class JavaScript * Represents a &lt;script&lt; element
 *
 * @package net.keeko.core
 * @subpackage page */class JavaScript extends HeadElement{	 /*** Attributes: ***/	/**	 * Contains the src attribute	 * @access private	 */	private $src;	/**	 * Contains Javascript-Code	 * @access private	 */	private $content;
	public function __construct() {}	/**	 * Sets the src attribute	 *	 * @param string src path to javascript file	 * @return	 * @access public	 */	public function setSrc($src) {		$this->src = $src;	}	/**	 * Returns the src attribute	 *	 * @return string	 * @access public	 */	public function getSrc() {		return $this->src;	}	/**	 * Sets JavaScript-Code	 *	 * @param string content JavaScript code	 * @return	 * @access public	 */	public function setContent($content) {		$this->content = $content;	}	/**	 * Returns JavaScript Code	 *	 * @return string	 * @access public	 */	public function getContent() {		return $this->content;	}	protected function generateXML() {		$this->xml = new \DOMDocument();

		if (!is_null($this->content)) {
			$this->content = sprintf("\n%s\n", $this->content);
		}

		$script = $this->xml->createElement('script', $this->content);
		$script->setAttribute('type', 'text/javascript');
		if ($this->src) {
			$script->setAttribute('src', $this->src);
		}
		$this->xml->appendChild($script);	}}?>