<?phpnamespace net::keeko::cms::core::page;
/************************************************************************  			core/page/Link.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/page/Link.php**************************************************************************//** * class Link * Represents a &lt;link&gt; element
 * 
 * @package net.keeko.core
 * @subpackage page */class Link extends HeadElement{	 /*** Attributes: ***/	/**	 * The href attribute	 * @access private	 */	private $href;	/**	 * The media attribute	 * @access private	 */	private $media;	/**	 * The rel attribute	 * @access private	 */	private $rel;	/**	 * The title attribute	 * @access private	 */	private $title;	/**	 * The type attribute	 * @access private	 */	private $type;
	public function __construct() {}	/**	 * Returns the href attribute	 *	 * @return string	 * @access public	 */	public function getHref() {		return $this->href;	}	/**	 * Returns the media attribute	 *	 * @return string	 * @access public	 */	public function getMedia() {		return $this->media;	}	/**	 * Returns the rel attribute	 *	 * @return string	 * @access public	 */	public function getRel() {		return $this->rel;	}	/**	 * Returns the title attribute	 *	 * @return string	 * @access public	 */	public function getTitle() {		return $this->title;	}	/**	 * Returns the type attribute	 *	 * @return string	 * @access public	 */	public function getType() {		return $this->type;	}	/**	 * Sets the href attribute	 *	 * @param string href value for the href attribute	 * @return 	 * @access public	 */	public function setHref($href) {		$this->href = $href;	}	/**	 * Sets the media attribute	 *	 * @param string media value for the media attribute	 * @return 	 * @access public	 */	public function setMedia($media) {		$this->media = $media;	}	/**	 * Sets the rel attribute	 *	 * @param string rel value for the rel attribute	 * @return 	 * @access public	 */	public function setRel($rel) {		$this->rel = $rel;	}	/**	 * Sets the title attribute	 *	 * @param string title value for the title attribute	 * @return 	 * @access public	 */	public function setTitle($title) {		$this->title = $title;	}	/**	 * Sets the type attribute	 *	 * @param string type value for the type attribute	 * @return 	 * @access public	 */	public function setType($type) {		$this->type = $type;	}	protected function generateXML( ) {		$this->xml = new DOMDocument();
		$link = $this->xml->createElement('link');
		$this->xml->appendChild($link);

		if (!empty($this->href)) {
			$link->setAttribute('href', $this->href);
		}

		if (!empty($this->media)) {
			$link->setAttribute('media', $this->media);
		}
		
		if (!empty($this->rel)) {
			$link->setAttribute('rel', $this->rel);
		}
		
		if (!empty($this->title)) {
			$link->setAttribute('title', $this->title);
		}
		
		if (!empty($this->type)) {
			$link->setAttribute('type', $this->type);
		}	}}
?>