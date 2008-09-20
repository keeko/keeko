<?php
namespace net::keeko::cms::core::entities::map;

use net::keeko::cms::core::entities::map::PageMapBuilder;
use net::keeko::cms::core::entities::PagePeer;




/**
 * This class adds structure of 'page' table to 'keeko' DatabaseMap object.
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
class PageMapBuilder implements ::MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.PageMapBuilder';

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
		$this->dbMap = ::Propel::getDatabaseMap(PagePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PagePeer::TABLE_NAME);
		$tMap->setPhpName('Page');
		$tMap->setClassname('Page');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'page', 'ID', true, 10);

		$tMap->addForeignKey('KEYWORDS_ID', 'KeywordsId', 'INTEGER', 'language_text', 'ID', true, 10);

		$tMap->addForeignKey('DESCRIPTION_ID', 'DescriptionId', 'INTEGER', 'language_text', 'ID', true, 10);

		$tMap->addForeignKey('TITLE_ID', 'TitleId', 'INTEGER', 'language_text', 'ID', true, 10);

		$tMap->addColumn('IS_USER', 'IsUser', 'BOOLEAN', false, null);

	} // doBuild()

} // PageMapBuilder
