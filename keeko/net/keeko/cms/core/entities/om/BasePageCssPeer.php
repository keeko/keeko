<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::map::PageCssMapBuilder;
use net::keeko::cms::core::entities::TablePeer;
use net::keeko::cms::core::entities::PageCssPeer;
use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::PageCss;



/**
 * Base static class for performing query and update operations on the 'page_css' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BasePageCssPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'page_css';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.PageCss';

	/** The total number of columns. */
	const NUM_COLUMNS = 3;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'page_css.ID';

	/** the column name for the PAGE_ID field */
	const PAGE_ID = 'page_css.PAGE_ID';

	/** the column name for the PATH field */
	const PATH = 'page_css.PATH';

	/**
	 * An identiy map to hold any loaded instances of PageCss objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array PageCss[]
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
		::BasePeer::TYPE_PHPNAME => array ('Id', 'PageId', 'Path', ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'pageId', 'path', ),
		::BasePeer::TYPE_COLNAME => array (self::ID, self::PAGE_ID, self::PATH, ),
		::BasePeer::TYPE_FIELDNAME => array ('id', 'page_id', 'path', ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[::BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		::BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PageId' => 1, 'Path' => 2, ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'pageId' => 1, 'path' => 2, ),
		::BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PAGE_ID => 1, self::PATH => 2, ),
		::BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'page_id' => 1, 'path' => 2, ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * Get a (singleton) instance of the ::MapBuilder for this peer class.
	 * @return     ::MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PageCssMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. PageCssPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PageCssPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PageCssPeer::ID);

		$criteria->addSelectColumn(PageCssPeer::PAGE_ID);

		$criteria->addSelectColumn(PageCssPeer::PATH);

	}

	const COUNT = 'COUNT(page_css.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT page_css.ID)';

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
			$criteria->addSelectColumn(PageCssPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PageCssPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$stmt = PageCssPeer::doSelectStmt($criteria, $con);
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
	 * @return     PageCss
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectOne(::Criteria $criteria, ::PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PageCssPeer::doSelect($critcopy, $con);
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
		return PageCssPeer::populateObjects(PageCssPeer::doSelectStmt($criteria, $con));
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
			PageCssPeer::addSelectColumns($criteria);
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
	 * @param      PageCss $value A PageCss object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(PageCss $obj, $key = null)
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
	 * @param      mixed $value A PageCss object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (::Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PageCss) {
				$key = (string) $value->getPrimaryKey();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = serialize($value);
			} else {
				$e = new ::PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PageCss object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     PageCss Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = PageCssPeer::getOMClass();
		$cls = str_replace('.', '::', $cls);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PageCssPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PageCssPeer::getInstanceFromPool($key))) {
				$obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PageCssPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Page table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPage(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PageCssPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PageCssPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PageCssPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = PageCssPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PageCss objects pre-filled with their Page objects.
	 *
	 * @return     array Array of PageCss objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinPage(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PageCssPeer::addSelectColumns($c);
		$startcol = (PageCssPeer::NUM_COLUMNS - PageCssPeer::NUM_LAZY_LOAD_COLUMNS);
		PagePeer::addSelectColumns($c);

		$c->addJoin(PageCssPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PageCssPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PageCssPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PageCssPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PageCssPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = PagePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PagePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PagePeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PagePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PageCss) to $obj2 (Page)
				$obj2->addPageCss($obj1);

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
			$criteria->addSelectColumn(PageCssPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PageCssPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PageCssPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = PageCssPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PageCss objects pre-filled with all related objects.
	 *
	 * @return     array Array of PageCss objects.
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

		PageCssPeer::addSelectColumns($c);
		$startcol2 = (PageCssPeer::NUM_COLUMNS - PageCssPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(PageCssPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PageCssPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PageCssPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PageCssPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PageCssPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Page rows

			$key2 = PagePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = PagePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PagePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PagePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (PageCss) to the collection in $obj2 (Page)
				$obj2->addPageCss($obj1);
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
		return PageCssPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PageCss or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or PageCss object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build ::Criteria from PageCss object
		}

		$criteria->remove(PageCssPeer::ID); // remove pkey col since this table uses auto-increment


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
	 * Method perform an UPDATE on the database, given a PageCss or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or PageCss object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(PageCssPeer::ID);
			$selectCriteria->add(PageCssPeer::ID, $criteria->remove(PageCssPeer::ID), $comparison);

		} else { // $values is PageCss object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return ::BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the page_css table.
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
			$affectedRows += ::BasePeer::doDeleteAll(PageCssPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PageCss or ::Criteria object OR a primary key value.
	 *
	 * @param      mixed $values ::Criteria or PageCss object or primary key or array of primary keys
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
			$con = ::Propel::getConnection(PageCssPeer::DATABASE_NAME);
		}

		if ($values instanceof ::Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this ::Criteria.
			PageCssPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof PageCss) {
			// invalidate the cache for this single object
			PageCssPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key

			// we can invalidate the cache for this single object
			PageCssPeer::removeInstanceFromPool($values);

			$criteria = new ::Criteria(self::DATABASE_NAME);
			$criteria->add(PageCssPeer::ID, (array) $values, ::Criteria::IN);
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
	 * Validates all modified columns of given PageCss object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PageCss $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PageCss $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = ::Propel::getDatabaseMap(PageCssPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PageCssPeer::TABLE_NAME);

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

		return ::BasePeer::doValidate(PageCssPeer::DATABASE_NAME, PageCssPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      ::PropelPDO $con the connection to use
	 * @return     PageCss
	 */
	public static function retrieveByPK($pk, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new ::Criteria(PageCssPeer::DATABASE_NAME);

		$criteria->add(PageCssPeer::ID, $pk);


		$v = PageCssPeer::doSelect($criteria, $con);

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
			$criteria->add(PageCssPeer::ID, $pks, ::Criteria::IN);
			$objs = PageCssPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasePageCssPeer

// This is the static code needed to register the ::MapBuilder for this table with the main ::Propel class.
//
// NOTE: This static code cannot call methods on the PageCssPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the PageCssPeer class:
//
// ::Propel::getDatabaseMap(PageCssPeer::DATABASE_NAME)->addTableBuilder(PageCssPeer::TABLE_NAME, PageCssPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

::Propel::getDatabaseMap(BasePageCssPeer::DATABASE_NAME)->addTableBuilder(BasePageCssPeer::TABLE_NAME, BasePageCssPeer::getMapBuilder());

