<?php
namespace net::keeko::cms::core::page;/************************************************************************  			core/page/Meta.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/page/Meta.php**************************************************************************//** * class Meta * Represents a &lt;meta&gt; element
 * 
 * @package net.keeko.core
 * @subpackage page */class Meta extends HeadElement{	 /*** Attributes: ***/	/**	 * The content attribute	 * @access private	 */	private $content;	/**	 * The dir attribute	 * @access private	 */	private $dir;	/**	 * The http-equiv attribute	 * @access private	 */	private $httpEquiv;	/**	 * The lang attribute	 * @access private	 */	private $lang;	/**	 * The name attribute	 * @access private	 */	private $name;	/**	 * The scheme attribute	 * @access private	 */	private $scheme;	public function __construct() {}
		/**	 * Returns the content attribute	 *	 * @return string	 * @access public	 */	public function getContent() {		return $this->content;	}	/**	 * Returns the dir attribute	 *	 * @return string	 * @access public	 */	public function getDir() {		return $this->dir;	}	/**	 * Returns the http-equiv attribute	 *	 * @return string	 * @access public	 */	public function getHttpEquiv() {		return $this->httpEquiv;	}	/**	 * Returns the lang attribute	 *	 * @return string	 * @access public	 */	public function getLang() {		return $this->lang;	}	/**	 * Returns the scheme attribute	 *	 * @return string	 * @access public	 */	public function getScheme() {		return $this->scheme;	}	/**	 * Sets the content attribute	 *	 * @param string content value for the content attribute	 * @return 	 * @access public	 */	public function setContent($content) {		$this->content = $content;	}	/**	 * Sets the dir attribute	 *	 * @param string dir value for the dir attribute	 * @return 	 * @access public	 */	public function setDir($dir) {		$this->dir = $dir;	}	/**	 * Sets the http-equiv attribute	 *	 * @param string httpEquiv value for the http-equiv attribute	 * @return 	 * @access public	 */	public function setHttpEquiv($httpEquiv) {
		$this->httpEquiv = $httpEquiv;			}	/**	 * Sets the lang attribute	 *	 * @param string lang value for the lang attribute	 * @return 	 * @access public	 */	public function setLang($lang) {		$this->lang = $lang;	}	/**	 * Sets the name attribute	 *	 * @param string name value for the name attribute	 * @return 	 * @access public	 */	public function setName($name) {		$this->name = $name;	}	/**	 * Sets the scheme attribute	 *	 * @param string scheme value for the scheme attribute	 * @return 	 * @access public	 */	public function setScheme($scheme) {		$this->scheme = $scheme;	}	protected function generateXML() {		$this->xml = new DOMDocument();
		$meta = $this->xml->createElement('meta');
		$this->xml->appendChild($meta);

		if (!empty($this->name)) {
			$meta->setAttribute('name', $this->name);
		}

		if (!empty($this->httpEquiv)) {
			$meta->setAttribute('http-equiv', $this->httpEquiv);
		}

		if (!empty($this->content)) {
			$meta->setAttribute('content', $this->content);
		}

		if (!empty($this->scheme)) {
			$meta->setAttribute('scheme', $this->scheme);
		}
		
		if (!empty($this->lang)) {
			$meta->setAttribute('lang', $this->lang);
		}

		if (!empty($this->dir)) {
			$meta->setAttribute('dir', $this->dir);
		}	}}?>