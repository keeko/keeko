<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::map::MenuItemMapBuilder;
use net::keeko::cms::core::entities::TablePeer;
use net::keeko::cms::core::entities::MenuItemPeer;
use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::LanguageTextPeer;
use net::keeko::cms::core::entities::MenuPeer;
use net::keeko::cms::core::entities::ModulePeer;
use net::keeko::cms::core::entities::ActionPeer;
use net::keeko::cms::core::entities::MenuItem;



/**
 * Base static class for performing query and update operations on the 'menu_item' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseMenuItemPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'keeko';

	/** the table name for this class */
	const TABLE_NAME = 'menu_item';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'net.keeko.cms.core.entities.MenuItem';

	/** The total number of columns. */
	const NUM_COLUMNS = 11;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'menu_item.ID';

	/** the column name for the PARENT_ID field */
	const PARENT_ID = 'menu_item.PARENT_ID';

	/** the column name for the MENU_ID field */
	const MENU_ID = 'menu_item.MENU_ID';

	/** the column name for the TEXT_ID field */
	const TEXT_ID = 'menu_item.TEXT_ID';

	/** the column name for the PAGE_ID field */
	const PAGE_ID = 'menu_item.PAGE_ID';

	/** the column name for the MODULE_ID field */
	const MODULE_ID = 'menu_item.MODULE_ID';

	/** the column name for the ACTION_ID field */
	const ACTION_ID = 'menu_item.ACTION_ID';

	/** the column name for the EVENT field */
	const EVENT = 'menu_item.EVENT';

	/** the column name for the IMAGE field */
	const IMAGE = 'menu_item.IMAGE';

	/** the column name for the SORTORDER field */
	const SORTORDER = 'menu_item.SORTORDER';

	/** the column name for the EXTRA field */
	const EXTRA = 'menu_item.EXTRA';

	/**
	 * An identiy map to hold any loaded instances of MenuItem objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array MenuItem[]
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
		::BasePeer::TYPE_PHPNAME => array ('Id', 'ParentId', 'MenuId', 'TextId', 'PageId', 'ModuleId', 'ActionId', 'Event', 'Image', 'Sortorder', 'Extra', ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'parentId', 'menuId', 'textId', 'pageId', 'moduleId', 'actionId', 'event', 'image', 'sortorder', 'extra', ),
		::BasePeer::TYPE_COLNAME => array (self::ID, self::PARENT_ID, self::MENU_ID, self::TEXT_ID, self::PAGE_ID, self::MODULE_ID, self::ACTION_ID, self::EVENT, self::IMAGE, self::SORTORDER, self::EXTRA, ),
		::BasePeer::TYPE_FIELDNAME => array ('id', 'parent_id', 'menu_id', 'text_id', 'page_id', 'module_id', 'action_id', 'event', 'image', 'sortorder', 'extra', ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[::BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		::BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ParentId' => 1, 'MenuId' => 2, 'TextId' => 3, 'PageId' => 4, 'ModuleId' => 5, 'ActionId' => 6, 'Event' => 7, 'Image' => 8, 'Sortorder' => 9, 'Extra' => 10, ),
		::BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'parentId' => 1, 'menuId' => 2, 'textId' => 3, 'pageId' => 4, 'moduleId' => 5, 'actionId' => 6, 'event' => 7, 'image' => 8, 'sortorder' => 9, 'extra' => 10, ),
		::BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PARENT_ID => 1, self::MENU_ID => 2, self::TEXT_ID => 3, self::PAGE_ID => 4, self::MODULE_ID => 5, self::ACTION_ID => 6, self::EVENT => 7, self::IMAGE => 8, self::SORTORDER => 9, self::EXTRA => 10, ),
		::BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'parent_id' => 1, 'menu_id' => 2, 'text_id' => 3, 'page_id' => 4, 'module_id' => 5, 'action_id' => 6, 'event' => 7, 'image' => 8, 'sortorder' => 9, 'extra' => 10, ),
		::BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * Get a (singleton) instance of the ::MapBuilder for this peer class.
	 * @return     ::MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new MenuItemMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. MenuItemPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MenuItemPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(MenuItemPeer::ID);

		$criteria->addSelectColumn(MenuItemPeer::PARENT_ID);

		$criteria->addSelectColumn(MenuItemPeer::MENU_ID);

		$criteria->addSelectColumn(MenuItemPeer::TEXT_ID);

		$criteria->addSelectColumn(MenuItemPeer::PAGE_ID);

		$criteria->addSelectColumn(MenuItemPeer::MODULE_ID);

		$criteria->addSelectColumn(MenuItemPeer::ACTION_ID);

		$criteria->addSelectColumn(MenuItemPeer::EVENT);

		$criteria->addSelectColumn(MenuItemPeer::IMAGE);

		$criteria->addSelectColumn(MenuItemPeer::SORTORDER);

		$criteria->addSelectColumn(MenuItemPeer::EXTRA);

	}

	const COUNT = 'COUNT(menu_item.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT menu_item.ID)';

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
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
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
	 * @return     MenuItem
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectOne(::Criteria $criteria, ::PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MenuItemPeer::doSelect($critcopy, $con);
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
		return MenuItemPeer::populateObjects(MenuItemPeer::doSelectStmt($criteria, $con));
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
			MenuItemPeer::addSelectColumns($criteria);
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
	 * @param      MenuItem $value A MenuItem object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(MenuItem $obj, $key = null)
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
	 * @param      mixed $value A MenuItem object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (::Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof MenuItem) {
				$key = (string) $value->getPrimaryKey();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = serialize($value);
			} else {
				$e = new ::PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or MenuItem object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     MenuItem Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = MenuItemPeer::getOMClass();
		$cls = str_replace('.', '::', $cls);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = MenuItemPeer::getInstanceFromPool($key))) {
				$obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				MenuItemPeer::addInstanceToPool($obj, $key);
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
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related LanguageText table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguageText(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Menu table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMenu(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Module table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinModule(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
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
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with their Page objects.
	 *
	 * @return     array Array of MenuItem objects.
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

		MenuItemPeer::addSelectColumns($c);
		$startcol = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);
		PagePeer::addSelectColumns($c);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (MenuItem) to $obj2 (Page)
				$obj2->addMenuItem($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with their LanguageText objects.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinLanguageText(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);
		LanguageTextPeer::addSelectColumns($c);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = LanguageTextPeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MenuItem) to $obj2 (LanguageText)
				$obj2->addMenuItem($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with their Menu objects.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinMenu(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);
		MenuPeer::addSelectColumns($c);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = MenuPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = MenuPeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					MenuPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MenuItem) to $obj2 (Menu)
				$obj2->addMenuItem($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with their Module objects.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinModule(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);
		ModulePeer::addSelectColumns($c);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ModulePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ModulePeer::getOMClass();

					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ModulePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MenuItem) to $obj2 (Module)
				$obj2->addMenuItem($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with their Action objects.
	 *
	 * @return     array Array of MenuItem objects.
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

		MenuItemPeer::addSelectColumns($c);
		$startcol = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);
		ActionPeer::addSelectColumns($c);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);
		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (MenuItem) to $obj2 (Action)
				$obj2->addMenuItem($obj1);

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
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects.
	 *
	 * @return     array Array of MenuItem objects.
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

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItem($obj1);
			} // if joined row not null

			// Add objects for joined LanguageText rows

			$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (LanguageText)
				$obj3->addMenuItem($obj1);
			} // if joined row not null

			// Add objects for joined Menu rows

			$key4 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = MenuPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MenuPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Menu)
				$obj4->addMenuItem($obj1);
			} // if joined row not null

			// Add objects for joined Module rows

			$key5 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = ModulePeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ModulePeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Module)
				$obj5->addMenuItem($obj1);
			} // if joined row not null

			// Add objects for joined Action rows

			$key6 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = ActionPeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					ActionPeer::addInstanceToPool($obj6, $key6);
				} // if obj6 loaded

				// Add the $obj1 (MenuItem) to the collection in $obj6 (Action)
				$obj6->addMenuItem($obj1);
			} // if joined row not null

			$results[] = $obj1;
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
	public static function doCountJoinAllExceptPage(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related LanguageText table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLanguageText(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Menu table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMenu(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related MenuItemRelatedByParentId table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMenuItemRelatedByParentId(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Module table
	 *
	 * @param      ::Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in ::Criteria).
	 * @param      ::PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptModule(::Criteria $criteria, $distinct = false, ::PropelPDO $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(::Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
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
			$criteria->addSelectColumn(MenuItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MenuItemPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach ($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$criteria->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$stmt = MenuItemPeer::doSelectStmt($criteria, $con);
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			return (int) $row[0];
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except Page.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptPage(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined LanguageText rows

				$key2 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = LanguageTextPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					LanguageTextPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (LanguageText)
				$obj2->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Menu rows

				$key3 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = MenuPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MenuPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (Menu)
				$obj3->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Module rows

				$key4 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = ModulePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ModulePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Module)
				$obj4->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key5 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ActionPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ActionPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Action)
				$obj5->addMenuItem($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except LanguageText.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptLanguageText(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Menu rows

				$key3 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = MenuPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MenuPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (Menu)
				$obj3->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Module rows

				$key4 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = ModulePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ModulePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Module)
				$obj4->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key5 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ActionPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ActionPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Action)
				$obj5->addMenuItem($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except Menu.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptMenu(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (LanguageText)
				$obj3->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Module rows

				$key4 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = ModulePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ModulePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Module)
				$obj4->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key5 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ActionPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ActionPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Action)
				$obj5->addMenuItem($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except MenuItemRelatedByParentId.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptMenuItemRelatedByParentId(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItemRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (LanguageText)
				$obj3->addMenuItemRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined Menu rows

				$key4 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = MenuPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MenuPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Menu)
				$obj4->addMenuItemRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined Module rows

				$key5 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ModulePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ModulePeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Module)
				$obj5->addMenuItemRelatedByParentId($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key6 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = ActionPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					ActionPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj6 (Action)
				$obj6->addMenuItemRelatedByParentId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except Module.
	 *
	 * @return     array Array of MenuItem objects.
	 * @throws     ::PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a ::PropelException.
	 */
	public static function doSelectJoinAllExceptModule(::Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == ::Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ActionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ActionPeer::NUM_COLUMNS - ActionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::ACTION_ID, ActionPeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (LanguageText)
				$obj3->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Menu rows

				$key4 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = MenuPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MenuPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Menu)
				$obj4->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Action rows

				$key5 = ActionPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ActionPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ActionPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ActionPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Action)
				$obj5->addMenuItem($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MenuItem objects pre-filled with all related objects except Action.
	 *
	 * @return     array Array of MenuItem objects.
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

		MenuItemPeer::addSelectColumns($c);
		$startcol2 = (MenuItemPeer::NUM_COLUMNS - MenuItemPeer::NUM_LAZY_LOAD_COLUMNS);

		PagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS);

		LanguageTextPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS);

		MenuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (MenuPeer::NUM_COLUMNS - MenuPeer::NUM_LAZY_LOAD_COLUMNS);

		ModulePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(MenuItemPeer::PAGE_ID, PagePeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::TEXT_ID, LanguageTextPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MENU_ID, MenuPeer::ID, ::Criteria::LEFT_JOIN);

		$c->addJoin(MenuItemPeer::MODULE_ID, ModulePeer::ID, ::Criteria::LEFT_JOIN);


		$stmt = ::BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MenuItemPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== (MenuItemPeer::getInstanceFromPool($key1))) {
				$obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = MenuItemPeer::getOMClass();

				$cls = str_replace('.', '::', $omClass);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				MenuItemPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj2 (Page)
				$obj2->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined LanguageText rows

				$key3 = LanguageTextPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = LanguageTextPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = LanguageTextPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					LanguageTextPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj3 (LanguageText)
				$obj3->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Menu rows

				$key4 = MenuPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = MenuPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = MenuPeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MenuPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj4 (Menu)
				$obj4->addMenuItem($obj1);

			} // if joined row is not null

				// Add objects for joined Module rows

				$key5 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = ModulePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = ModulePeer::getOMClass();


					$cls = str_replace('.', '::', $omClass);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					ModulePeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (MenuItem) to the collection in $obj5 (Module)
				$obj5->addMenuItem($obj1);

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
		return MenuItemPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a MenuItem or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or MenuItem object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build ::Criteria from MenuItem object
		}

		$criteria->remove(MenuItemPeer::ID); // remove pkey col since this table uses auto-increment


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
	 * Method perform an UPDATE on the database, given a MenuItem or ::Criteria object.
	 *
	 * @param      mixed $values ::Criteria or MenuItem object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(MenuItemPeer::ID);
			$selectCriteria->add(MenuItemPeer::ID, $criteria->remove(MenuItemPeer::ID), $comparison);

		} else { // $values is MenuItem object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return ::BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the menu_item table.
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
			$affectedRows += ::BasePeer::doDeleteAll(MenuItemPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a MenuItem or ::Criteria object OR a primary key value.
	 *
	 * @param      mixed $values ::Criteria or MenuItem object or primary key or array of primary keys
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
			$con = ::Propel::getConnection(MenuItemPeer::DATABASE_NAME);
		}

		if ($values instanceof ::Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this ::Criteria.
			MenuItemPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof MenuItem) {
			// invalidate the cache for this single object
			MenuItemPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key

			// we can invalidate the cache for this single object
			MenuItemPeer::removeInstanceFromPool($values);

			$criteria = new ::Criteria(self::DATABASE_NAME);
			$criteria->add(MenuItemPeer::ID, (array) $values, ::Criteria::IN);
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
	 * Validates all modified columns of given MenuItem object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      MenuItem $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(MenuItem $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = ::Propel::getDatabaseMap(MenuItemPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MenuItemPeer::TABLE_NAME);

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

		return ::BasePeer::doValidate(MenuItemPeer::DATABASE_NAME, MenuItemPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      ::PropelPDO $con the connection to use
	 * @return     MenuItem
	 */
	public static function retrieveByPK($pk, ::PropelPDO $con = null)
	{
		if ($con === null) {
			$con = ::Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new ::Criteria(MenuItemPeer::DATABASE_NAME);

		$criteria->add(MenuItemPeer::ID, $pk);


		$v = MenuItemPeer::doSelect($criteria, $con);

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
			$criteria->add(MenuItemPeer::ID, $pks, ::Criteria::IN);
			$objs = MenuItemPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseMenuItemPeer

// This is the static code needed to register the ::MapBuilder for this table with the main ::Propel class.
//
// NOTE: This static code cannot call methods on the MenuItemPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the MenuItemPeer class:
//
// ::Propel::getDatabaseMap(MenuItemPeer::DATABASE_NAME)->addTableBuilder(MenuItemPeer::TABLE_NAME, MenuItemPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

::Propel::getDatabaseMap(BaseMenuItemPeer::DATABASE_NAME)->addTableBuilder(BaseMenuItemPeer::TABLE_NAME, BaseMenuItemPeer::getMapBuilder());

