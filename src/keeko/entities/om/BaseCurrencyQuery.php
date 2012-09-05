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
use keeko\entities\Currency;
use keeko\entities\CurrencyPeer;
use keeko\entities\CurrencyQuery;

/**
 * Base class that represents a query for the 'keeko_currency' table.
 *
 *
 *
 * @method CurrencyQuery orderByIsoNr($order = Criteria::ASC) Order by the iso_nr column
 * @method CurrencyQuery orderByIso3($order = Criteria::ASC) Order by the iso3 column
 * @method CurrencyQuery orderByEnName($order = Criteria::ASC) Order by the en_name column
 * @method CurrencyQuery orderBySymbolLeft($order = Criteria::ASC) Order by the symbol_left column
 * @method CurrencyQuery orderBySymbolRight($order = Criteria::ASC) Order by the symbol_right column
 * @method CurrencyQuery orderByDecimalDigits($order = Criteria::ASC) Order by the decimal_digits column
 * @method CurrencyQuery orderBySubDivisor($order = Criteria::ASC) Order by the sub_divisor column
 * @method CurrencyQuery orderBySubSymbolLeft($order = Criteria::ASC) Order by the sub_symbol_left column
 * @method CurrencyQuery orderBySubSymbolRight($order = Criteria::ASC) Order by the sub_symbol_right column
 *
 * @method CurrencyQuery groupByIsoNr() Group by the iso_nr column
 * @method CurrencyQuery groupByIso3() Group by the iso3 column
 * @method CurrencyQuery groupByEnName() Group by the en_name column
 * @method CurrencyQuery groupBySymbolLeft() Group by the symbol_left column
 * @method CurrencyQuery groupBySymbolRight() Group by the symbol_right column
 * @method CurrencyQuery groupByDecimalDigits() Group by the decimal_digits column
 * @method CurrencyQuery groupBySubDivisor() Group by the sub_divisor column
 * @method CurrencyQuery groupBySubSymbolLeft() Group by the sub_symbol_left column
 * @method CurrencyQuery groupBySubSymbolRight() Group by the sub_symbol_right column
 *
 * @method CurrencyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CurrencyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CurrencyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CurrencyQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method CurrencyQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method CurrencyQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method Currency findOne(PropelPDO $con = null) Return the first Currency matching the query
 * @method Currency findOneOrCreate(PropelPDO $con = null) Return the first Currency matching the query, or a new Currency object populated from the query conditions when no match is found
 *
 * @method Currency findOneByIso3(string $iso3) Return the first Currency filtered by the iso3 column
 * @method Currency findOneByEnName(string $en_name) Return the first Currency filtered by the en_name column
 * @method Currency findOneBySymbolLeft(string $symbol_left) Return the first Currency filtered by the symbol_left column
 * @method Currency findOneBySymbolRight(string $symbol_right) Return the first Currency filtered by the symbol_right column
 * @method Currency findOneByDecimalDigits(int $decimal_digits) Return the first Currency filtered by the decimal_digits column
 * @method Currency findOneBySubDivisor(int $sub_divisor) Return the first Currency filtered by the sub_divisor column
 * @method Currency findOneBySubSymbolLeft(string $sub_symbol_left) Return the first Currency filtered by the sub_symbol_left column
 * @method Currency findOneBySubSymbolRight(string $sub_symbol_right) Return the first Currency filtered by the sub_symbol_right column
 *
 * @method array findByIsoNr(int $iso_nr) Return Currency objects filtered by the iso_nr column
 * @method array findByIso3(string $iso3) Return Currency objects filtered by the iso3 column
 * @method array findByEnName(string $en_name) Return Currency objects filtered by the en_name column
 * @method array findBySymbolLeft(string $symbol_left) Return Currency objects filtered by the symbol_left column
 * @method array findBySymbolRight(string $symbol_right) Return Currency objects filtered by the symbol_right column
 * @method array findByDecimalDigits(int $decimal_digits) Return Currency objects filtered by the decimal_digits column
 * @method array findBySubDivisor(int $sub_divisor) Return Currency objects filtered by the sub_divisor column
 * @method array findBySubSymbolLeft(string $sub_symbol_left) Return Currency objects filtered by the sub_symbol_left column
 * @method array findBySubSymbolRight(string $sub_symbol_right) Return Currency objects filtered by the sub_symbol_right column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseCurrencyQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCurrencyQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Currency', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CurrencyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CurrencyQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CurrencyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CurrencyQuery) {
            return $criteria;
        }
        $query = new CurrencyQuery();
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
     * @return   Currency|Currency[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CurrencyPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CurrencyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Currency A model object, or null if the key is not found
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
     * @return   Currency A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ISO_NR`, `ISO3`, `EN_NAME`, `SYMBOL_LEFT`, `SYMBOL_RIGHT`, `DECIMAL_DIGITS`, `SUB_DIVISOR`, `SUB_SYMBOL_LEFT`, `SUB_SYMBOL_RIGHT` FROM `keeko_currency` WHERE `ISO_NR` = :p0';
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
            $obj = new Currency();
            $obj->hydrate($row);
            CurrencyPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Currency|Currency[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Currency[]|mixed the list of results, formatted by the current formatter
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
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CurrencyPeer::ISO_NR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CurrencyPeer::ISO_NR, $keys, Criteria::IN);
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
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByIsoNr($isoNr = null, $comparison = null)
    {
        if (is_array($isoNr) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CurrencyPeer::ISO_NR, $isoNr, $comparison);
    }

    /**
     * Filter the query on the iso3 column
     *
     * Example usage:
     * <code>
     * $query->filterByIso3('fooValue');   // WHERE iso3 = 'fooValue'
     * $query->filterByIso3('%fooValue%'); // WHERE iso3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iso3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByIso3($iso3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iso3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iso3)) {
                $iso3 = str_replace('*', '%', $iso3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::ISO3, $iso3, $comparison);
    }

    /**
     * Filter the query on the en_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEnName('fooValue');   // WHERE en_name = 'fooValue'
     * $query->filterByEnName('%fooValue%'); // WHERE en_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $enName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByEnName($enName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $enName)) {
                $enName = str_replace('*', '%', $enName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::EN_NAME, $enName, $comparison);
    }

    /**
     * Filter the query on the symbol_left column
     *
     * Example usage:
     * <code>
     * $query->filterBySymbolLeft('fooValue');   // WHERE symbol_left = 'fooValue'
     * $query->filterBySymbolLeft('%fooValue%'); // WHERE symbol_left LIKE '%fooValue%'
     * </code>
     *
     * @param     string $symbolLeft The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterBySymbolLeft($symbolLeft = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($symbolLeft)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $symbolLeft)) {
                $symbolLeft = str_replace('*', '%', $symbolLeft);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::SYMBOL_LEFT, $symbolLeft, $comparison);
    }

    /**
     * Filter the query on the symbol_right column
     *
     * Example usage:
     * <code>
     * $query->filterBySymbolRight('fooValue');   // WHERE symbol_right = 'fooValue'
     * $query->filterBySymbolRight('%fooValue%'); // WHERE symbol_right LIKE '%fooValue%'
     * </code>
     *
     * @param     string $symbolRight The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterBySymbolRight($symbolRight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($symbolRight)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $symbolRight)) {
                $symbolRight = str_replace('*', '%', $symbolRight);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::SYMBOL_RIGHT, $symbolRight, $comparison);
    }

    /**
     * Filter the query on the decimal_digits column
     *
     * Example usage:
     * <code>
     * $query->filterByDecimalDigits(1234); // WHERE decimal_digits = 1234
     * $query->filterByDecimalDigits(array(12, 34)); // WHERE decimal_digits IN (12, 34)
     * $query->filterByDecimalDigits(array('min' => 12)); // WHERE decimal_digits > 12
     * </code>
     *
     * @param     mixed $decimalDigits The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterByDecimalDigits($decimalDigits = null, $comparison = null)
    {
        if (is_array($decimalDigits)) {
            $useMinMax = false;
            if (isset($decimalDigits['min'])) {
                $this->addUsingAlias(CurrencyPeer::DECIMAL_DIGITS, $decimalDigits['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($decimalDigits['max'])) {
                $this->addUsingAlias(CurrencyPeer::DECIMAL_DIGITS, $decimalDigits['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::DECIMAL_DIGITS, $decimalDigits, $comparison);
    }

    /**
     * Filter the query on the sub_divisor column
     *
     * Example usage:
     * <code>
     * $query->filterBySubDivisor(1234); // WHERE sub_divisor = 1234
     * $query->filterBySubDivisor(array(12, 34)); // WHERE sub_divisor IN (12, 34)
     * $query->filterBySubDivisor(array('min' => 12)); // WHERE sub_divisor > 12
     * </code>
     *
     * @param     mixed $subDivisor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterBySubDivisor($subDivisor = null, $comparison = null)
    {
        if (is_array($subDivisor)) {
            $useMinMax = false;
            if (isset($subDivisor['min'])) {
                $this->addUsingAlias(CurrencyPeer::SUB_DIVISOR, $subDivisor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subDivisor['max'])) {
                $this->addUsingAlias(CurrencyPeer::SUB_DIVISOR, $subDivisor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::SUB_DIVISOR, $subDivisor, $comparison);
    }

    /**
     * Filter the query on the sub_symbol_left column
     *
     * Example usage:
     * <code>
     * $query->filterBySubSymbolLeft('fooValue');   // WHERE sub_symbol_left = 'fooValue'
     * $query->filterBySubSymbolLeft('%fooValue%'); // WHERE sub_symbol_left LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subSymbolLeft The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterBySubSymbolLeft($subSymbolLeft = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subSymbolLeft)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subSymbolLeft)) {
                $subSymbolLeft = str_replace('*', '%', $subSymbolLeft);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::SUB_SYMBOL_LEFT, $subSymbolLeft, $comparison);
    }

    /**
     * Filter the query on the sub_symbol_right column
     *
     * Example usage:
     * <code>
     * $query->filterBySubSymbolRight('fooValue');   // WHERE sub_symbol_right = 'fooValue'
     * $query->filterBySubSymbolRight('%fooValue%'); // WHERE sub_symbol_right LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subSymbolRight The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function filterBySubSymbolRight($subSymbolRight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subSymbolRight)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subSymbolRight)) {
                $subSymbolRight = str_replace('*', '%', $subSymbolRight);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CurrencyPeer::SUB_SYMBOL_RIGHT, $subSymbolRight, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CurrencyQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(CurrencyPeer::ISO_NR, $country->getCurrencyIsoNr(), $comparison);
        } elseif ($country instanceof PropelObjectCollection) {
            return $this
                ->useCountryQuery()
                ->filterByPrimaryKeys($country->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type Country or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\keeko\entities\CountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Currency $currency Object to remove from the list of results
     *
     * @return CurrencyQuery The current query, for fluid interface
     */
    public function prune($currency = null)
    {
        if ($currency) {
            $this->addUsingAlias(CurrencyPeer::ISO_NR, $currency->getIsoNr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
