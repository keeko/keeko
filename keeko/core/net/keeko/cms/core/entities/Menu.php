<?php

namespace net\keeko\cms\core\entities;

use net\keeko\cms\core\entities\peer\MenuItemPeer;
use net\keeko\cms\core\page\IContentElement;

/**
 * Skeleton subclass for representing a row from the 'menu' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Menu extends \net\keeko\cms\core\entities\base\BaseMenu implements IContentElement {

	private $items = null;

	/**
	 * Initializes internal state of Menu object.
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
		$c = new \Criteria();
		$c->add(MenuItemPeer::MENU_ID, $this->getId(), \Criteria::EQUAL);
		$c->add(MenuItemPeer::PARENT_ID, 0);
//		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, Criteria::INNER_JOIN);
//		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, Criteria::INNER_JOIN);
		$c->addAscendingOrderByColumn(MenuItemPeer::SORTORDER);
		$this->items = MenuItemPeer::doSelect($c);
	}

	public function toXML() {
		$this->getItems();

		$doc = new \DOMDocument();
		$menu = $doc->createElement('menu');
		$menu->setAttribute('id', $this->getId());
		$menu->setAttribute('name', $this->getName());

		$items = $doc->createElement('items');

		foreach ($this->items as $i) {
			$node = $doc->importNode($i->toXML()->documentElement, true);
			$items->appendChild($node);
		}

		$menu->appendChild($items);
		$doc->appendChild($menu);

		return $doc;
	}

} // net\keeko\cms\core\entities\Menu
