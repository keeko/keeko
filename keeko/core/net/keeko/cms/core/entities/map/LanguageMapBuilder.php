<?php

namespace net\keeko\cms\core\entities\map;


/**
 * This class adds structure of 'language' table to 'keeko' DatabaseMap object.
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
class LanguageMapBuilder implements \MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.net\keeko\cms\core\entities\map\LanguageMapBuilder';

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
		$this->dbMap = \Propel::getDatabaseMap(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(\net\keeko\cms\core\entities\peer\LanguagePeer::TABLE_NAME);
		$tMap->setPhpName('Language');
		$tMap->setClassname('net\keeko\cms\core\entities\Language');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 64);

		$tMap->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 2);

		$tMap->addColumn('LANGUAGE', 'Language', 'VARCHAR', false, 2);

		$tMap->addColumn('VARIANT', 'Variant', 'VARCHAR', false, 2);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'BOOLEAN', false, null);

	} // doBuild()

} // net\keeko\cms\core\entities\map\LanguageMapBuilder
