<?php

namespace keeko\entities\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use keeko\entities\Country;
use keeko\entities\CountryPeer;
use keeko\entities\CountryQuery;
use keeko\entities\Currency;
use keeko\entities\Localization;
use keeko\entities\Subdivision;
use keeko\entities\Territory;
use keeko\entities\User;

/**
 * Base class that represents a query for the 'keeko_country' table.
 *
 *
 *
 * @method CountryQuery orderByIsoNr($order = Criteria::ASC) Order by the iso_nr column
 * @method CountryQuery orderByAlpha2($order = Criteria::ASC) Order by the alpha_2 column
 * @method CountryQuery orderByAlpha3($order = Criteria::ASC) Order by the alpha_3 column
 * @method CountryQuery orderByIoc($order = Criteria::ASC) Order by the ioc column
 * @method CountryQuery orderByCapital($order = Criteria::ASC) Order by the capital column
 * @method CountryQuery orderByTld($order = Criteria::ASC) Order by the tld column
 * @method CountryQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method CountryQuery orderByTerritoryIsoNr($order = Criteria::ASC) Order by the territory_iso_nr column
 * @method CountryQuery orderByCurrencyIsoNr($order = Criteria::ASC) Order by the currency_iso_nr column
 * @method CountryQuery orderByOfficialLocalName($order = Criteria::ASC) Order by the official_local_name column
 * @method CountryQuery orderByOfficialEnName($order = Criteria::ASC) Order by the official_en_name column
 * @method CountryQuery orderByShortLocalName($order = Criteria::ASC) Order by the short_local_name column
 * @method CountryQuery orderByShortEnName($order = Criteria::ASC) Order by the short_en_name column
 * @method CountryQuery orderByBboxSwLat($order = Criteria::ASC) Order by the bbox_sw_lat column
 * @method CountryQuery orderByBboxSwLng($order = Criteria::ASC) Order by the bbox_sw_lng column
 * @method CountryQuery orderByBboxNeLat($order = Criteria::ASC) Order by the bbox_ne_lat column
 * @method CountryQuery orderByBboxNeLng($order = Criteria::ASC) Order by the bbox_ne_lng column
 *
 * @method CountryQuery groupByIsoNr() Group by the iso_nr column
 * @method CountryQuery groupByAlpha2() Group by the alpha_2 column
 * @method CountryQuery groupByAlpha3() Group by the alpha_3 column
 * @method CountryQuery groupByIoc() Group by the ioc column
 * @method CountryQuery groupByCapital() Group by the capital column
 * @method CountryQuery groupByTld() Group by the tld column
 * @method CountryQuery groupByPhone() Group by the phone column
 * @method CountryQuery groupByTerritoryIsoNr() Group by the territory_iso_nr column
 * @method CountryQuery groupByCurrencyIsoNr() Group by the currency_iso_nr column
 * @method CountryQuery groupByOfficialLocalName() Group by the official_local_name column
 * @method CountryQuery groupByOfficialEnName() Group by the official_en_name column
 * @method CountryQuery groupByShortLocalName() Group by the short_local_name column
 * @method CountryQuery groupByShortEnName() Group by the short_en_name column
 * @method CountryQuery groupByBboxSwLat() Group by the bbox_sw_lat column
 * @method CountryQuery groupByBboxSwLng() Group by the bbox_sw_lng column
 * @method CountryQuery groupByBboxNeLat() Group by the bbox_ne_lat column
 * @method CountryQuery groupByBboxNeLng() Group by the bbox_ne_lng column
 *
 * @method CountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CountryQuery leftJoinTerritory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territory relation
 * @method CountryQuery rightJoinTerritory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territory relation
 * @method CountryQuery innerJoinTerritory($relationAlias = null) Adds a INNER JOIN clause to the query using the Territory relation
 *
 * @method CountryQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method CountryQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method CountryQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method CountryQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method CountryQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method CountryQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method CountryQuery leftJoinLocalization($relationAlias = null) Adds a LEFT JOIN clause to the query using the Localization relation
 * @method CountryQuery rightJoinLocalization($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Localization relation
 * @method CountryQuery innerJoinLocalization($relationAlias = null) Adds a INNER JOIN clause to the query using the Localization relation
 *
 * @method CountryQuery leftJoinSubdivision($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subdivision relation
 * @method CountryQuery rightJoinSubdivision($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subdivision relation
 * @method CountryQuery innerJoinSubdivision($relationAlias = null) Adds a INNER JOIN clause to the query using the Subdivision relation
 *
 * @method Country findOne(PropelPDO $con = null) Return the first Country matching the query
 * @method Country findOneOrCreate(PropelPDO $con = null) Return the first Country matching the query, or a new Country object populated from the query conditions when no match is found
 *
 * @method Country findOneByAlpha2(string $alpha_2) Return the first Country filtered by the alpha_2 column
 * @method Country findOneByAlpha3(string $alpha_3) Return the first Country filtered by the alpha_3 column
 * @method Country findOneByIoc(string $ioc) Return the first Country filtered by the ioc column
 * @method Country findOneByCapital(string $capital) Return the first Country filtered by the capital column
 * @method Country findOneByTld(string $tld) Return the first Country filtered by the tld column
 * @method Country findOneByPhone(string $phone) Return the first Country filtered by the phone column
 * @method Country findOneByTerritoryIsoNr(int $territory_iso_nr) Return the first Country filtered by the territory_iso_nr column
 * @method Country findOneByCurrencyIsoNr(int $currency_iso_nr) Return the first Country filtered by the currency_iso_nr column
 * @method Country findOneByOfficialLocalName(string $official_local_name) Return the first Country filtered by the official_local_name column
 * @method Country findOneByOfficialEnName(string $official_en_name) Return the first Country filtered by the official_en_name column
 * @method Country findOneByShortLocalName(string $short_local_name) Return the first Country filtered by the short_local_name column
 * @method Country findOneByShortEnName(string $short_en_name) Return the first Country filtered by the short_en_name column
 * @method Country findOneByBboxSwLat(double $bbox_sw_lat) Return the first Country filtered by the bbox_sw_lat column
 * @method Country findOneByBboxSwLng(double $bbox_sw_lng) Return the first Country filtered by the bbox_sw_lng column
 * @method Country findOneByBboxNeLat(double $bbox_ne_lat) Return the first Country filtered by the bbox_ne_lat column
 * @method Country findOneByBboxNeLng(double $bbox_ne_lng) Return the first Country filtered by the bbox_ne_lng column
 *
 * @method array findByIsoNr(int $iso_nr) Return Country objects filtered by the iso_nr column
 * @method array findByAlpha2(string $alpha_2) Return Country objects filtered by the alpha_2 column
 * @method array findByAlpha3(string $alpha_3) Return Country objects filtered by the alpha_3 column
 * @method array findByIoc(string $ioc) Return Country objects filtered by the ioc column
 * @method array findByCapital(string $capital) Return Country objects filtered by the capital column
 * @method array findByTld(string $tld) Return Country objects filtered by the tld column
 * @method array findByPhone(string $phone) Return Country objects filtered by the phone column
 * @method array findByTerritoryIsoNr(int $territory_iso_nr) Return Country objects filtered by the territory_iso_nr column
 * @method array findByCurrencyIsoNr(int $currency_iso_nr) Return Country objects filtered by the currency_iso_nr column
 * @method array findByOfficialLocalName(string $official_local_name) Return Country objects filtered by the official_local_name column
 * @method array findByOfficialEnName(string $official_en_name) Return Country objects filtered by the official_en_name column
 * @method array findByShortLocalName(string $short_local_name) Return Country objects filtered by the short_local_name column
 * @method array findByShortEnName(string $short_en_name) Return Country objects filtered by the short_en_name column
 * @method array findByBboxSwLat(double $bbox_sw_lat) Return Country objects filtered by the bbox_sw_lat column
 * @method array findByBboxSwLng(double $bbox_sw_lng) Return Country objects filtered by the bbox_sw_lng column
 * @method array findByBboxNeLat(double $bbox_ne_lat) Return Country objects filtered by the bbox_ne_lat column
 * @method array findByBboxNeLng(double $bbox_ne_lng) Return Country objects filtered by the bbox_ne_lng column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseCountryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCountryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Country', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CountryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CountryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CountryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CountryQuery) {
            return $criteria;
        }
        $query = new CountryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Country|Country[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CountryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Country A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByIsoNr($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Country A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ISO_NR`, `ALPHA_2`, `ALPHA_3`, `IOC`, `CAPITAL`, `TLD`, `PHONE`, `TERRITORY_ISO_NR`, `CURRENCY_ISO_NR`, `OFFICIAL_LOCAL_NAME`, `OFFICIAL_EN_NAME`, `SHORT_LOCAL_NAME`, `SHORT_EN_NAME`, `BBOX_SW_LAT`, `BBOX_SW_LNG`, `BBOX_NE_LAT`, `BBOX_NE_LNG` FROM `keeko_country` WHERE `ISO_NR` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Country();
            $obj->hydrate($row);
            CountryPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Country|Country[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Country[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CountryPeer::ISO_NR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CountryPeer::ISO_NR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the iso_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoNr(1234); // WHERE iso_nr = 1234
     * $query->filterByIsoNr(array(12, 34)); // WHERE iso_nr IN (12, 34)
     * $query->filterByIsoNr(array('min' => 12)); // WHERE iso_nr > 12
     * </code>
     *
     * @param     mixed $isoNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByIsoNr($isoNr = null, $comparison = null)
    {
        if (is_array($isoNr) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CountryPeer::ISO_NR, $isoNr, $comparison);
    }

    /**
     * Filter the query on the alpha_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAlpha2('fooValue');   // WHERE alpha_2 = 'fooValue'
     * $query->filterByAlpha2('%fooValue%'); // WHERE alpha_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alpha2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByAlpha2($alpha2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alpha2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alpha2)) {
                $alpha2 = str_replace('*', '%', $alpha2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::ALPHA_2, $alpha2, $comparison);
    }

    /**
     * Filter the query on the alpha_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAlpha3('fooValue');   // WHERE alpha_3 = 'fooValue'
     * $query->filterByAlpha3('%fooValue%'); // WHERE alpha_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alpha3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByAlpha3($alpha3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alpha3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alpha3)) {
                $alpha3 = str_replace('*', '%', $alpha3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::ALPHA_3, $alpha3, $comparison);
    }

    /**
     * Filter the query on the ioc column
     *
     * Example usage:
     * <code>
     * $query->filterByIoc('fooValue');   // WHERE ioc = 'fooValue'
     * $query->filterByIoc('%fooValue%'); // WHERE ioc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ioc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByIoc($ioc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ioc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ioc)) {
                $ioc = str_replace('*', '%', $ioc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::IOC, $ioc, $comparison);
    }

    /**
     * Filter the query on the capital column
     *
     * Example usage:
     * <code>
     * $query->filterByCapital('fooValue');   // WHERE capital = 'fooValue'
     * $query->filterByCapital('%fooValue%'); // WHERE capital LIKE '%fooValue%'
     * </code>
     *
     * @param     string $capital The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByCapital($capital = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($capital)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $capital)) {
                $capital = str_replace('*', '%', $capital);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::CAPITAL, $capital, $comparison);
    }

    /**
     * Filter the query on the tld column
     *
     * Example usage:
     * <code>
     * $query->filterByTld('fooValue');   // WHERE tld = 'fooValue'
     * $query->filterByTld('%fooValue%'); // WHERE tld LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tld The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByTld($tld = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tld)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tld)) {
                $tld = str_replace('*', '%', $tld);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::TLD, $tld, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the territory_iso_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryIsoNr(1234); // WHERE territory_iso_nr = 1234
     * $query->filterByTerritoryIsoNr(array(12, 34)); // WHERE territory_iso_nr IN (12, 34)
     * $query->filterByTerritoryIsoNr(array('min' => 12)); // WHERE territory_iso_nr > 12
     * </code>
     *
     * @see       filterByTerritory()
     *
     * @param     mixed $territoryIsoNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByTerritoryIsoNr($territoryIsoNr = null, $comparison = null)
    {
        if (is_array($territoryIsoNr)) {
            $useMinMax = false;
            if (isset($territoryIsoNr['min'])) {
                $this->addUsingAlias(CountryPeer::TERRITORY_ISO_NR, $territoryIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryIsoNr['max'])) {
                $this->addUsingAlias(CountryPeer::TERRITORY_ISO_NR, $territoryIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::TERRITORY_ISO_NR, $territoryIsoNr, $comparison);
    }

    /**
     * Filter the query on the currency_iso_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyIsoNr(1234); // WHERE currency_iso_nr = 1234
     * $query->filterByCurrencyIsoNr(array(12, 34)); // WHERE currency_iso_nr IN (12, 34)
     * $query->filterByCurrencyIsoNr(array('min' => 12)); // WHERE currency_iso_nr > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $currencyIsoNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByCurrencyIsoNr($currencyIsoNr = null, $comparison = null)
    {
        if (is_array($currencyIsoNr)) {
            $useMinMax = false;
            if (isset($currencyIsoNr['min'])) {
                $this->addUsingAlias(CountryPeer::CURRENCY_ISO_NR, $currencyIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyIsoNr['max'])) {
                $this->addUsingAlias(CountryPeer::CURRENCY_ISO_NR, $currencyIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::CURRENCY_ISO_NR, $currencyIsoNr, $comparison);
    }

    /**
     * Filter the query on the official_local_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficialLocalName('fooValue');   // WHERE official_local_name = 'fooValue'
     * $query->filterByOfficialLocalName('%fooValue%'); // WHERE official_local_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officialLocalName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByOfficialLocalName($officialLocalName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officialLocalName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $officialLocalName)) {
                $officialLocalName = str_replace('*', '%', $officialLocalName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::OFFICIAL_LOCAL_NAME, $officialLocalName, $comparison);
    }

    /**
     * Filter the query on the official_en_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficialEnName('fooValue');   // WHERE official_en_name = 'fooValue'
     * $query->filterByOfficialEnName('%fooValue%'); // WHERE official_en_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officialEnName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByOfficialEnName($officialEnName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officialEnName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $officialEnName)) {
                $officialEnName = str_replace('*', '%', $officialEnName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::OFFICIAL_EN_NAME, $officialEnName, $comparison);
    }

    /**
     * Filter the query on the short_local_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShortLocalName('fooValue');   // WHERE short_local_name = 'fooValue'
     * $query->filterByShortLocalName('%fooValue%'); // WHERE short_local_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortLocalName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByShortLocalName($shortLocalName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortLocalName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shortLocalName)) {
                $shortLocalName = str_replace('*', '%', $shortLocalName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::SHORT_LOCAL_NAME, $shortLocalName, $comparison);
    }

    /**
     * Filter the query on the short_en_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShortEnName('fooValue');   // WHERE short_en_name = 'fooValue'
     * $query->filterByShortEnName('%fooValue%'); // WHERE short_en_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortEnName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByShortEnName($shortEnName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortEnName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shortEnName)) {
                $shortEnName = str_replace('*', '%', $shortEnName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::SHORT_EN_NAME, $shortEnName, $comparison);
    }

    /**
     * Filter the query on the bbox_sw_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByBboxSwLat(1234); // WHERE bbox_sw_lat = 1234
     * $query->filterByBboxSwLat(array(12, 34)); // WHERE bbox_sw_lat IN (12, 34)
     * $query->filterByBboxSwLat(array('min' => 12)); // WHERE bbox_sw_lat > 12
     * </code>
     *
     * @param     mixed $bboxSwLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByBboxSwLat($bboxSwLat = null, $comparison = null)
    {
        if (is_array($bboxSwLat)) {
            $useMinMax = false;
            if (isset($bboxSwLat['min'])) {
                $this->addUsingAlias(CountryPeer::BBOX_SW_LAT, $bboxSwLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bboxSwLat['max'])) {
                $this->addUsingAlias(CountryPeer::BBOX_SW_LAT, $bboxSwLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::BBOX_SW_LAT, $bboxSwLat, $comparison);
    }

    /**
     * Filter the query on the bbox_sw_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByBboxSwLng(1234); // WHERE bbox_sw_lng = 1234
     * $query->filterByBboxSwLng(array(12, 34)); // WHERE bbox_sw_lng IN (12, 34)
     * $query->filterByBboxSwLng(array('min' => 12)); // WHERE bbox_sw_lng > 12
     * </code>
     *
     * @param     mixed $bboxSwLng The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByBboxSwLng($bboxSwLng = null, $comparison = null)
    {
        if (is_array($bboxSwLng)) {
            $useMinMax = false;
            if (isset($bboxSwLng['min'])) {
                $this->addUsingAlias(CountryPeer::BBOX_SW_LNG, $bboxSwLng['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bboxSwLng['max'])) {
                $this->addUsingAlias(CountryPeer::BBOX_SW_LNG, $bboxSwLng['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::BBOX_SW_LNG, $bboxSwLng, $comparison);
    }

    /**
     * Filter the query on the bbox_ne_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByBboxNeLat(1234); // WHERE bbox_ne_lat = 1234
     * $query->filterByBboxNeLat(array(12, 34)); // WHERE bbox_ne_lat IN (12, 34)
     * $query->filterByBboxNeLat(array('min' => 12)); // WHERE bbox_ne_lat > 12
     * </code>
     *
     * @param     mixed $bboxNeLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByBboxNeLat($bboxNeLat = null, $comparison = null)
    {
        if (is_array($bboxNeLat)) {
            $useMinMax = false;
            if (isset($bboxNeLat['min'])) {
                $this->addUsingAlias(CountryPeer::BBOX_NE_LAT, $bboxNeLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bboxNeLat['max'])) {
                $this->addUsingAlias(CountryPeer::BBOX_NE_LAT, $bboxNeLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::BBOX_NE_LAT, $bboxNeLat, $comparison);
    }

    /**
     * Filter the query on the bbox_ne_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByBboxNeLng(1234); // WHERE bbox_ne_lng = 1234
     * $query->filterByBboxNeLng(array(12, 34)); // WHERE bbox_ne_lng IN (12, 34)
     * $query->filterByBboxNeLng(array('min' => 12)); // WHERE bbox_ne_lng > 12
     * </code>
     *
     * @param     mixed $bboxNeLng The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByBboxNeLng($bboxNeLng = null, $comparison = null)
    {
        if (is_array($bboxNeLng)) {
            $useMinMax = false;
            if (isset($bboxNeLng['min'])) {
                $this->addUsingAlias(CountryPeer::BBOX_NE_LNG, $bboxNeLng['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bboxNeLng['max'])) {
                $this->addUsingAlias(CountryPeer::BBOX_NE_LNG, $bboxNeLng['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::BBOX_NE_LNG, $bboxNeLng, $comparison);
    }

    /**
     * Filter the query by a related Territory object
     *
     * @param   Territory|PropelObjectCollection $territory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTerritory($territory, $comparison = null)
    {
        if ($territory instanceof Territory) {
            return $this
                ->addUsingAlias(CountryPeer::TERRITORY_ISO_NR, $territory->getIsoNr(), $comparison);
        } elseif ($territory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CountryPeer::TERRITORY_ISO_NR, $territory->toKeyValue('PrimaryKey', 'IsoNr'), $comparison);
        } else {
            throw new PropelException('filterByTerritory() only accepts arguments of type Territory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Territory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinTerritory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Territory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Territory');
        }

        return $this;
    }

    /**
     * Use the Territory relation Territory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\TerritoryQuery A secondary query class using the current class as primary query
     */
    public function useTerritoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTerritory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Territory', '\keeko\entities\TerritoryQuery');
    }

    /**
     * Filter the query by a related Currency object
     *
     * @param   Currency|PropelObjectCollection $currency The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof Currency) {
            return $this
                ->addUsingAlias(CountryPeer::CURRENCY_ISO_NR, $currency->getIsoNr(), $comparison);
        } elseif ($currency instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CountryPeer::CURRENCY_ISO_NR, $currency->toKeyValue('PrimaryKey', 'IsoNr'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type Currency or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\keeko\entities\CurrencyQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(CountryPeer::ISO_NR, $user->getCountryIsoNr(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\keeko\entities\UserQuery');
    }

    /**
     * Filter the query by a related Localization object
     *
     * @param   Localization|PropelObjectCollection $localization  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLocalization($localization, $comparison = null)
    {
        if ($localization instanceof Localization) {
            return $this
                ->addUsingAlias(CountryPeer::ISO_NR, $localization->getCountryIsoNr(), $comparison);
        } elseif ($localization instanceof PropelObjectCollection) {
            return $this
                ->useLocalizationQuery()
                ->filterByPrimaryKeys($localization->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLocalization() only accepts arguments of type Localization or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Localization relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinLocalization($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Localization');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Localization');
        }

        return $this;
    }

    /**
     * Use the Localization relation Localization object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LocalizationQuery A secondary query class using the current class as primary query
     */
    public function useLocalizationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLocalization($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Localization', '\keeko\entities\LocalizationQuery');
    }

    /**
     * Filter the query by a related Subdivision object
     *
     * @param   Subdivision|PropelObjectCollection $subdivision  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySubdivision($subdivision, $comparison = null)
    {
        if ($subdivision instanceof Subdivision) {
            return $this
                ->addUsingAlias(CountryPeer::ISO_NR, $subdivision->getCountryIsoNr(), $comparison);
        } elseif ($subdivision instanceof PropelObjectCollection) {
            return $this
                ->useSubdivisionQuery()
                ->filterByPrimaryKeys($subdivision->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySubdivision() only accepts arguments of type Subdivision or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subdivision relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinSubdivision($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subdivision');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Subdivision');
        }

        return $this;
    }

    /**
     * Use the Subdivision relation Subdivision object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\SubdivisionQuery A secondary query class using the current class as primary query
     */
    public function useSubdivisionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubdivision($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subdivision', '\keeko\entities\SubdivisionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Country $country Object to remove from the list of results
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function prune($country = null)
    {
        if ($country) {
            $this->addUsingAlias(CountryPeer::ISO_NR, $country->getIsoNr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
