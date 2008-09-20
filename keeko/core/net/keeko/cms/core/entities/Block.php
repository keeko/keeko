<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BaseBlock;
use net::keeko::cms::core::page::IContentElement;


/**
 * Skeleton subclass for representing a row from the 'block' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Block extends BaseBlock implements IContentElement {

	private $contentElements = array();
	
	/**
	 * Initializes internal state of Block object.
	 * @see        parent::__construct()
	 */
	public function __construct() {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function addContentElement(IContentElement $elem) {
		$this->contentElements[] = $elem;
	}
	
	public function removeContentElement(IContentElement $elem) {
		$offset = array_search($elem, $this->contentElements);
		if ($offset) {
			unset($this->contentElements[$offset]);
		}
	}
	
	public function toXML() {
		$doc = new DOMDocument('1.0', 'utf-8');
		$block = $doc->createElement('block');
		$block->setAttribute('name', $this->getName());
		$block->setAttribute('id', $this->getId());
		
		$doc->appendChild($block);
		
		foreach ($this->contentElements as $elem) {
			$node = $doc->importNode($elem->toXML()->documentElement, true);
			$block->appendChild($node);			
		}
		
		return $doc;
	}

} // Block
