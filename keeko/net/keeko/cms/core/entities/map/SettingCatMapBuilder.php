<?php
namespace net::keeko::cms::core::entities::map;

use net::keeko::cms::core::entities::map::SettingCatMapBuilder;
use net::keeko::cms::core::entities::SettingCatPeer;




/**
 * This class adds structure of 'setting_cat' table to 'keeko' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by ::Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    net.keeko.cms.core.entities.map
 */
class SettingCatMapBuilder implements ::MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.SettingCatMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = ::Propel::getDatabaseMap(SettingCatPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(SettingCatPeer::TABLE_NAME);
		$tMap->setPhpName('SettingCat');
		$tMap->setClassname('SettingCat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

		$tMap->addForeignKey('NAME_ID', 'NameId', 'INTEGER', 'language_text', 'ID', true, 10);

	} // doBuild()

} // SettingCatMapBuilder
