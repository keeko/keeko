<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'app_uri' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class AppUri extends \net\keeko\cms\core\entities\base\BaseAppUri {

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\AppUri object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function getUri() {
		return str_replace('%', '', parent::getUri());
	}

	public function setUri($uri) {
		parent::setUri('%'.$uri.'%');
	}

	public function toXML() {
		$xml = new \DOMDocument('1.0');
		$root = $xml->createElement('appUri');
		$root->setAttribute('appId', $this->getAppId());
		$root->setAttribute('uri', $this->getUri());

		$xml->appendChild($root);
		return $xml;
	}

} // net\keeko\cms\core\entities\AppUri
