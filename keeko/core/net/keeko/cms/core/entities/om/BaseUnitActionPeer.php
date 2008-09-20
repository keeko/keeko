<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::map::UnitActionMapBuilder;
use net::keeko::cms::core::entities::TablePeer;
use net::keeko::cms::core::entities::UnitActionPeer;
use net::keeko::cms::core::entities::UnitPeer;
use net::keeko::cms::core::entities::ActionPeer;
use net::keeko::cms::core::entities::ParamPeer;
use net::keeko::cms::core::entities::UnitAction;



/**
 * Base static class for performing query and update operations on the 'unit_action' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseUnitActionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'unit_action';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.UnitAction';

	/** The total number of columns. */
	const NUM_COLUMNS = 3;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the UNIT_ID field */
	const UNIT_ID = 'unit_action.UNIT_ID';

	/** the column name for the ACTION_ID field */
	const ACTION_ID = 'unit_action.ACTION_ID';

	/** the column name for the PARAM_ID field */
	const PARAM_ID = 'unit_action.PARAM_ID';

	/**
	 * An identiy map to hold any loaded instances of UnitAction objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array UnitAction[]
	 */
	public static $instances = array();

	/**
	 * The ::MapBuilder instance for this peer.
	 * @var        ::MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		::BasePeer::TYPE_PHPNAME => array ('UnitId', 'ActionId', 'ParamId', ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('unitId', 'actionId', 'paramId', ),
		::BasePeer::TYPE_COLNAME => array (self::UNIT_ID, self::ACTION_ID, self::PARAM_ID, ),
		::BasePeer::TYPE_FIELDNAME => array ('unit_id', 'action_id', 'param_id', ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[::BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		::BasePeer::TYPE_PHPNAME => array ('UnitId' => 0, 'ActionId' => 1, 'ParamId' => 2, ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('unitId' => 0, 'actionId' => 1, 'paramId' => 2, ),
		::BasePeer::TYPE_COLNAME => array (self::UNIT_ID => 0, self::ACTION_ID => 1, self::PARAM_ID => 2, ),
		::BasePeer::TYPE_FIELDNAME => array ('unit_id' => 0, 'action_id' => 1, 'param_id' => 2, ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * Get a (singleton) instance of the ::MapBuilder for this peer class.
	 * @return     ::MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new UnitActionMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME
	 *                         ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     ::PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new ::PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME
	 *                      ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = ::BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new ::PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME, ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. UnitActionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UnitActionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function addSelectColumns(::Criteria $criteria)
	{

		$criteria->addSelectColumn(UnitActionPeer::UNIT_ID);

		$criteria->addSelectColumn(UnitActionPeer::ACTION_ID);

		$criteria->addSelectColumn(UnitActionPeer::PARAM_ID);

	}

	const COUNT = 'COUNT(unit_action.UNIT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT unit_action.UNIT_ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      ::Criteria $criteria object used to create the SELECT statement.
	 * @param      ::PropelPDO $con
	 * @return     UnitAction
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectOne(::Criteria $criteria, ::PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UnitActionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      ::Criteria $criteria The ::Criteria object used to build the SELECT statement.
	 * @param      ::PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelect(::Criteria $criteria, ::PropelPDO $con = null)
	{
		return UnitActionPeer::populateObjects(UnitActionPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the ::Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      ::Criteria $criteria The ::Criteria object used to build the SELECT statement.
	 * @param      ::PropelPDO $con The connection to use
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        ::BasePeer::doSelect()
	 */
	public static function doSelectStmt(::Criteria $criteria, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UnitActionPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// ::BasePeer returns a PDOStatement
		return ::BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * ::Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      UnitAction $value A UnitAction object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(UnitAction $obj, $key = null)
	{
		if (::Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize($obj->getPrimaryKey());
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * ::Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A UnitAction object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (::Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof UnitAction) {
				$key = serialize($value->getPrimaryKey());
			} elseif (is_array($value)) {
				// assume we've been passed a primary key
				$key = serialize($value);
			} else {
				$e = new ::PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or UnitAction object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     UnitAction Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (::Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row ::PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row ::PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}

		return serialize(array($row[$startcol + 0],$row[$startcol + 1]));
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = UnitActionPeer::getOMClass();
		$cls = str_replace('.', '::', $cls);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UnitActionPeer::getInstanceFromPool($key))) {
				$obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UnitActionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Unit table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUnit(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Action table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAction(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Param table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinParam(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with their Unit objects.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinUnit(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);
		UnitPeer::addSelectColumns($c);

		$c->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = UnitPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UnitPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UnitPeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UnitPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (UnitAction) to $obj2 (Unit)
				$obj2->addUnitAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with their Action objects.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAction(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);
		ActionPeer::addSelectColumns($c);

		$c->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ActionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ActionPeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ActionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (UnitAction) to $obj2 (Action)
				$obj2->addUnitAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with their Param objects.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinParam(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);
		ParamPeer::addSelectColumns($c);

		$c->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ParamPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ParamPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ParamPeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ParamPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (UnitAction) to $obj2 (Param)
				$obj2->addUnitAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with all related objects.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAll(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol2 = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);

		UnitPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UnitPeer::NUM_COLUMNS - UnitPeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		ParamPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ParamPeer::NUM_COLUMNS - ParamPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Unit rows

			$key2 = UnitPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = UnitPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UnitPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UnitPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (UnitAction) to the collection in $obj2 (Unit)
				$obj2->addUnitAction($obj1);
			} // if joined row not null

			// Add objects for joined Action rows

			$key3 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ActionPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ActionPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (UnitAction) to the collection in $obj3 (Action)
				$obj3->addUnitAction($obj1);
			} // if joined row not null

			// Add objects for joined Param rows

			$key4 = ParamPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = ParamPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = ParamPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ParamPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (UnitAction) to the collection in $obj4 (Param)
				$obj4->addUnitAction($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Unit table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUnit(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Action table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAction(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Param table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptParam(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UnitActionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UnitActionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = UnitActionPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with all related objects except Unit.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptUnit(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol2 = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		ParamPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ParamPeer::NUM_COLUMNS - ParamPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Action rows

				$key2 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ActionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ActionPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj2 (Action)
				$obj2->addUnitAction($obj1);

			} // if joined row is not null

				// Add objects for joined Param rows

				$key3 = ParamPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ParamPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ParamPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ParamPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj3 (Param)
				$obj3->addUnitAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with all related objects except Action.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptAction(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol2 = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);

		UnitPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UnitPeer::NUM_COLUMNS - UnitPeer::NUM_LAZY_LOAD_COLUMNS);

		ParamPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ParamPeer::NUM_COLUMNS - ParamPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(UnitActionPeer::PARAM_ID, ParamPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Unit rows

				$key2 = UnitPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UnitPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UnitPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UnitPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj2 (Unit)
				$obj2->addUnitAction($obj1);

			} // if joined row is not null

				// Add objects for joined Param rows

				$key3 = ParamPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ParamPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ParamPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ParamPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj3 (Param)
				$obj3->addUnitAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of UnitAction objects pre-filled with all related objects except Param.
	 *
	 * @return     array Array of UnitAction objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptParam(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UnitActionPeer::addSelectColumns($c);
		$startcol2 = (UnitActionPeer::NUM_COLUMNS - UnitActionPeer::NUM_LAZY_LOAD_COLUMNS);

		UnitPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UnitPeer::NUM_COLUMNS - UnitPeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(UnitActionPeer::UNIT_ID, UnitPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(UnitActionPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UnitActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (UnitActionPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = UnitActionPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UnitActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Unit rows

				$key2 = UnitPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UnitPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UnitPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UnitPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj2 (Unit)
				$obj2->addUnitAction($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key3 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ActionPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ActionPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (UnitAction) to the collection in $obj3 (Action)
				$obj3->addUnitAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function getTableMap()
	{
		return ::Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return UnitActionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a UnitAction or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or UnitAction object containing data that is used to create the INSERT statement.
	 * @param      ::PropelPDO $con the ::PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doInsert($values, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof ::Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build ::Criteria from UnitAction object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = ::BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(::PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a UnitAction or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or UnitAction object containing data that is used to create the UPDATE statement.
	 * @param      ::PropelPDO $con The connection to use (specify ::PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doUpdate($values, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new ::Criteria(self::DATABASE_NAME);

		if ($values instanceof ::Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(UnitActionPeer::UNIT_ID);
			$selectCriteria->add(UnitActionPeer::UNIT_ID, $criteria->remove(UnitActionPeer::UNIT_ID), $comparison);

			$comparison = $criteria->getComparison(UnitActionPeer::ACTION_ID);
			$selectCriteria->add(UnitActionPeer::ACTION_ID, $criteria->remove(UnitActionPeer::ACTION_ID), $comparison);

		} else { // $values is UnitAction object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return ::BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the unit_action table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += ::BasePeer::doDeleteAll(UnitActionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a UnitAction or ::Criteria object OR a primary key value.
	 *
	 * @param      mixed $values ::Criteria or UnitAction object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      ::PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using ::Propel.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	 public static function doDelete($values, ::PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = ::Propel::getConnection(UnitActionPeer::DATABASE_NAME);
		}

		if ($values instanceof ::Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this ::Criteria.
			UnitActionPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof UnitAction) {
			// invalidate the cache for this single object
			UnitActionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key

			// we can invalidate the cache for this single object
			UnitActionPeer::removeInstanceFromPool($values);

			$criteria = new ::Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(UnitActionPeer::UNIT_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(UnitActionPeer::ACTION_ID, $value[1]));
				$criteria->addOr($criterion);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += ::BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given UnitAction object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      UnitAction $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(UnitAction $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = ::Propel::getDatabaseMap(UnitActionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UnitActionPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return ::BasePeer::doValidate(UnitActionPeer::DATABASE_NAME, UnitActionPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $unit_id
	   @param int $action_id
	   
	 * @param      ::PropelPDO $con
	 * @return     UnitAction
	 */
	public static function retrieveByPK( $unit_id, $action_id, ::PropelPDO $con = null) {
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new ::Criteria();
		$criteria->add(UnitActionPeer::UNIT_ID, $unit_id);
		$criteria->add(UnitActionPeer::ACTION_ID, $action_id);
		$v = UnitActionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseUnitActionPeer

// This is the static code needed to register the ::MapBuilder for this table with the main ::Propel class.
//
// NOTE: This static code cannot call methods on the UnitActionPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the UnitActionPeer class:
//
// ::Propel::getDatabaseMap(UnitActionPeer::DATABASE_NAME)->addTableBuilder(UnitActionPeer::TABLE_NAME, UnitActionPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

::Propel::getDatabaseMap(BaseUnitActionPeer::DATABASE_NAME)->addTableBuilder(BaseUnitActionPeer::TABLE_NAME, BaseUnitActionPeer::getMapBuilder());
