<?php

namespace net\keeko\cms\core\entities;


/**
 * Skeleton subclass for representing a row from the 'language_uri' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class LanguageUri extends \net\keeko\cms\core\entities\base\BaseLanguageUri {

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\LanguageUri object.
	 * @see        parent::__construct()
	 */
	public function __construct() {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function toXml() {
		$dom = new \DOMDocument();
		$root = $dom->createElement('languageUri');
		$root->setAttribute('languageId', $this->getLanguageId());
		$root->setAttribute('appId', $this->getAppId());
		$root->setAttribute('uri', $this->getUri());
		$dom->appendChild($root);

		return $dom;
	}

} // net\keeko\cms\core\entities\LanguageUri
