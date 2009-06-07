<?php

namespace net\keeko\cms\core\entities\peer;

/**
 * Base static class for performing query and update operations on the 'language' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLanguagePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'language';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.\net\keeko\cms\core\entities\Language';

	/** The total number of columns. */
	const NUM_COLUMNS = 9;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'language.ID';

	/** the column name for the FALLBACK field */
	const FALLBACK = 'language.FALLBACK';

	/** the column name for the NAME field */
	const NAME = 'language.NAME';

	/** the column name for the COUNTRY field */
	const COUNTRY = 'language.COUNTRY';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'language.LANGUAGE';

	/** the column name for the VARIANT field */
	const VARIANT = 'language.VARIANT';

	/** the column name for the IS_DEFAULT field */
	const IS_DEFAULT = 'language.IS_DEFAULT';

	/** the column name for the IS_ACTIVE field */
	const IS_ACTIVE = 'language.IS_ACTIVE';

	/** the column name for the INTERFACE_LANGUAGE field */
	const INTERFACE_LANGUAGE = 'language.INTERFACE_LANGUAGE';

	/**
	 * An identiy map to hold any loaded instances of \net\keeko\cms\core\entities\Language objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array \net\keeko\cms\core\entities\Language[]
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
		\BasePeer::TYPE_PHPNAME => array ('Id', 'Fallback', 'Name', 'Country', 'Language', 'Variant', 'IsDefault', 'IsActive', 'InterfaceLanguage', ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'fallback', 'name', 'country', 'language', 'variant', 'isDefault', 'isActive', 'interfaceLanguage', ),
		\BasePeer::TYPE_COLNAME => array (self::ID, self::FALLBACK, self::NAME, self::COUNTRY, self::LANGUAGE, self::VARIANT, self::IS_DEFAULT, self::IS_ACTIVE, self::INTERFACE_LANGUAGE, ),
		\BasePeer::TYPE_FIELDNAME => array ('id', 'fallback', 'name', 'country', 'language', 'variant', 'is_default', 'is_active', 'interface_language', ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		\BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Fallback' => 1, 'Name' => 2, 'Country' => 3, 'Language' => 4, 'Variant' => 5, 'IsDefault' => 6, 'IsActive' => 7, 'InterfaceLanguage' => 8, ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'fallback' => 1, 'name' => 2, 'country' => 3, 'language' => 4, 'variant' => 5, 'isDefault' => 6, 'isActive' => 7, 'interfaceLanguage' => 8, ),
		\BasePeer::TYPE_COLNAME => array (self::ID => 0, self::FALLBACK => 1, self::NAME => 2, self::COUNTRY => 3, self::LANGUAGE => 4, self::VARIANT => 5, self::IS_DEFAULT => 6, self::IS_ACTIVE => 7, self::INTERFACE_LANGUAGE => 8, ),
		\BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'fallback' => 1, 'name' => 2, 'country' => 3, 'language' => 4, 'variant' => 5, 'is_default' => 6, 'is_active' => 7, 'interface_language' => 8, ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new \net\keeko\cms\core\entities\map\LanguageMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. LanguagePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(LanguagePeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(LanguagePeer::ID);

		$criteria->addSelectColumn(LanguagePeer::FALLBACK);

		$criteria->addSelectColumn(LanguagePeer::NAME);

		$criteria->addSelectColumn(LanguagePeer::COUNTRY);

		$criteria->addSelectColumn(LanguagePeer::LANGUAGE);

		$criteria->addSelectColumn(LanguagePeer::VARIANT);

		$criteria->addSelectColumn(LanguagePeer::IS_DEFAULT);

		$criteria->addSelectColumn(LanguagePeer::IS_ACTIVE);

		$criteria->addSelectColumn(LanguagePeer::INTERFACE_LANGUAGE);

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
		$criteria->setPrimaryTableName(LanguagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanguagePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
		// BasePeer returns a \PDOStatement
		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
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
	 * @return     \net\keeko\cms\core\entities\Language
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(\Criteria $criteria, \PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = LanguagePeer::doSelect($critcopy, $con);
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
		return LanguagePeer::populateObjects(LanguagePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a \PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     \PDOStatement The executed \PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(\Criteria $criteria, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			LanguagePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a \PDOStatement
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
	 * @param      \net\keeko\cms\core\entities\Language $value A \net\keeko\cms\core\entities\Language object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(\net\keeko\cms\core\entities\Language $obj, $key = null)
	{
		if (\Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
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
	 * @param      mixed $value A \net\keeko\cms\core\entities\Language object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (\Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof \net\keeko\cms\core\entities\Language) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new \PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \net\keeko\cms\core\entities\Language object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     \net\keeko\cms\core\entities\Language Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(\PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = LanguagePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key = LanguagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = LanguagePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				LanguagePeer::addInstanceToPool($obj, $key);
			} // if key exists
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
		$criteria->setPrimaryTableName(LanguagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanguagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$stmt = \BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Language objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Language objects.
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

		LanguagePeer::addSelectColumns($c);
		$startcol2 = (LanguagePeer::NUM_COLUMNS - LanguagePeer::NUM_LAZY_LOAD_COLUMNS);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = LanguagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanguagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = LanguagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanguagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

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
		return LanguagePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a \net\keeko\cms\core\entities\Language or Criteria object.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Language object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from \net\keeko\cms\core\entities\Language object
		}

		if ($criteria->containsKey(LanguagePeer::ID) && $criteria->keyContainsValue(LanguagePeer::ID) ) {
			throw new \PropelException('Cannot insert a value for auto-increment primary key ('.LanguagePeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a \net\keeko\cms\core\entities\Language or Criteria object.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Language object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new \Criteria(self::DATABASE_NAME);

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(LanguagePeer::ID);
			$selectCriteria->add(LanguagePeer::ID, $criteria->remove(LanguagePeer::ID), $comparison);

		} else { // $values is \net\keeko\cms\core\entities\Language object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return \BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the language table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += LanguagePeer::doOnDeleteCascade(new \Criteria(LanguagePeer::DATABASE_NAME), $con);
			$affectedRows += \BasePeer::doDeleteAll(LanguagePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (\PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a \net\keeko\cms\core\entities\Language or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Language object or primary key or array of primary keys
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
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			LanguagePeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof \net\keeko\cms\core\entities\Language) {
			// invalidate the cache for this single object
			LanguagePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new \Criteria(self::DATABASE_NAME);
			$criteria->add(LanguagePeer::ID, (array) $values, \Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				LanguagePeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += LanguagePeer::doOnDeleteCascade($criteria, $con);
			
				// Because this db requires some delete cascade/set null emulation, we have to
				// clear the cached instance *after* the emulation has happened (since
				// instances get re-added by the select statement contained therein).
				if ($values instanceof Criteria) {
					LanguagePeer::clearInstancePool();
				} else { // it's a PK or object
					LanguagePeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += \BasePeer::doDelete($criteria, $con);

			// invalidate objects in LanguageTextPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			LanguageTextPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (\ PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(\Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = LanguagePeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related \net\keeko\cms\core\entities\LanguageText objects
			$c = new \Criteria(LanguageTextPeer::DATABASE_NAME);
			
			$c->add(LanguageTextPeer::LANGUAGE_ID, $obj->getId());
			$affectedRows += LanguageTextPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given \net\keeko\cms\core\entities\Language object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      \net\keeko\cms\core\entities\Language $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(\net\keeko\cms\core\entities\Language $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = \Propel::getDatabaseMap(LanguagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LanguagePeer::TABLE_NAME);

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

		return \BasePeer::doValidate(LanguagePeer::DATABASE_NAME, LanguagePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     \net\keeko\cms\core\entities\Language
	 */
	public static function retrieveByPK($pk, \PropelPDO $con = null)
	{
		if (null !== ($obj = LanguagePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria = new \Criteria(LanguagePeer::DATABASE_NAME);
		$criteria->add(LanguagePeer::ID, $pk);

		$v = LanguagePeer::doSelect($criteria, $con);
		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new \Criteria(LanguagePeer::DATABASE_NAME);
			$criteria->add(LanguagePeer::ID, $pks, \Criteria::IN);
			$objs = LanguagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseLanguagePeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the LanguagePeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the LanguagePeer class:
//
// Propel::getDatabaseMap(LanguagePeer::DATABASE_NAME)->addTableBuilder(LanguagePeer::TABLE_NAME, LanguagePeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

\Propel::getDatabaseMap(BaseLanguagePeer::DATABASE_NAME)->addTableBuilder(BaseLanguagePeer::TABLE_NAME, BaseLanguagePeer::getMapBuilder());
