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
use keeko\entities\Subdivision;
use keeko\entities\SubdivisionType;
use keeko\entities\SubdivisionTypePeer;
use keeko\entities\SubdivisionTypeQuery;

/**
 * Base class that represents a query for the 'keeko_subdivision_type' table.
 *
 *
 *
 * @method SubdivisionTypeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SubdivisionTypeQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method SubdivisionTypeQuery groupById() Group by the id column
 * @method SubdivisionTypeQuery groupByName() Group by the name column
 *
 * @method SubdivisionTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SubdivisionTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SubdivisionTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SubdivisionTypeQuery leftJoinSubdivision($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subdivision relation
 * @method SubdivisionTypeQuery rightJoinSubdivision($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subdivision relation
 * @method SubdivisionTypeQuery innerJoinSubdivision($relationAlias = null) Adds a INNER JOIN clause to the query using the Subdivision relation
 *
 * @method SubdivisionType findOne(PropelPDO $con = null) Return the first SubdivisionType matching the query
 * @method SubdivisionType findOneOrCreate(PropelPDO $con = null) Return the first SubdivisionType matching the query, or a new SubdivisionType object populated from the query conditions when no match is found
 *
 * @method SubdivisionType findOneByName(string $name) Return the first SubdivisionType filtered by the name column
 *
 * @method array findById(int $id) Return SubdivisionType objects filtered by the id column
 * @method array findByName(string $name) Return SubdivisionType objects filtered by the name column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseSubdivisionTypeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSubdivisionTypeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\SubdivisionType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SubdivisionTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SubdivisionTypeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SubdivisionTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SubdivisionTypeQuery) {
            return $criteria;
        }
        $query = new SubdivisionTypeQuery();
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
     * @return   SubdivisionType|SubdivisionType[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SubdivisionTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SubdivisionTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   SubdivisionType A model object, or null if the key is not found
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
     * @return   SubdivisionType A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME` FROM `keeko_subdivision_type` WHERE `ID` = :p0';
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
            $obj = new SubdivisionType();
            $obj->hydrate($row);
            SubdivisionTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return SubdivisionType|SubdivisionType[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SubdivisionType[]|mixed the list of results, formatted by the current formatter
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
     * @return SubdivisionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SubdivisionTypePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SubdivisionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SubdivisionTypePeer::ID, $keys, Criteria::IN);
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
     * @return SubdivisionTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SubdivisionTypePeer::ID, $id, $comparison);
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
     * @return SubdivisionTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SubdivisionTypePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Subdivision object
     *
     * @param   Subdivision|PropelObjectCollection $subdivision  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SubdivisionTypeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySubdivision($subdivision, $comparison = null)
    {
        if ($subdivision instanceof Subdivision) {
            return $this
                ->addUsingAlias(SubdivisionTypePeer::ID, $subdivision->getSubdivisionTypeId(), $comparison);
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
     * @return SubdivisionTypeQuery The current query, for fluid interface
     */
    public function joinSubdivision($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useSubdivisionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSubdivision($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subdivision', '\keeko\entities\SubdivisionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SubdivisionType $subdivisionType Object to remove from the list of results
     *
     * @return SubdivisionTypeQuery The current query, for fluid interface
     */
    public function prune($subdivisionType = null)
    {
        if ($subdivisionType) {
            $this->addUsingAlias(SubdivisionTypePeer::ID, $subdivisionType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
