<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'language' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Language extends \net\keeko\cms\core\entities\base\BaseLanguage {

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\Language object.
	 * @see        parent::__construct()
	 */
	public function __construct() {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function toXml() {
		$dom = new \DOMDocument();
		$root = $dom->createElement('language');
		$root->setAttribute('id', $this->getId());
		$root->setAttribute('name', $this->getName());
		$root->setAttribute('country', $this->getCountry());
		$root->setAttribute('language', $this->getLanguage());
		$root->setAttribute('variant', $this->getVariant());
		$root->setAttribute('isDefault', $this->getIsDefault() ? 'true' : 'false');
		$root->setAttribute('isActive', $this->getIsActive() ? 'true' : 'false');
		$root->setAttribute('interfaceLanguage', $this->getInterfaceLanguage());
		$root->setAttribute('fallback', $this->getFallback());
		$dom->appendChild($root);

		return $dom;
	}

} // net\keeko\cms\core\entities\Language
