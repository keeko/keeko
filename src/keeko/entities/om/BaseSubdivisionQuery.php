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
use keeko\entities\Subdivision;
use keeko\entities\SubdivisionPeer;
use keeko\entities\SubdivisionQuery;
use keeko\entities\SubdivisionType;
use keeko\entities\User;

/**
 * Base class that represents a query for the 'keeko_subdivision' table.
 *
 *
 *
 * @method SubdivisionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SubdivisionQuery orderByIso($order = Criteria::ASC) Order by the iso column
 * @method SubdivisionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method SubdivisionQuery orderByLocalName($order = Criteria::ASC) Order by the local_name column
 * @method SubdivisionQuery orderByEnName($order = Criteria::ASC) Order by the en_name column
 * @method SubdivisionQuery orderByAltNames($order = Criteria::ASC) Order by the alt_names column
 * @method SubdivisionQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method SubdivisionQuery orderByCountryIsoNr($order = Criteria::ASC) Order by the country_iso_nr column
 * @method SubdivisionQuery orderBySubdivisionTypeId($order = Criteria::ASC) Order by the subdivision_type_id column
 *
 * @method SubdivisionQuery groupById() Group by the id column
 * @method SubdivisionQuery groupByIso() Group by the iso column
 * @method SubdivisionQuery groupByName() Group by the name column
 * @method SubdivisionQuery groupByLocalName() Group by the local_name column
 * @method SubdivisionQuery groupByEnName() Group by the en_name column
 * @method SubdivisionQuery groupByAltNames() Group by the alt_names column
 * @method SubdivisionQuery groupByParentId() Group by the parent_id column
 * @method SubdivisionQuery groupByCountryIsoNr() Group by the country_iso_nr column
 * @method SubdivisionQuery groupBySubdivisionTypeId() Group by the subdivision_type_id column
 *
 * @method SubdivisionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SubdivisionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SubdivisionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SubdivisionQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method SubdivisionQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method SubdivisionQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method SubdivisionQuery leftJoinSubdivisionType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SubdivisionType relation
 * @method SubdivisionQuery rightJoinSubdivisionType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SubdivisionType relation
 * @method SubdivisionQuery innerJoinSubdivisionType($relationAlias = null) Adds a INNER JOIN clause to the query using the SubdivisionType relation
 *
 * @method SubdivisionQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method SubdivisionQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method SubdivisionQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method Subdivision findOne(PropelPDO $con = null) Return the first Subdivision matching the query
 * @method Subdivision findOneOrCreate(PropelPDO $con = null) Return the first Subdivision matching the query, or a new Subdivision object populated from the query conditions when no match is found
 *
 * @method Subdivision findOneByIso(string $iso) Return the first Subdivision filtered by the iso column
 * @method Subdivision findOneByName(string $name) Return the first Subdivision filtered by the name column
 * @method Subdivision findOneByLocalName(string $local_name) Return the first Subdivision filtered by the local_name column
 * @method Subdivision findOneByEnName(string $en_name) Return the first Subdivision filtered by the en_name column
 * @method Subdivision findOneByAltNames(string $alt_names) Return the first Subdivision filtered by the alt_names column
 * @method Subdivision findOneByParentId(int $parent_id) Return the first Subdivision filtered by the parent_id column
 * @method Subdivision findOneByCountryIsoNr(int $country_iso_nr) Return the first Subdivision filtered by the country_iso_nr column
 * @method Subdivision findOneBySubdivisionTypeId(int $subdivision_type_id) Return the first Subdivision filtered by the subdivision_type_id column
 *
 * @method array findById(int $id) Return Subdivision objects filtered by the id column
 * @method array findByIso(string $iso) Return Subdivision objects filtered by the iso column
 * @method array findByName(string $name) Return Subdivision objects filtered by the name column
 * @method array findByLocalName(string $local_name) Return Subdivision objects filtered by the local_name column
 * @method array findByEnName(string $en_name) Return Subdivision objects filtered by the en_name column
 * @method array findByAltNames(string $alt_names) Return Subdivision objects filtered by the alt_names column
 * @method array findByParentId(int $parent_id) Return Subdivision objects filtered by the parent_id column
 * @method array findByCountryIsoNr(int $country_iso_nr) Return Subdivision objects filtered by the country_iso_nr column
 * @method array findBySubdivisionTypeId(int $subdivision_type_id) Return Subdivision objects filtered by the subdivision_type_id column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseSubdivisionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSubdivisionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Subdivision', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SubdivisionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SubdivisionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SubdivisionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SubdivisionQuery) {
            return $criteria;
        }
        $query = new SubdivisionQuery();
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
     * @return   Subdivision|Subdivision[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SubdivisionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SubdivisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Subdivision A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
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
     * @return   Subdivision A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `ISO`, `NAME`, `LOCAL_NAME`, `EN_NAME`, `ALT_NAMES`, `PARENT_ID`, `COUNTRY_ISO_NR`, `SUBDIVISION_TYPE_ID` FROM `keeko_subdivision` WHERE `ID` = :p0';
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
            $obj = new Subdivision();
            $obj->hydrate($row);
            SubdivisionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Subdivision|Subdivision[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Subdivision[]|mixed the list of results, formatted by the current formatter
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
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SubdivisionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SubdivisionPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SubdivisionPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the iso column
     *
     * Example usage:
     * <code>
     * $query->filterByIso('fooValue');   // WHERE iso = 'fooValue'
     * $query->filterByIso('%fooValue%'); // WHERE iso LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iso The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByIso($iso = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iso)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iso)) {
                $iso = str_replace('*', '%', $iso);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::ISO, $iso, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the local_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalName('fooValue');   // WHERE local_name = 'fooValue'
     * $query->filterByLocalName('%fooValue%'); // WHERE local_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $localName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByLocalName($localName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($localName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $localName)) {
                $localName = str_replace('*', '%', $localName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::LOCAL_NAME, $localName, $comparison);
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
     * @return SubdivisionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SubdivisionPeer::EN_NAME, $enName, $comparison);
    }

    /**
     * Filter the query on the alt_names column
     *
     * Example usage:
     * <code>
     * $query->filterByAltNames('fooValue');   // WHERE alt_names = 'fooValue'
     * $query->filterByAltNames('%fooValue%'); // WHERE alt_names LIKE '%fooValue%'
     * </code>
     *
     * @param     string $altNames The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByAltNames($altNames = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($altNames)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $altNames)) {
                $altNames = str_replace('*', '%', $altNames);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::ALT_NAMES, $altNames, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(SubdivisionPeer::PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(SubdivisionPeer::PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the country_iso_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryIsoNr(1234); // WHERE country_iso_nr = 1234
     * $query->filterByCountryIsoNr(array(12, 34)); // WHERE country_iso_nr IN (12, 34)
     * $query->filterByCountryIsoNr(array('min' => 12)); // WHERE country_iso_nr > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $countryIsoNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterByCountryIsoNr($countryIsoNr = null, $comparison = null)
    {
        if (is_array($countryIsoNr)) {
            $useMinMax = false;
            if (isset($countryIsoNr['min'])) {
                $this->addUsingAlias(SubdivisionPeer::COUNTRY_ISO_NR, $countryIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryIsoNr['max'])) {
                $this->addUsingAlias(SubdivisionPeer::COUNTRY_ISO_NR, $countryIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::COUNTRY_ISO_NR, $countryIsoNr, $comparison);
    }

    /**
     * Filter the query on the subdivision_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubdivisionTypeId(1234); // WHERE subdivision_type_id = 1234
     * $query->filterBySubdivisionTypeId(array(12, 34)); // WHERE subdivision_type_id IN (12, 34)
     * $query->filterBySubdivisionTypeId(array('min' => 12)); // WHERE subdivision_type_id > 12
     * </code>
     *
     * @see       filterBySubdivisionType()
     *
     * @param     mixed $subdivisionTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function filterBySubdivisionTypeId($subdivisionTypeId = null, $comparison = null)
    {
        if (is_array($subdivisionTypeId)) {
            $useMinMax = false;
            if (isset($subdivisionTypeId['min'])) {
                $this->addUsingAlias(SubdivisionPeer::SUBDIVISION_TYPE_ID, $subdivisionTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subdivisionTypeId['max'])) {
                $this->addUsingAlias(SubdivisionPeer::SUBDIVISION_TYPE_ID, $subdivisionTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubdivisionPeer::SUBDIVISION_TYPE_ID, $subdivisionTypeId, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SubdivisionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(SubdivisionPeer::COUNTRY_ISO_NR, $country->getIsoNr(), $comparison);
        } elseif ($country instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubdivisionPeer::COUNTRY_ISO_NR, $country->toKeyValue('PrimaryKey', 'IsoNr'), $comparison);
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
     * @return SubdivisionQuery The current query, for fluid interface
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
     * Filter the query by a related SubdivisionType object
     *
     * @param   SubdivisionType|PropelObjectCollection $subdivisionType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SubdivisionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySubdivisionType($subdivisionType, $comparison = null)
    {
        if ($subdivisionType instanceof SubdivisionType) {
            return $this
                ->addUsingAlias(SubdivisionPeer::SUBDIVISION_TYPE_ID, $subdivisionType->getId(), $comparison);
        } elseif ($subdivisionType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubdivisionPeer::SUBDIVISION_TYPE_ID, $subdivisionType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySubdivisionType() only accepts arguments of type SubdivisionType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SubdivisionType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function joinSubdivisionType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SubdivisionType');

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
            $this->addJoinObject($join, 'SubdivisionType');
        }

        return $this;
    }

    /**
     * Use the SubdivisionType relation SubdivisionType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\SubdivisionTypeQuery A secondary query class using the current class as primary query
     */
    public function useSubdivisionTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSubdivisionType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SubdivisionType', '\keeko\entities\SubdivisionTypeQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SubdivisionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(SubdivisionPeer::ID, $user->getSubdivisionId(), $comparison);
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
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\keeko\entities\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Subdivision $subdivision Object to remove from the list of results
     *
     * @return SubdivisionQuery The current query, for fluid interface
     */
    public function prune($subdivision = null)
    {
        if ($subdivision) {
            $this->addUsingAlias(SubdivisionPeer::ID, $subdivision->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
