<?php

namespace net\keeko\cms\core\entities\map;


/**
 * This class adds structure of 'unit_action_param' table to 'keeko' DatabaseMap object.
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
class UnitActionParamMapBuilder implements \MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'net.keeko.cms.core.entities.map.net\keeko\cms\core\entities\map\UnitActionParamMapBuilder';

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
		$this->dbMap = \Propel::getDatabaseMap(\net\keeko\cms\core\entities\peer\UnitActionParamPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(\net\keeko\cms\core\entities\peer\UnitActionParamPeer::TABLE_NAME);
		$tMap->setPhpName('UnitActionParam');
		$tMap->setClassname('net\keeko\cms\core\entities\UnitActionParam');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('PARAM_ID', 'ParamId', 'INTEGER' , 'param', 'ID', true, 10);

		$tMap->addForeignPrimaryKey('ACTION_ID', 'ActionId', 'INTEGER' , 'unit_action', 'ACTION_ID', true, 10);

		$tMap->addForeignPrimaryKey('UNIT_ID', 'UnitId', 'INTEGER' , 'unit_action', 'UNIT_ID', true, 10);

	} // doBuild()

} // net\keeko\cms\core\entities\map\UnitActionParamMapBuilder
