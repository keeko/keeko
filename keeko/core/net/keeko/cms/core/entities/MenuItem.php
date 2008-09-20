<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BaseMenuItem;


/**
 * Skeleton subclass for representing a row from the 'menu_item' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class MenuItem extends BaseMenuItem {

	/** Event Handler Constants **/
	const LOAD = 1;
	const KLICK = 2;
	
	private $items = null;

	/**
	 * Initializes internal state of MenuItem object.
	 * @see        parent::__construct()
	 */
	public function __construct() {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();	
	}

	public function getItems() {
		if (is_null($this->items)) {
			$this->loadItems();
		}
		
		return $this->items;
	}

	private function loadItems() {
		$c = new ::Criteria();
		$c->add(MenuItemPeer::PARENT_ID, $this->getId());
		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::INNER_JOIN);
		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::INNER_JOIN);
		$c->addAscendingOrderByColumn(MenuItemPeer::SORTORDER);
		$this->items = MenuItemPeer::doSelect($c);
	}

	public function toXML() {
		$this->getItems();

		$doc = new DOMDocument();
		$item = $doc->createElement('item');
		$item->setAttribute('id', $this->getId());
		$item->setAttribute('event', $this->getEvent());
		$item->setAttribute('image', $this->getImage());
		$item->setAttribute('pageId', $this->getPageId());
		$item->setAttribute('parentId', $this->getParentId());
		$item->setAttribute('extra', ::xmlentities($this->getExtra()));

		$action = $doc->createElement('action');
		if ($this->getAction()) {
			$action->setAttribute('id', $this->getAction()->getId());
			$action->setAttribute('name', $this->getAction()->getName());
		}

		$module = $doc->createElement('module');
		if ($this->getModule()) {
			$module->setAttribute('id', $this->getModule()->getId());
			$module->setAttribute('unixname', $this->getModule()->getUnixname());
		}

		$items = $doc->createElement('items');

		foreach ($this->items as $i) {
			$node = $doc->importNode($i->toXML()->documentElement, true);
			$items->appendChild($node);
		}

		$item->appendChild($module);
		$item->appendChild($action);
		$item->appendChild($items);

		$doc->appendChild($item);

		return $doc;
	}

} // MenuItem
