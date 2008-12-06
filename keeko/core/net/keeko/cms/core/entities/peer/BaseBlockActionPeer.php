<?php

namespace net\keeko\cms\core\entities\peer;

/**
 * Base static class for performing query and update operations on the 'block_action' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseBlockActionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'block_action';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.net\keeko\cms\core\entities\BlockAction';

	/** The total number of columns. */
	const NUM_COLUMNS = 3;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the BLOCK_ID field */
	const BLOCK_ID = 'block_action.BLOCK_ID';

	/** the column name for the ACTION_ID field */
	const ACTION_ID = 'block_action.ACTION_ID';

	/** the column name for the PARAM_ID field */
	const PARAM_ID = 'block_action.PARAM_ID';

	/**
	 * An identiy map to hold any loaded instances of net\keeko\cms\core\entities\BlockAction objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array net\keeko\cms\core\entities\BlockAction[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		\BasePeer::TYPE_PHPNAME => array ('BlockId', 'ActionId', 'ParamId', ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('blockId', 'actionId', 'paramId', ),
		\BasePeer::TYPE_COLNAME => array (self::BLOCK_ID, self::ACTION_ID, self::PARAM_ID, ),
		\BasePeer::TYPE_FIELDNAME => array ('block_id', 'action_id', 'param_id', ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		\BasePeer::TYPE_PHPNAME => array ('BlockId' => 0, 'ActionId' => 1, 'ParamId' => 2, ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('blockId' => 0, 'actionId' => 1, 'paramId' => 2, ),
		\BasePeer::TYPE_COLNAME => array (self::BLOCK_ID => 0, self::ACTION_ID => 1, self::PARAM_ID => 2, ),
		\BasePeer::TYPE_FIELDNAME => array ('block_id' => 0, 'action_id' => 1, 'param_id' => 2, ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new net\keeko\cms\core\entities\map\BlockActionMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new \PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = \BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new \PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
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
	 * @param      string $column The column name for current table. (i.e. net\keeko\cms\core\entities\peer\BlockActionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(\Criteria $criteria)
	{

		$criteria->addSelectColumn(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID);

		$criteria->addSelectColumn(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID);

		$criteria->addSelectColumn(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(\Criteria $criteria, $distinct = false, \PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     net\keeko\cms\core\entities\BlockAction
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(\Criteria $criteria, \PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = net\keeko\cms\core\entities\peer\BlockActionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(\Criteria $criteria, \PropelPDO $con = null)
	{
		return net\keeko\cms\core\entities\peer\BlockActionPeer::populateObjects(net\keeko\cms\core\entities\peer\BlockActionPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(\Criteria $criteria, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return \BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      net\keeko\cms\core\entities\BlockAction $value A net\keeko\cms\core\entities\BlockAction object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(net\keeko\cms\core\entities\BlockAction $obj, $key = null)
	{
		if (\Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getBlockId(), (string) $obj->getActionId()));
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A net\keeko\cms\core\entities\BlockAction object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (\Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof net\keeko\cms\core\entities\BlockAction) {
				$key = serialize(array((string) $value->getBlockId(), (string) $value->getActionId()));
			} elseif (is_array($value) && count($value) === 2) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new \PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or net\keeko\cms\core\entities\BlockAction object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     net\keeko\cms\core\entities\BlockAction Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (\Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
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
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Block table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinBlock(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Action table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAction(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Param table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinParam(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with their net\keeko\cms\core\entities\Block objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinBlock(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);
		net\keeko\cms\core\entities\peer\BlockPeer::addSelectColumns($c);

		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = net\keeko\cms\core\entities\peer\BlockPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = net\keeko\cms\core\entities\peer\BlockPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = net\keeko\cms\core\entities\peer\BlockPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					net\keeko\cms\core\entities\peer\BlockPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Block)
				$obj2->addBlockAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with their net\keeko\cms\core\entities\Action objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAction(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);
		net\keeko\cms\core\entities\peer\ActionPeer::addSelectColumns($c);

		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = net\keeko\cms\core\entities\peer\ActionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = net\keeko\cms\core\entities\peer\ActionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = net\keeko\cms\core\entities\peer\ActionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					net\keeko\cms\core\entities\peer\ActionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Action)
				$obj2->addBlockAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with their net\keeko\cms\core\entities\Param objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinParam(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);
		net\keeko\cms\core\entities\peer\ParamPeer::addSelectColumns($c);

		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = net\keeko\cms\core\entities\peer\ParamPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = net\keeko\cms\core\entities\peer\ParamPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = net\keeko\cms\core\entities\peer\ParamPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					net\keeko\cms\core\entities\peer\ParamPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Param)
				$obj2->addBlockAction($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
		$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol2 = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\BlockPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (net\keeko\cms\core\entities\peer\BlockPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\ActionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (net\keeko\cms\core\entities\peer\ActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\ParamPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (net\keeko\cms\core\entities\peer\ParamPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\ParamPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
		$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined net\keeko\cms\core\entities\Block rows

			$key2 = net\keeko\cms\core\entities\peer\BlockPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = net\keeko\cms\core\entities\peer\BlockPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = net\keeko\cms\core\entities\peer\BlockPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					net\keeko\cms\core\entities\peer\BlockPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj2 (net\keeko\cms\core\entities\Block)
				$obj2->addBlockAction($obj1);
			} // if joined row not null

			// Add objects for joined net\keeko\cms\core\entities\Action rows

			$key3 = net\keeko\cms\core\entities\peer\ActionPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = net\keeko\cms\core\entities\peer\ActionPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = net\keeko\cms\core\entities\peer\ActionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					net\keeko\cms\core\entities\peer\ActionPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj3 (net\keeko\cms\core\entities\Action)
				$obj3->addBlockAction($obj1);
			} // if joined row not null

			// Add objects for joined net\keeko\cms\core\entities\Param rows

			$key4 = net\keeko\cms\core\entities\peer\ParamPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = net\keeko\cms\core\entities\peer\ParamPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = net\keeko\cms\core\entities\peer\ParamPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					net\keeko\cms\core\entities\peer\ParamPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj4 (net\keeko\cms\core\entities\Param)
				$obj4->addBlockAction($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Block table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptBlock(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Action table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAction(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Param table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptParam(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
				$criteria->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with all related objects except Block.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptBlock(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol2 = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);
				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined net\keeko\cms\core\entities\Action rows

				$key2 = net\keeko\cms\core\entities\peer\ActionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = net\keeko\cms\core\entities\peer\ActionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = net\keeko\cms\core\entities\peer\ActionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					net\keeko\cms\core\entities\peer\ActionPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Action)
				$obj2->addBlockAction($obj1);

			} // if joined row is not null

				// Add objects for joined net\keeko\cms\core\entities\Param rows

				$key3 = net\keeko\cms\core\entities\peer\ParamPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = net\keeko\cms\core\entities\peer\ParamPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = net\keeko\cms\core\entities\peer\ParamPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					net\keeko\cms\core\entities\peer\ParamPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj3 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Param)
				$obj3->addBlockAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with all related objects except Action.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAction(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol2 = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ParamPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::PARAM_ID,), array(net\keeko\cms\core\entities\peer\ParamPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined net\keeko\cms\core\entities\Block rows

				$key2 = net\keeko\cms\core\entities\peer\BlockPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = net\keeko\cms\core\entities\peer\BlockPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = net\keeko\cms\core\entities\peer\BlockPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					net\keeko\cms\core\entities\peer\BlockPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Block)
				$obj2->addBlockAction($obj1);

			} // if joined row is not null

				// Add objects for joined net\keeko\cms\core\entities\Param rows

				$key3 = net\keeko\cms\core\entities\peer\ParamPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = net\keeko\cms\core\entities\peer\ParamPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = net\keeko\cms\core\entities\peer\ParamPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					net\keeko\cms\core\entities\peer\ParamPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj3 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Param)
				$obj3->addBlockAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of net\keeko\cms\core\entities\BlockAction objects pre-filled with all related objects except Param.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of net\keeko\cms\core\entities\BlockAction objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptParam(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		net\keeko\cms\core\entities\peer\BlockActionPeer::addSelectColumns($c);
		$startcol2 = (net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\BlockActionPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\BlockPeer::NUM_LAZY_LOAD_COLUMNS);

		net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::NUM_COLUMNS - net\keeko\cms\core\entities\peer\net\keeko\cms\core\entities\peer\ActionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID,), array(net\keeko\cms\core\entities\peer\BlockPeer::ID,), $join_behavior);
				$c->addJoin(array(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID,), array(net\keeko\cms\core\entities\peer\ActionPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = net\keeko\cms\core\entities\peer\BlockActionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				net\keeko\cms\core\entities\peer\BlockActionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined net\keeko\cms\core\entities\Block rows

				$key2 = net\keeko\cms\core\entities\peer\BlockPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = net\keeko\cms\core\entities\peer\BlockPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = net\keeko\cms\core\entities\peer\BlockPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					net\keeko\cms\core\entities\peer\BlockPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj2 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Block)
				$obj2->addBlockAction($obj1);

			} // if joined row is not null

				// Add objects for joined net\keeko\cms\core\entities\Action rows

				$key3 = net\keeko\cms\core\entities\peer\ActionPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = net\keeko\cms\core\entities\peer\ActionPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = net\keeko\cms\core\entities\peer\ActionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					net\keeko\cms\core\entities\peer\ActionPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (net\keeko\cms\core\entities\BlockAction) to the collection in $obj3 (net\keeko\cms\core\entities\net\keeko\cms\core\entities\Action)
				$obj3->addBlockAction($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return \Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
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
		return net\keeko\cms\core\entities\peer\BlockActionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a net\keeko\cms\core\entities\BlockAction or Criteria object.
	 *
	 * @param      mixed $values Criteria or net\keeko\cms\core\entities\BlockAction object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from net\keeko\cms\core\entities\BlockAction object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = \BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(\PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a net\keeko\cms\core\entities\BlockAction or Criteria object.
	 *
	 * @param      mixed $values Criteria or net\keeko\cms\core\entities\BlockAction object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new \Criteria(self::DATABASE_NAME);

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID);
			$selectCriteria->add(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID, $criteria->remove(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID), $comparison);

			$comparison = $criteria->getComparison(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID);
			$selectCriteria->add(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID, $criteria->remove(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID), $comparison);

		} else { // $values is net\keeko\cms\core\entities\BlockAction object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return \BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the block_action table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += \BasePeer::doDeleteAll(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (\PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a net\keeko\cms\core\entities\BlockAction or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or net\keeko\cms\core\entities\BlockAction object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, \PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			net\keeko\cms\core\entities\peer\BlockActionPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof net\keeko\cms\core\entities\BlockAction) {
			// invalidate the cache for this single object
			net\keeko\cms\core\entities\peer\BlockActionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new \Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID, $value[1]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				net\keeko\cms\core\entities\peer\BlockActionPeer::removeInstanceFromPool($value);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += \BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (\ PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given net\keeko\cms\core\entities\BlockAction object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      net\keeko\cms\core\entities\BlockAction $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(net\keeko\cms\core\entities\BlockAction $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = \Propel::getDatabaseMap(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME);

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

		return \BasePeer::doValidate(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $block_id
	   @param      int $action_id
	   
	 * @param      PropelPDO $con
	 * @return     net\keeko\cms\core\entities\BlockAction
	 */
	public static function retrieveByPK($block_id, $action_id, \PropelPDO $con = null) {
		$key = serialize(array((string) $block_id, (string) $action_id));
 		if (null !== ($obj = net\keeko\cms\core\entities\peer\BlockActionPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = \Propel::getConnection(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
		$criteria = new \Criteria(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME);
		$criteria->add(net\keeko\cms\core\entities\peer\BlockActionPeer::BLOCK_ID, $block_id);
		$criteria->add(net\keeko\cms\core\entities\peer\BlockActionPeer::ACTION_ID, $action_id);
		$v = net\keeko\cms\core\entities\peer\BlockActionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // net\keeko\cms\core\entities\peer\BaseBlockActionPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the net\keeko\cms\core\entities\peer\BlockActionPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the net\keeko\cms\core\entities\peer\BlockActionPeer class:
//
// Propel::getDatabaseMap(net\keeko\cms\core\entities\peer\BlockActionPeer::DATABASE_NAME)->addTableBuilder(net\keeko\cms\core\entities\peer\BlockActionPeer::TABLE_NAME, net\keeko\cms\core\entities\peer\BlockActionPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

\Propel::getDatabaseMap(net\keeko\cms\core\entities\peer\BaseBlockActionPeer::DATABASE_NAME)->addTableBuilder(net\keeko\cms\core\entities\peer\BaseBlockActionPeer::TABLE_NAME, net\keeko\cms\core\entities\peer\BaseBlockActionPeer::getMapBuilder());
