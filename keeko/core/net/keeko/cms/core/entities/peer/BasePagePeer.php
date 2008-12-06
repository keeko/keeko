<?php

namespace net\keeko\cms\core\entities\peer;

/**
 * Base static class for performing query and update operations on the 'page' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BasePagePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'page';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.\net\keeko\cms\core\entities\Page';

	/** The total number of columns. */
	const NUM_COLUMNS = 6;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'page.ID';

	/** the column name for the APP_ID field */
	const APP_ID = 'page.APP_ID';

	/** the column name for the PARENT_ID field */
	const PARENT_ID = 'page.PARENT_ID';

	/** the column name for the KEYWORDS_ID field */
	const KEYWORDS_ID = 'page.KEYWORDS_ID';

	/** the column name for the DESCRIPTION_ID field */
	const DESCRIPTION_ID = 'page.DESCRIPTION_ID';

	/** the column name for the TITLE_ID field */
	const TITLE_ID = 'page.TITLE_ID';

	/**
	 * An identiy map to hold any loaded instances of \net\keeko\cms\core\entities\Page objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array \net\keeko\cms\core\entities\Page[]
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
		\BasePeer::TYPE_PHPNAME => array ('Id', 'AppId', 'ParentId', 'KeywordsId', 'DescriptionId', 'TitleId', ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'appId', 'parentId', 'keywordsId', 'descriptionId', 'titleId', ),
		\BasePeer::TYPE_COLNAME => array (self::ID, self::APP_ID, self::PARENT_ID, self::KEYWORDS_ID, self::DESCRIPTION_ID, self::TITLE_ID, ),
		\BasePeer::TYPE_FIELDNAME => array ('id', 'app_id', 'parent_id', 'keywords_id', 'description_id', 'title_id', ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		\BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AppId' => 1, 'ParentId' => 2, 'KeywordsId' => 3, 'DescriptionId' => 4, 'TitleId' => 5, ),
		\BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'appId' => 1, 'parentId' => 2, 'keywordsId' => 3, 'descriptionId' => 4, 'titleId' => 5, ),
		\BasePeer::TYPE_COLNAME => array (self::ID => 0, self::APP_ID => 1, self::PARENT_ID => 2, self::KEYWORDS_ID => 3, self::DESCRIPTION_ID => 4, self::TITLE_ID => 5, ),
		\BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'app_id' => 1, 'parent_id' => 2, 'keywords_id' => 3, 'description_id' => 4, 'title_id' => 5, ),
		\BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new \net\keeko\cms\core\entities\map\PageMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. PagePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PagePeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PagePeer::ID);

		$criteria->addSelectColumn(PagePeer::APP_ID);

		$criteria->addSelectColumn(PagePeer::PARENT_ID);

		$criteria->addSelectColumn(PagePeer::KEYWORDS_ID);

		$criteria->addSelectColumn(PagePeer::DESCRIPTION_ID);

		$criteria->addSelectColumn(PagePeer::TITLE_ID);

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
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
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
	 * @return     \net\keeko\cms\core\entities\Page
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(\Criteria $criteria, \PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PagePeer::doSelect($critcopy, $con);
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
		return PagePeer::populateObjects(PagePeer::doSelectStmt($criteria, $con));
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
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PagePeer::addSelectColumns($criteria);
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
	 * @param      \net\keeko\cms\core\entities\Page $value A \net\keeko\cms\core\entities\Page object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(\net\keeko\cms\core\entities\Page $obj, $key = null)
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
	 * @param      mixed $value A \net\keeko\cms\core\entities\Page object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (\Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof \net\keeko\cms\core\entities\Page) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new \PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \net\keeko\cms\core\entities\Page object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     \net\keeko\cms\core\entities\Page Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = PagePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PagePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PagePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByTitleId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguageTextRelatedByTitleId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByDescriptionId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguageTextRelatedByDescriptionId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByKeywordsId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguageTextRelatedByKeywordsId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related App table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinApp(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with their \net\keeko\cms\core\entities\LanguageText objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinLanguageTextRelatedByTitleId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);
		LanguageTextPeer::addSelectColumns($c);

		$c->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguageTextPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPageRelatedByTitleId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with their \net\keeko\cms\core\entities\LanguageText objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinLanguageTextRelatedByDescriptionId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);
		LanguageTextPeer::addSelectColumns($c);

		$c->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguageTextPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPageRelatedByDescriptionId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with their \net\keeko\cms\core\entities\LanguageText objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinLanguageTextRelatedByKeywordsId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);
		LanguageTextPeer::addSelectColumns($c);

		$c->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguageTextPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPageRelatedByKeywordsId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with their \net\keeko\cms\core\entities\App objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinApp(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);
		AppPeer::addSelectColumns($c);

		$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AppPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AppPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AppPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\App)
				$obj2->addPage($obj1);

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
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);

		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$criteria->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$criteria->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
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

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		AppPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (AppPeer::NUM_COLUMNS - AppPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$c->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$c->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
		$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

			$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPageRelatedByTitleId($obj1);
			} // if joined row not null

			// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

			$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj3 (\net\keeko\cms\core\entities\LanguageText)
				$obj3->addPageRelatedByDescriptionId($obj1);
			} // if joined row not null

			// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

			$key4 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = LanguageTextPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					LanguageTextPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj4 (\net\keeko\cms\core\entities\LanguageText)
				$obj4->addPageRelatedByKeywordsId($obj1);
			} // if joined row not null

			// Add objects for joined \net\keeko\cms\core\entities\App rows

			$key5 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = AppPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = AppPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AppPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj5 (\net\keeko\cms\core\entities\App)
				$obj5->addPage($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByTitleId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLanguageTextRelatedByTitleId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByDescriptionId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLanguageTextRelatedByDescriptionId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related LanguageTextRelatedByKeywordsId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLanguageTextRelatedByKeywordsId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related PageRelatedByParentId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPageRelatedByParentId(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$criteria->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$criteria->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$criteria->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related App table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptApp(\Criteria $criteria, $distinct = false, \PropelPDO $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PagePeer::TABLE_NAME);
		
		if ($distinct && !in_array(\Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PagePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$criteria->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$criteria->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
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
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects except LanguageTextRelatedByTitleId.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptLanguageTextRelatedByTitleId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		AppPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AppPeer::NUM_COLUMNS - AppPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined \net\keeko\cms\core\entities\App rows

				$key2 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AppPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AppPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\App)
				$obj2->addPageRelatedByTitleId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects except LanguageTextRelatedByDescriptionId.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptLanguageTextRelatedByDescriptionId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		AppPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AppPeer::NUM_COLUMNS - AppPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined \net\keeko\cms\core\entities\App rows

				$key2 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AppPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AppPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\App)
				$obj2->addPageRelatedByDescriptionId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects except LanguageTextRelatedByKeywordsId.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptLanguageTextRelatedByKeywordsId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		AppPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AppPeer::NUM_COLUMNS - AppPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined \net\keeko\cms\core\entities\App rows

				$key2 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AppPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AppPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AppPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\App)
				$obj2->addPageRelatedByKeywordsId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects except PageRelatedByParentId.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPageRelatedByParentId(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		AppPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (AppPeer::NUM_COLUMNS - AppPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$c->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$c->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$c->addJoin(array(PagePeer::APP_ID,), array(AppPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPageRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj3 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj3->addPageRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key4 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = LanguageTextPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					LanguageTextPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj4 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj4->addPageRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined \net\keeko\cms\core\entities\App rows

				$key5 = AppPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AppPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AppPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AppPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj5 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\App)
				$obj5->addPageRelatedByParentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of \net\keeko\cms\core\entities\Page objects pre-filled with all related objects except App.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to \Criteria::LEFT_JOIN
	 * @return     array Array of \net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptApp(\Criteria $c, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == \Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PagePeer::addSelectColumns($c);
		$startcol2 = (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PagePeer::TITLE_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$c->addJoin(array(PagePeer::DESCRIPTION_ID,), array(LanguageTextPeer::ID,), $join_behavior);
				$c->addJoin(array(PagePeer::KEYWORDS_ID,), array(LanguageTextPeer::ID,), $join_behavior);

		$stmt = \BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
			$key1 = PagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PagePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PagePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PagePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj2 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj2->addPage($obj1);

			} // if joined row is not null

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj3 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj3->addPage($obj1);

			} // if joined row is not null

				// Add objects for joined \net\keeko\cms\core\entities\LanguageText rows

				$key4 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = LanguageTextPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					LanguageTextPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (\net\keeko\cms\core\entities\Page) to the collection in $obj4 (\net\keeko\cms\core\entities\\net\keeko\cms\core\entities\LanguageText)
				$obj4->addPage($obj1);

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
		return PagePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a \net\keeko\cms\core\entities\Page or Criteria object.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Page object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from \net\keeko\cms\core\entities\Page object
		}

		if ($criteria->containsKey(PagePeer::ID) && $criteria->keyContainsValue(PagePeer::ID) ) {
			throw new \PropelException('Cannot insert a value for auto-increment primary key ('.PagePeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a \net\keeko\cms\core\entities\Page or Criteria object.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Page object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, \PropelPDO $con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new \Criteria(self::DATABASE_NAME);

		if ($values instanceof \Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(PagePeer::ID);
			$selectCriteria->add(PagePeer::ID, $criteria->remove(PagePeer::ID), $comparison);

		} else { // $values is \net\keeko\cms\core\entities\Page object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return \BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the page table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += \BasePeer::doDeleteAll(PagePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (\PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a \net\keeko\cms\core\entities\Page or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or \net\keeko\cms\core\entities\Page object or primary key or array of primary keys
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
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}

		if ($values instanceof \Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			PagePeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof \net\keeko\cms\core\entities\Page) {
			// invalidate the cache for this single object
			PagePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new \Criteria(self::DATABASE_NAME);
			$criteria->add(PagePeer::ID, (array) $values, \Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				PagePeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given \net\keeko\cms\core\entities\Page object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      \net\keeko\cms\core\entities\Page $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(\net\keeko\cms\core\entities\Page $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = \Propel::getDatabaseMap(PagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PagePeer::TABLE_NAME);

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

		return \BasePeer::doValidate(PagePeer::DATABASE_NAME, PagePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     \net\keeko\cms\core\entities\Page
	 */
	public static function retrieveByPK($pk, \PropelPDO $con = null)
	{
		if (null !== ($obj = PagePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$criteria = new \Criteria(PagePeer::DATABASE_NAME);
		$criteria->add(PagePeer::ID, $pk);

		$v = PagePeer::doSelect($criteria, $con);
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
			$con = \Propel::getConnection(PagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new \Criteria(PagePeer::DATABASE_NAME);
			$criteria->add(PagePeer::ID, $pks, \Criteria::IN);
			$objs = PagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasePagePeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the PagePeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the PagePeer class:
//
// Propel::getDatabaseMap(PagePeer::DATABASE_NAME)->addTableBuilder(PagePeer::TABLE_NAME, PagePeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

\Propel::getDatabaseMap(BasePagePeer::DATABASE_NAME)->addTableBuilder(BasePagePeer::TABLE_NAME, BasePagePeer::getMapBuilder());
