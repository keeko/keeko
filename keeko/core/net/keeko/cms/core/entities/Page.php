<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BasePage;
use net::keeko::cms::core::page::HeadElement;


/**
 * Skeleton subclass for representing a row from the 'page' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Page extends BasePage {

	private $title = '';
	private $description = '';
	private $keywords = '';

	private $blocks = array();
	private $heads = array();

	/**
	 * Initializes internal state of Page object.
	 * @see        parent::__construct()
	 */
	public function __construct() {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	/**
	 * Returns the page's description
	 * 
	 * @return string
	 */
	public function getDescription() {
		if ($this->description == '' && $this->description_id) {
			$this->description = $this->getLanguageTextRelatedByDescriptionId()->getContent();
		}
		
		return $this->description;
	}

	/**
	 * Returns the page's keywords
	 * 
	 * @return string
	 */
	public function getKeywords() {
		if ($this->keywords == '' && $this->keywords_id) {
			$this->keywords = $this->getLanguageTextRelatedByKeywordsId()->getContent();
		}

		return $this->keywords;
	}

	/**
	 * Returns the page's title
	 * 
	 * @return string
	 */
	public function getTitle() {
		if ($this->title == '' && $this->title_id) {
			$this->title = $this->getLanguageTextRelatedByTitleId()->getContent(); 
		}
		return $this->title; 
	}

	/**
	 * Sets the page's description
	 * 
	 * @param string description the description for the page
	 */
	public function setDescription($description) {
		$t = new LanguageText();
		$t->setLanguageId(KeekoRuntime::getInstance()->getContentLanguage());
		$t->setContent($description);
		$this->setLanguageTextRelatedByDescriptionId($t);
	}

	/**
	 * Sets the page's keywords
	 * 
	 * @param string keywords the keywords for the page
	 */
	public function setKeywords($keywords) {
		$t = new LanguageText();
		$t->setLanguageId(KeekoRuntime::getInstance()->getContentLanguage());
		$t->setContent($keywords);
		$this->setLanguageTextRelatedByKeywordsId($t);
	}

	/**
	 * Sets the page's title
	 * 
	 * @param string title the title for the page
	 */
	public function setTitle($title) {
		$this->title = $title;
		$t = new LanguageText();
		$t->setLanguageId(KeekoRuntime::getInstance()->getContentLanguage());
		$t->setContent($title);
		$this->setLanguageTextRelatedByTitleId($t);
	}

	public function addHeadElement(HeadElement $elem) {
		$this->heads[] = $elem;
	}

	public function removeHeadElement(HeadElement $elem) {
		$offset = array_search($elem, $this->heads);
		if ($offset) {
			unset($this->heads[$offset]);
		}
	}

	public function addBlock(Block $elem) {
		$this->blocks[] = $elem;
	}

	public function removeBlock(Block $elem) {
		$offset = array_search($elem, $this->blocks);
		if ($offset) {
			unset($this->blocks[$offset]);
		}
	}
	
	public function toXML() {
		$doc = new DOMDocument('1.0', 'utf-8');
		$page = $doc->createElement('page');
		$page->setAttribute('id', $this->getId());

		$title = $doc->createElement('title', $this->getTitle());
		$title->setAttribute('id', $this->getTitleId());

		$desc = $doc->createElement('desc', $this->getDescription());
		$desc->setAttribute('id', $this->getDescriptionId());

		$keywords = $doc->createElement('keywords', $this->getKeywords());
		$keywords->setAttribute('id', $this->getKeywordsId());
	
		$heads = $doc->createElement('head');
		foreach ($this->heads as $head) {
			$node = $doc->importNode($head->toXML()->documentElement, true);
			$heads->appendChild($node);
		}
		
		$blocks = $doc->createElement('blocks');
		foreach ($this->blocks as $block) {
			$node = $doc->importNode($block->toXML()->documentElement, true);
			$blocks->appendChild($node);
		}

		$page->appendChild($title);
		$page->appendChild($desc);
		$page->appendChild($keywords);
		$page->appendChild($heads);
		$page->appendChild($blocks);

		$doc->appendChild($page);
		
		return $doc;
	}

} // Page
