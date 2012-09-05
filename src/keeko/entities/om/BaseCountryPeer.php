<?php

namespace keeko\entities\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use keeko\entities\Country;
use keeko\entities\CountryPeer;
use keeko\entities\CurrencyPeer;
use keeko\entities\TerritoryPeer;
use keeko\entities\map\CountryTableMap;

/**
 * Base static class for performing query and update operations on the 'keeko_country' table.
 *
 *
 *
 * @package propel.generator.keeko.entities.om
 */
abstract class BaseCountryPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'keeko';

    /** the table name for this class */
    const TABLE_NAME = 'keeko_country';

    /** the related Propel class for this table */
    const OM_CLASS = 'keeko\\entities\\Country';

    /** the related TableMap class for this table */
    const TM_CLASS = 'CountryTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 17;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 17;

    /** the column name for the ISO_NR field */
    const ISO_NR = 'keeko_country.ISO_NR';

    /** the column name for the ALPHA_2 field */
    const ALPHA_2 = 'keeko_country.ALPHA_2';

    /** the column name for the ALPHA_3 field */
    const ALPHA_3 = 'keeko_country.ALPHA_3';

    /** the column name for the IOC field */
    const IOC = 'keeko_country.IOC';

    /** the column name for the CAPITAL field */
    const CAPITAL = 'keeko_country.CAPITAL';

    /** the column name for the TLD field */
    const TLD = 'keeko_country.TLD';

    /** the column name for the PHONE field */
    const PHONE = 'keeko_country.PHONE';

    /** the column name for the TERRITORY_ISO_NR field */
    const TERRITORY_ISO_NR = 'keeko_country.TERRITORY_ISO_NR';

    /** the column name for the CURRENCY_ISO_NR field */
    const CURRENCY_ISO_NR = 'keeko_country.CURRENCY_ISO_NR';

    /** the column name for the OFFICIAL_LOCAL_NAME field */
    const OFFICIAL_LOCAL_NAME = 'keeko_country.OFFICIAL_LOCAL_NAME';

    /** the column name for the OFFICIAL_EN_NAME field */
    const OFFICIAL_EN_NAME = 'keeko_country.OFFICIAL_EN_NAME';

    /** the column name for the SHORT_LOCAL_NAME field */
    const SHORT_LOCAL_NAME = 'keeko_country.SHORT_LOCAL_NAME';

    /** the column name for the SHORT_EN_NAME field */
    const SHORT_EN_NAME = 'keeko_country.SHORT_EN_NAME';

    /** the column name for the BBOX_SW_LAT field */
    const BBOX_SW_LAT = 'keeko_country.BBOX_SW_LAT';

    /** the column name for the BBOX_SW_LNG field */
    const BBOX_SW_LNG = 'keeko_country.BBOX_SW_LNG';

    /** the column name for the BBOX_NE_LAT field */
    const BBOX_NE_LAT = 'keeko_country.BBOX_NE_LAT';

    /** the column name for the BBOX_NE_LNG field */
    const BBOX_NE_LNG = 'keeko_country.BBOX_NE_LNG';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Country objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Country[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. CountryPeer::$fieldNames[CountryPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IsoNr', 'Alpha2', 'Alpha3', 'Ioc', 'Capital', 'Tld', 'Phone', 'TerritoryIsoNr', 'CurrencyIsoNr', 'OfficialLocalName', 'OfficialEnName', 'ShortLocalName', 'ShortEnName', 'BboxSwLat', 'BboxSwLng', 'BboxNeLat', 'BboxNeLng', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('isoNr', 'alpha2', 'alpha3', 'ioc', 'capital', 'tld', 'phone', 'territoryIsoNr', 'currencyIsoNr', 'officialLocalName', 'officialEnName', 'shortLocalName', 'shortEnName', 'bboxSwLat', 'bboxSwLng', 'bboxNeLat', 'bboxNeLng', ),
        BasePeer::TYPE_COLNAME => array (CountryPeer::ISO_NR, CountryPeer::ALPHA_2, CountryPeer::ALPHA_3, CountryPeer::IOC, CountryPeer::CAPITAL, CountryPeer::TLD, CountryPeer::PHONE, CountryPeer::TERRITORY_ISO_NR, CountryPeer::CURRENCY_ISO_NR, CountryPeer::OFFICIAL_LOCAL_NAME, CountryPeer::OFFICIAL_EN_NAME, CountryPeer::SHORT_LOCAL_NAME, CountryPeer::SHORT_EN_NAME, CountryPeer::BBOX_SW_LAT, CountryPeer::BBOX_SW_LNG, CountryPeer::BBOX_NE_LAT, CountryPeer::BBOX_NE_LNG, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ISO_NR', 'ALPHA_2', 'ALPHA_3', 'IOC', 'CAPITAL', 'TLD', 'PHONE', 'TERRITORY_ISO_NR', 'CURRENCY_ISO_NR', 'OFFICIAL_LOCAL_NAME', 'OFFICIAL_EN_NAME', 'SHORT_LOCAL_NAME', 'SHORT_EN_NAME', 'BBOX_SW_LAT', 'BBOX_SW_LNG', 'BBOX_NE_LAT', 'BBOX_NE_LNG', ),
        BasePeer::TYPE_FIELDNAME => array ('iso_nr', 'alpha_2', 'alpha_3', 'ioc', 'capital', 'tld', 'phone', 'territory_iso_nr', 'currency_iso_nr', 'official_local_name', 'official_en_name', 'short_local_name', 'short_en_name', 'bbox_sw_lat', 'bbox_sw_lng', 'bbox_ne_lat', 'bbox_ne_lng', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CountryPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IsoNr' => 0, 'Alpha2' => 1, 'Alpha3' => 2, 'Ioc' => 3, 'Capital' => 4, 'Tld' => 5, 'Phone' => 6, 'TerritoryIsoNr' => 7, 'CurrencyIsoNr' => 8, 'OfficialLocalName' => 9, 'OfficialEnName' => 10, 'ShortLocalName' => 11, 'ShortEnName' => 12, 'BboxSwLat' => 13, 'BboxSwLng' => 14, 'BboxNeLat' => 15, 'BboxNeLng' => 16, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('isoNr' => 0, 'alpha2' => 1, 'alpha3' => 2, 'ioc' => 3, 'capital' => 4, 'tld' => 5, 'phone' => 6, 'territoryIsoNr' => 7, 'currencyIsoNr' => 8, 'officialLocalName' => 9, 'officialEnName' => 10, 'shortLocalName' => 11, 'shortEnName' => 12, 'bboxSwLat' => 13, 'bboxSwLng' => 14, 'bboxNeLat' => 15, 'bboxNeLng' => 16, ),
        BasePeer::TYPE_COLNAME => array (CountryPeer::ISO_NR => 0, CountryPeer::ALPHA_2 => 1, CountryPeer::ALPHA_3 => 2, CountryPeer::IOC => 3, CountryPeer::CAPITAL => 4, CountryPeer::TLD => 5, CountryPeer::PHONE => 6, CountryPeer::TERRITORY_ISO_NR => 7, CountryPeer::CURRENCY_ISO_NR => 8, CountryPeer::OFFICIAL_LOCAL_NAME => 9, CountryPeer::OFFICIAL_EN_NAME => 10, CountryPeer::SHORT_LOCAL_NAME => 11, CountryPeer::SHORT_EN_NAME => 12, CountryPeer::BBOX_SW_LAT => 13, CountryPeer::BBOX_SW_LNG => 14, CountryPeer::BBOX_NE_LAT => 15, CountryPeer::BBOX_NE_LNG => 16, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ISO_NR' => 0, 'ALPHA_2' => 1, 'ALPHA_3' => 2, 'IOC' => 3, 'CAPITAL' => 4, 'TLD' => 5, 'PHONE' => 6, 'TERRITORY_ISO_NR' => 7, 'CURRENCY_ISO_NR' => 8, 'OFFICIAL_LOCAL_NAME' => 9, 'OFFICIAL_EN_NAME' => 10, 'SHORT_LOCAL_NAME' => 11, 'SHORT_EN_NAME' => 12, 'BBOX_SW_LAT' => 13, 'BBOX_SW_LNG' => 14, 'BBOX_NE_LAT' => 15, 'BBOX_NE_LNG' => 16, ),
        BasePeer::TYPE_FIELDNAME => array ('iso_nr' => 0, 'alpha_2' => 1, 'alpha_3' => 2, 'ioc' => 3, 'capital' => 4, 'tld' => 5, 'phone' => 6, 'territory_iso_nr' => 7, 'currency_iso_nr' => 8, 'official_local_name' => 9, 'official_en_name' => 10, 'short_local_name' => 11, 'short_en_name' => 12, 'bbox_sw_lat' => 13, 'bbox_sw_lng' => 14, 'bbox_ne_lat' => 15, 'bbox_ne_lng' => 16, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = CountryPeer::getFieldNames($toType);
        $key = isset(CountryPeer::$fieldKeys[$fromType][$name]) ? CountryPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CountryPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, CountryPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CountryPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. CountryPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CountryPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CountryPeer::ISO_NR);
            $criteria->addSelectColumn(CountryPeer::ALPHA_2);
            $criteria->addSelectColumn(CountryPeer::ALPHA_3);
            $criteria->addSelectColumn(CountryPeer::IOC);
            $criteria->addSelectColumn(CountryPeer::CAPITAL);
            $criteria->addSelectColumn(CountryPeer::TLD);
            $criteria->addSelectColumn(CountryPeer::PHONE);
            $criteria->addSelectColumn(CountryPeer::TERRITORY_ISO_NR);
            $criteria->addSelectColumn(CountryPeer::CURRENCY_ISO_NR);
            $criteria->addSelectColumn(CountryPeer::OFFICIAL_LOCAL_NAME);
            $criteria->addSelectColumn(CountryPeer::OFFICIAL_EN_NAME);
            $criteria->addSelectColumn(CountryPeer::SHORT_LOCAL_NAME);
            $criteria->addSelectColumn(CountryPeer::SHORT_EN_NAME);
            $criteria->addSelectColumn(CountryPeer::BBOX_SW_LAT);
            $criteria->addSelectColumn(CountryPeer::BBOX_SW_LNG);
            $criteria->addSelectColumn(CountryPeer::BBOX_NE_LAT);
            $criteria->addSelectColumn(CountryPeer::BBOX_NE_LNG);
        } else {
            $criteria->addSelectColumn($alias . '.ISO_NR');
            $criteria->addSelectColumn($alias . '.ALPHA_2');
            $criteria->addSelectColumn($alias . '.ALPHA_3');
            $criteria->addSelectColumn($alias . '.IOC');
            $criteria->addSelectColumn($alias . '.CAPITAL');
            $criteria->addSelectColumn($alias . '.TLD');
            $criteria->addSelectColumn($alias . '.PHONE');
            $criteria->addSelectColumn($alias . '.TERRITORY_ISO_NR');
            $criteria->addSelectColumn($alias . '.CURRENCY_ISO_NR');
            $criteria->addSelectColumn($alias . '.OFFICIAL_LOCAL_NAME');
            $criteria->addSelectColumn($alias . '.OFFICIAL_EN_NAME');
            $criteria->addSelectColumn($alias . '.SHORT_LOCAL_NAME');
            $criteria->addSelectColumn($alias . '.SHORT_EN_NAME');
            $criteria->addSelectColumn($alias . '.BBOX_SW_LAT');
            $criteria->addSelectColumn($alias . '.BBOX_SW_LNG');
            $criteria->addSelectColumn($alias . '.BBOX_NE_LAT');
            $criteria->addSelectColumn($alias . '.BBOX_NE_LNG');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CountryPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Country
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CountryPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return CountryPeer::populateObjects(CountryPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CountryPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
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
     * @param      Country $obj A Country object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIsoNr();
            } // if key === null
            CountryPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Country object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Country) {
                $key = (string) $value->getIsoNr();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Country object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CountryPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Country Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CountryPeer::$instances[$key])) {
                return CountryPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        CountryPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to keeko_country
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = CountryPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CountryPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CountryPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Country object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CountryPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CountryPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CountryPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CountryPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CountryPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Territory table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinTerritory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Currency table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinCurrency(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Country objects pre-filled with their Territory objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Country objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTerritory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CountryPeer::DATABASE_NAME);
        }

        CountryPeer::addSelectColumns($criteria);
        $startcol = CountryPeer::NUM_HYDRATE_COLUMNS;
        TerritoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CountryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CountryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CountryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = TerritoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = TerritoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TerritoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    TerritoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Country) to $obj2 (Territory)
                $obj2->addCountry($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Country objects pre-filled with their Currency objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Country objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinCurrency(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CountryPeer::DATABASE_NAME);
        }

        CountryPeer::addSelectColumns($criteria);
        $startcol = CountryPeer::NUM_HYDRATE_COLUMNS;
        CurrencyPeer::addSelectColumns($criteria);

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CountryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CountryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CountryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = CurrencyPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = CurrencyPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CurrencyPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    CurrencyPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Country) to $obj2 (Currency)
                $obj2->addCountry($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of Country objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Country objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CountryPeer::DATABASE_NAME);
        }

        CountryPeer::addSelectColumns($criteria);
        $startcol2 = CountryPeer::NUM_HYDRATE_COLUMNS;

        TerritoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TerritoryPeer::NUM_HYDRATE_COLUMNS;

        CurrencyPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + CurrencyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CountryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CountryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CountryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Territory rows

            $key2 = TerritoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = TerritoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TerritoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TerritoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Country) to the collection in $obj2 (Territory)
                $obj2->addCountry($obj1);
            } // if joined row not null

            // Add objects for joined Currency rows

            $key3 = CurrencyPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = CurrencyPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = CurrencyPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    CurrencyPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Country) to the collection in $obj3 (Currency)
                $obj3->addCountry($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Territory table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptTerritory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Currency table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptCurrency(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CountryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CountryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Country objects pre-filled with all related objects except Territory.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Country objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptTerritory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CountryPeer::DATABASE_NAME);
        }

        CountryPeer::addSelectColumns($criteria);
        $startcol2 = CountryPeer::NUM_HYDRATE_COLUMNS;

        CurrencyPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CurrencyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CountryPeer::CURRENCY_ISO_NR, CurrencyPeer::ISO_NR, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CountryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CountryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CountryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Currency rows

                $key2 = CurrencyPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = CurrencyPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = CurrencyPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CurrencyPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Country) to the collection in $obj2 (Currency)
                $obj2->addCountry($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Country objects pre-filled with all related objects except Currency.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Country objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptCurrency(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CountryPeer::DATABASE_NAME);
        }

        CountryPeer::addSelectColumns($criteria);
        $startcol2 = CountryPeer::NUM_HYDRATE_COLUMNS;

        TerritoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TerritoryPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CountryPeer::TERRITORY_ISO_NR, TerritoryPeer::ISO_NR, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CountryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CountryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CountryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CountryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Territory rows

                $key2 = TerritoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = TerritoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = TerritoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TerritoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Country) to the collection in $obj2 (Territory)
                $obj2->addCountry($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(CountryPeer::DATABASE_NAME)->getTable(CountryPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCountryPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCountryPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new CountryTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return CountryPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Country or Criteria object.
     *
     * @param      mixed $values Criteria or Country object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Country object
        }


        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Country or Criteria object.
     *
     * @param      mixed $values Criteria or Country object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CountryPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CountryPeer::ISO_NR);
            $value = $criteria->remove(CountryPeer::ISO_NR);
            if ($value) {
                $selectCriteria->add(CountryPeer::ISO_NR, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CountryPeer::TABLE_NAME);
            }

        } else { // $values is Country object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the keeko_country table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(CountryPeer::TABLE_NAME, $con, CountryPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CountryPeer::clearInstancePool();
            CountryPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Country or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Country object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            CountryPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Country) { // it's a model object
            // invalidate the cache for this single object
            CountryPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CountryPeer::DATABASE_NAME);
            $criteria->add(CountryPeer::ISO_NR, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                CountryPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(CountryPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CountryPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Country object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Country $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CountryPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CountryPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(CountryPeer::DATABASE_NAME, CountryPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Country
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CountryPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CountryPeer::DATABASE_NAME);
        $criteria->add(CountryPeer::ISO_NR, $pk);

        $v = CountryPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Country[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CountryPeer::DATABASE_NAME);
            $criteria->add(CountryPeer::ISO_NR, $pks, Criteria::IN);
            $objs = CountryPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseCountryPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCountryPeer::buildTableMap();

