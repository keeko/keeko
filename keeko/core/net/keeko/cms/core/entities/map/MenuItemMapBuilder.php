<?php

namespace net\keeko\cms\core\entities\map;


/**
 * This class adds structure of 'menu_item' table to 'keeko' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    net.keeko.cms.core.entities.map
 */
class MenuItemMapBuilder implements \MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.net\keeko\cms\core\entities\map\MenuItemMapBuilder';

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
	 * @throws     \PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = \Propel::getDatabaseMap(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(\net\keeko\cms\core\entities\peer\MenuItemPeer::TABLE_NAME);
		$tMap->setPhpName('MenuItem');
		$tMap->setClassname('net\keeko\cms\core\entities\MenuItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'menu_item', 'ID', false, 10);

		$tMap->addForeignKey('MENU_ID', 'MenuId', 'INTEGER', 'menu', 'ID', true, 10);

		$tMap->addForeignKey('TEXT_ID', 'TextId', 'INTEGER', 'language_text', 'ID', true, 10);

		$tMap->addForeignKey('PAGE_ID', 'PageId', 'INTEGER', 'page', 'ID', false, 10);

		$tMap->addForeignKey('MODULE_ID', 'ModuleId', 'INTEGER', 'module', 'ID', false, 10);

		$tMap->addForeignKey('ACTION_ID', 'ActionId', 'INTEGER', 'action', 'ID', false, 10);

		$tMap->addColumn('EVENT', 'Event', 'INTEGER', false, 8);

		$tMap->addColumn('IMAGE', 'Image', 'VARCHAR', false, 255);

		$tMap->addColumn('SORTORDER', 'Sortorder', 'INTEGER', false, 10);

		$tMap->addColumn('EXTRA', 'Extra', 'VARCHAR', false, 255);

	} // doBuild()

} // net\keeko\cms\core\entities\map\MenuItemMapBuilder
