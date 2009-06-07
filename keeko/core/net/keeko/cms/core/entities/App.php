<?php

namespace net\keeko\cms\core\entities;

/**
 * Skeleton subclass for representing a row from the 'app' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class App extends \net\keeko\cms\core\entities\base\BaseApp {

	private $currentUri = null;

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\App object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function setCurrentUri($uri) {
		$this->currentUri = $uri;
	}

	public function getCurrentUri() {
		return $this->currentUri;
	}

	public function toXML() {
		$xml = new \DOMDocument('1.0');
		$root = $xml->createElement('app');
		$root->setAttribute('id', $this->getId());
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('unixname', $this->getUnixname());
		$root->setAttribute('classname', $this->getClassname());

		foreach ($this->getAppUris() as $uri) {
			$uriNode = $xml->importNode($uri->toXML()->documentElement, true);
			$root->appendChild($uriNode);
		}

		$xml->appendChild($root);
		return $xml;
	}

} // net\keeko\cms\core\entities\App
