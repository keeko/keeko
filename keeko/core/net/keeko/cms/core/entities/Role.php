<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'role' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Role extends \net\keeko\cms\core\entities\base\BaseRole {

	/**
	 * Initializes internal state of Role object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function toXml() {
		$xml = new \DOMDocument('1.0', 'utf-8');
		$root = $xml->createElement('group');
		$xml->appendChild($root);

		$root->setAttribute('id', $this->getId());
		$root->setAttribute('isGuest', $this->getIsGuest());
		$root->setAttribute('isDefault', $this->getIsDefault());
		$root->setAttribute('isActive', $this->getIsActive());
		$root->setAttribute('isSystem', $this->getIsSystem());
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('userId', $this->getUserId());

		if (count($this->getRoleActions())) {
			$actions = $xml->createElement('actions');
			$root->appendChild($actions);
			foreach ($this->getRoleActions() as $action) {
				$actionNode = $xml->importNode($action->toXML()->documentElement, true);
				$actions->appendChild($actionNode);
			}
		}

		return $xml;
	}

} // net\keeko\cms\core\entities\Role
