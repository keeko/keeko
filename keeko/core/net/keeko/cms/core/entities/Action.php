<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'action' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Action extends \net\keeko\cms\core\entities\base\BaseAction {

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\Action object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function toXML() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('action');
		$xml->appendChild($root);

		$root->setAttribute('id', $this->getId());
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('moduleId', $this->getModuleId());

		return $xml;
	}

} // net\keeko\cms\core\entities\Action
