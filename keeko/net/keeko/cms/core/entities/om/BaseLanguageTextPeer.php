<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::map::LanguageTextMapBuilder;
use net::keeko::cms::core::entities::TablePeer;
use net::keeko::cms::core::entities::LanguageTextPeer;
use net::keeko::cms::core::entities::LanguagePeer;
use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::LanguageText;



/**
 * Base static class for performing query and update operations on the 'language_text' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLanguageTextPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'language_text';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.LanguageText';

	/** The total number of columns. */
	const NUM_COLUMNS = 3;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'language_text.ID';

	/** the column name for the LANGUAGE_ID field */
	const LANGUAGE_ID = 'language_text.LANGUAGE_ID';

	/** the column name for the CONTENT field */
	const CONTENT = 'language_text.CONTENT';

	/**
	 * An identiy map to hold any loaded instances of LanguageText objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array LanguageText[]
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
		::BasePeer::TYPE_PHPNAME => array ('Id', 'LanguageId', 'Content', ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'languageId', 'content', ),
		::BasePeer::TYPE_COLNAME => array (self::ID, self::LANGUAGE_ID, self::CONTENT, ),
		::BasePeer::TYPE_FIELDNAME => array ('id', 'language_id', 'content', ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[::BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		::BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LanguageId' => 1, 'Content' => 2, ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'languageId' => 1, 'content' => 2, ),
		::BasePeer::TYPE_COLNAME => array (self::ID => 0, self::LANGUAGE_ID => 1, self::CONTENT => 2, ),
		::BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'language_id' => 1, 'content' => 2, ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * Get a (singleton) instance of the ::MapBuilder for this peer class.
	 * @return     ::MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new LanguageTextMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. LanguageTextPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(LanguageTextPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(LanguageTextPeer::ID);

		$criteria->addSelectColumn(LanguageTextPeer::LANGUAGE_ID);

		$criteria->addSelectColumn(LanguageTextPeer::CONTENT);

	}

	const COUNT = 'COUNT(language_text.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT language_text.ID)';

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
			$criteria->addSelectColumn(LanguageTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LanguageTextPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$stmt = LanguageTextPeer::doSelectStmt($criteria, $con);
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
	 * @return     LanguageText
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectOne(::Criteria $criteria, ::PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = LanguageTextPeer::doSelect($critcopy, $con);
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
		return LanguageTextPeer::populateObjects(LanguageTextPeer::doSelectStmt($criteria, $con));
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
			LanguageTextPeer::addSelectColumns($criteria);
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
	 * @param      LanguageText $value A LanguageText object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(LanguageText $obj, $key = null)
	{
		if (::Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getPrimaryKey();
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
	 * @param      mixed $value A LanguageText object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (::Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof LanguageText) {
				$key = (string) $value->getPrimaryKey();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = serialize($value);
			} else {
				$e = new ::PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or LanguageText object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     LanguageText Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null) {
			return null;
		}

		return (string) $row[$startcol + 0];
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
		$cls = LanguageTextPeer::getOMClass();
		$cls = str_replace('.', '::', $cls);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = LanguageTextPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = LanguageTextPeer::getInstanceFromPool($key))) {
				$obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				LanguageTextPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Language table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguage(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LanguageTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LanguageTextPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LanguageTextPeer::LANGUAGE_ID, LanguagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = LanguageTextPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of LanguageText objects pre-filled with their Language objects.
	 *
	 * @return     array Array of LanguageText objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinLanguage(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LanguageTextPeer::addSelectColumns($c);
		$startcol = (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);
		LanguagePeer::addSelectColumns($c);

		$c->addJoin(LanguageTextPeer::LANGUAGE_ID, LanguagePeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanguageTextPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = LanguageTextPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanguageTextPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = LanguagePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = LanguagePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguagePeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					LanguagePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (LanguageText) to $obj2 (Language)
				$obj2->addLanguageText($obj1);

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
			$criteria->addSelectColumn(LanguageTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LanguageTextPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LanguageTextPeer::LANGUAGE_ID, LanguagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = LanguageTextPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of LanguageText objects pre-filled with all related objects.
	 *
	 * @return     array Array of LanguageText objects.
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

		LanguageTextPeer::addSelectColumns($c);
		$startcol2 = (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (LanguagePeer::NUM_COLUMNS - LanguagePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(LanguageTextPeer::LANGUAGE_ID, LanguagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = LanguageTextPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = LanguageTextPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				LanguageTextPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Language rows

			$key2 = LanguagePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = LanguagePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguagePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					LanguagePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (LanguageText) to the collection in $obj2 (Language)
				$obj2->addLanguageText($obj1);
			} // if joined row not null

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
		return LanguageTextPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a LanguageText or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or LanguageText object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build ::Criteria from LanguageText object
		}

		$criteria->remove(LanguageTextPeer::ID); // remove pkey col since this table uses auto-increment


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
	 * Method perform an UPDATE on the database, given a LanguageText or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or LanguageText object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(LanguageTextPeer::ID);
			$selectCriteria->add(LanguageTextPeer::ID, $criteria->remove(LanguageTextPeer::ID), $comparison);

		} else { // $values is LanguageText object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return ::BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the language_text table.
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
			$affectedRows += LanguageTextPeer::doOnDeleteCascade(new ::Criteria(), $con);
			$affectedRows += ::BasePeer::doDeleteAll(LanguageTextPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a LanguageText or ::Criteria object OR a primary key value.
	 *
	 * @param      mixed $values ::Criteria or LanguageText object or primary key or array of primary keys
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
			$con = ::Propel::getConnection(LanguageTextPeer::DATABASE_NAME);
		}

		if ($values instanceof ::Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this ::Criteria.
			LanguageTextPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof LanguageText) {
			// invalidate the cache for this single object
			LanguageTextPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key

			// we can invalidate the cache for this single object
			LanguageTextPeer::removeInstanceFromPool($values);

			$criteria = new ::Criteria(self::DATABASE_NAME);
			$criteria->add(LanguageTextPeer::ID, (array) $values, ::Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += LanguageTextPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += ::BasePeer::doDelete($criteria, $con);

			// invalidate objects in PagePeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			PagePeer::clearInstancePool();

			// invalidate objects in PagePeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			PagePeer::clearInstancePool();

			// invalidate objects in PagePeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			PagePeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
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
	 * @param      ::Criteria $criteria
	 * @param      ::PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(::Criteria $criteria, ::PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = LanguageTextPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related Page objects
			$c = new ::Criteria();
			
			$c->add(PagePeer::TITLE_ID, $obj->getId());
			$affectedRows += PagePeer::doDelete($c, $con);

			// delete related Page objects
			$c = new ::Criteria();
			
			$c->add(PagePeer::DESCRIPTION_ID, $obj->getId());
			$affectedRows += PagePeer::doDelete($c, $con);

			// delete related Page objects
			$c = new ::Criteria();
			
			$c->add(PagePeer::KEYWORDS_ID, $obj->getId());
			$affectedRows += PagePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given LanguageText object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      LanguageText $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(LanguageText $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = ::Propel::getDatabaseMap(LanguageTextPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LanguageTextPeer::TABLE_NAME);

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

		return ::BasePeer::doValidate(LanguageTextPeer::DATABASE_NAME, LanguageTextPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      ::PropelPDO $con the connection to use
	 * @return     LanguageText
	 */
	public static function retrieveByPK($pk, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new ::Criteria(LanguageTextPeer::DATABASE_NAME);

		$criteria->add(LanguageTextPeer::ID, $pk);


		$v = LanguageTextPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      ::PropelPDO $con the connection to use
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function retrieveByPKs($pks, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new ::Criteria();
			$criteria->add(LanguageTextPeer::ID, $pks, ::Criteria::IN);
			$objs = LanguageTextPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseLanguageTextPeer

// This is the static code needed to register the ::MapBuilder for this table with the main ::Propel class.
//
// NOTE: This static code cannot call methods on the LanguageTextPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the LanguageTextPeer class:
//
// ::Propel::getDatabaseMap(LanguageTextPeer::DATABASE_NAME)->addTableBuilder(LanguageTextPeer::TABLE_NAME, LanguageTextPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

::Propel::getDatabaseMap(BaseLanguageTextPeer::DATABASE_NAME)->addTableBuilder(BaseLanguageTextPeer::TABLE_NAME, BaseLanguageTextPeer::getMapBuilder());
