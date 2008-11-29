<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BaseLanguage;


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
class Language extends BaseLanguage {

	/**
	 * Initializes internal state of Language object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // Language