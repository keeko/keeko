<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'module' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Module extends \net\keeko\cms\core\entities\base\BaseModule {

	private $name = '';

	private $description = '';

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\Module object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function getDescription() {
		return $this->description;
	}

	public function getName() {
		return $this->name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function toXML() {
		$xml = new \DOMDocument();
		$root = $xml->createElement('module');
		$xml->appendChild($root);

		$root->setAttribute('id', $this->getId());
		$root->setAttribute('unixname', $this->getUnixname());
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('description', $this->getDescription());

		$actions = $this->getActions();
		foreach ($actions as $action) {
			$actionNode = $xml->importNode($action->toXML()->documentElement, true);
			$root->appendChild($actionNode);
		}

		return $xml;
	}

} // net\keeko\cms\core\entities\Module
