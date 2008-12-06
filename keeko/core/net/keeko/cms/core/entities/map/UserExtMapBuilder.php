<?php

namespace net\keeko\cms\core\entities\map;


/**
 * This class adds structure of 'user_ext' table to 'keeko' DatabaseMap object.
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
class UserExtMapBuilder implements \MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.net\keeko\cms\core\entities\map\UserExtMapBuilder';

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
		$this->dbMap = \Propel::getDatabaseMap(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(\net\keeko\cms\core\entities\peer\UserExtPeer::TABLE_NAME);
		$tMap->setPhpName('UserExt');
		$tMap->setClassname('net\keeko\cms\core\entities\UserExt');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('KEYNAME', 'Keyname', 'VARCHAR', true, 64);

		$tMap->addForeignKey('NAME_ID', 'NameId', 'INTEGER', 'language_text', 'ID', true, 10);

		$tMap->addForeignKey('CAT_ID', 'CatId', 'INTEGER', 'user_ext_cat', 'ID', true, 10);

		$tMap->addColumn('HIDE', 'Hide', 'BOOLEAN', false, null);

		$tMap->addColumn('FORMAT', 'Format', 'INTEGER', false, 8);

	} // doBuild()

} // net\keeko\cms\core\entities\map\UserExtMapBuilder
