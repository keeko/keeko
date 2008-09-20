<?php
namespace net::keeko::cms::core::entities;


use net::keeko::cms::core::entities::om::BaseSettingSection;


/**
 * Skeleton subclass for representing a row from the 'setting_section' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class SettingSection extends BaseSettingSection {

	/**
	 * Initializes internal state of SettingSection object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // SettingSection
