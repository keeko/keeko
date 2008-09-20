<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BaseLayout;


/**
 * Skeleton subclass for representing a row from the 'layout' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class Layout extends BaseLayout {

	/**
	 * Initializes internal state of Layout object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // Layout
