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
use keeko\entities\Territory;
use keeko\entities\TerritoryPeer;
use keeko\entities\TerritoryQuery;

/**
 * Base class that represents a query for the 'keeko_territory' table.
 *
 *
 *
 * @method TerritoryQuery orderByIsoNr($order = Criteria::ASC) Order by the iso_nr column
 * @method TerritoryQuery orderByParentIsoNr($order = Criteria::ASC) Order by the parent_iso_nr column
 * @method TerritoryQuery orderByNameEn($order = Criteria::ASC) Order by the name_en column
 *
 * @method TerritoryQuery groupByIsoNr() Group by the iso_nr column
 * @method TerritoryQuery groupByParentIsoNr() Group by the parent_iso_nr column
 * @method TerritoryQuery groupByNameEn() Group by the name_en column
 *
 * @method TerritoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TerritoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TerritoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TerritoryQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method TerritoryQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method TerritoryQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method Territory findOne(PropelPDO $con = null) Return the first Territory matching the query
 * @method Territory findOneOrCreate(PropelPDO $con = null) Return the first Territory matching the query, or a new Territory object populated from the query conditions when no match is found
 *
 * @method Territory findOneByParentIsoNr(int $parent_iso_nr) Return the first Territory filtered by the parent_iso_nr column
 * @method Territory findOneByNameEn(string $name_en) Return the first Territory filtered by the name_en column
 *
 * @method array findByIsoNr(int $iso_nr) Return Territory objects filtered by the iso_nr column
 * @method array findByParentIsoNr(int $parent_iso_nr) Return Territory objects filtered by the parent_iso_nr column
 * @method array findByNameEn(string $name_en) Return Territory objects filtered by the name_en column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseTerritoryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTerritoryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Territory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TerritoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TerritoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TerritoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TerritoryQuery) {
            return $criteria;
        }
        $query = new TerritoryQuery();
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
     * @return   Territory|Territory[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TerritoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TerritoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Territory A model object, or null if the key is not found
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
     * @return   Territory A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ISO_NR`, `PARENT_ISO_NR`, `NAME_EN` FROM `keeko_territory` WHERE `ISO_NR` = :p0';
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
            $obj = new Territory();
            $obj->hydrate($row);
            TerritoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Territory|Territory[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Territory[]|mixed the list of results, formatted by the current formatter
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
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TerritoryPeer::ISO_NR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TerritoryPeer::ISO_NR, $keys, Criteria::IN);
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
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function filterByIsoNr($isoNr = null, $comparison = null)
    {
        if (is_array($isoNr) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TerritoryPeer::ISO_NR, $isoNr, $comparison);
    }

    /**
     * Filter the query on the parent_iso_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByParentIsoNr(1234); // WHERE parent_iso_nr = 1234
     * $query->filterByParentIsoNr(array(12, 34)); // WHERE parent_iso_nr IN (12, 34)
     * $query->filterByParentIsoNr(array('min' => 12)); // WHERE parent_iso_nr > 12
     * </code>
     *
     * @param     mixed $parentIsoNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function filterByParentIsoNr($parentIsoNr = null, $comparison = null)
    {
        if (is_array($parentIsoNr)) {
            $useMinMax = false;
            if (isset($parentIsoNr['min'])) {
                $this->addUsingAlias(TerritoryPeer::PARENT_ISO_NR, $parentIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentIsoNr['max'])) {
                $this->addUsingAlias(TerritoryPeer::PARENT_ISO_NR, $parentIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TerritoryPeer::PARENT_ISO_NR, $parentIsoNr, $comparison);
    }

    /**
     * Filter the query on the name_en column
     *
     * Example usage:
     * <code>
     * $query->filterByNameEn('fooValue');   // WHERE name_en = 'fooValue'
     * $query->filterByNameEn('%fooValue%'); // WHERE name_en LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameEn The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function filterByNameEn($nameEn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameEn)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nameEn)) {
                $nameEn = str_replace('*', '%', $nameEn);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TerritoryPeer::NAME_EN, $nameEn, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TerritoryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(TerritoryPeer::ISO_NR, $country->getTerritoryIsoNr(), $comparison);
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
     * @return TerritoryQuery The current query, for fluid interface
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
     * @param   Territory $territory Object to remove from the list of results
     *
     * @return TerritoryQuery The current query, for fluid interface
     */
    public function prune($territory = null)
    {
        if ($territory) {
            $this->addUsingAlias(TerritoryPeer::ISO_NR, $territory->getIsoNr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
