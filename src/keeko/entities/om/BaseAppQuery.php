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
use keeko\entities\App;
use keeko\entities\AppPeer;
use keeko\entities\AppQuery;
use keeko\entities\AppUri;

/**
 * Base class that represents a query for the 'keeko_app' table.
 *
 *
 *
 * @method AppQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AppQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AppQuery orderByUnixname($order = Criteria::ASC) Order by the unixname column
 * @method AppQuery orderByClassname($order = Criteria::ASC) Order by the classname column
 *
 * @method AppQuery groupById() Group by the id column
 * @method AppQuery groupByName() Group by the name column
 * @method AppQuery groupByUnixname() Group by the unixname column
 * @method AppQuery groupByClassname() Group by the classname column
 *
 * @method AppQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AppQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AppQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AppQuery leftJoinAppUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the AppUri relation
 * @method AppQuery rightJoinAppUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AppUri relation
 * @method AppQuery innerJoinAppUri($relationAlias = null) Adds a INNER JOIN clause to the query using the AppUri relation
 *
 * @method App findOne(PropelPDO $con = null) Return the first App matching the query
 * @method App findOneOrCreate(PropelPDO $con = null) Return the first App matching the query, or a new App object populated from the query conditions when no match is found
 *
 * @method App findOneByName(string $name) Return the first App filtered by the name column
 * @method App findOneByUnixname(string $unixname) Return the first App filtered by the unixname column
 * @method App findOneByClassname(string $classname) Return the first App filtered by the classname column
 *
 * @method array findById(int $id) Return App objects filtered by the id column
 * @method array findByName(string $name) Return App objects filtered by the name column
 * @method array findByUnixname(string $unixname) Return App objects filtered by the unixname column
 * @method array findByClassname(string $classname) Return App objects filtered by the classname column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseAppQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAppQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\App', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AppQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AppQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AppQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AppQuery) {
            return $criteria;
        }
        $query = new AppQuery();
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
     * @return   App|App[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AppPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AppPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   App A model object, or null if the key is not found
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
     * @return   App A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `UNIXNAME`, `CLASSNAME` FROM `keeko_app` WHERE `ID` = :p0';
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
            $obj = new App();
            $obj->hydrate($row);
            AppPeer::addInstanceToPool($obj, (string) $key);
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
     * @return App|App[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|App[]|mixed the list of results, formatted by the current formatter
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
     * @return AppQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AppPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AppQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AppPeer::ID, $keys, Criteria::IN);
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
     * @return AppQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AppPeer::ID, $id, $comparison);
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
     * @return AppQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AppPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the unixname column
     *
     * Example usage:
     * <code>
     * $query->filterByUnixname('fooValue');   // WHERE unixname = 'fooValue'
     * $query->filterByUnixname('%fooValue%'); // WHERE unixname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unixname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AppQuery The current query, for fluid interface
     */
    public function filterByUnixname($unixname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unixname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $unixname)) {
                $unixname = str_replace('*', '%', $unixname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AppPeer::UNIXNAME, $unixname, $comparison);
    }

    /**
     * Filter the query on the classname column
     *
     * Example usage:
     * <code>
     * $query->filterByClassname('fooValue');   // WHERE classname = 'fooValue'
     * $query->filterByClassname('%fooValue%'); // WHERE classname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $classname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AppQuery The current query, for fluid interface
     */
    public function filterByClassname($classname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $classname)) {
                $classname = str_replace('*', '%', $classname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AppPeer::CLASSNAME, $classname, $comparison);
    }

    /**
     * Filter the query by a related AppUri object
     *
     * @param   AppUri|PropelObjectCollection $appUri  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AppQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAppUri($appUri, $comparison = null)
    {
        if ($appUri instanceof AppUri) {
            return $this
                ->addUsingAlias(AppPeer::ID, $appUri->getAppId(), $comparison);
        } elseif ($appUri instanceof PropelObjectCollection) {
            return $this
                ->useAppUriQuery()
                ->filterByPrimaryKeys($appUri->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAppUri() only accepts arguments of type AppUri or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AppUri relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AppQuery The current query, for fluid interface
     */
    public function joinAppUri($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AppUri');

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
            $this->addJoinObject($join, 'AppUri');
        }

        return $this;
    }

    /**
     * Use the AppUri relation AppUri object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\AppUriQuery A secondary query class using the current class as primary query
     */
    public function useAppUriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAppUri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AppUri', '\keeko\entities\AppUriQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   App $app Object to remove from the list of results
     *
     * @return AppQuery The current query, for fluid interface
     */
    public function prune($app = null)
    {
        if ($app) {
            $this->addUsingAlias(AppPeer::ID, $app->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
