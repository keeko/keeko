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
use keeko\entities\Action;
use keeko\entities\Module;
use keeko\entities\ModulePeer;
use keeko\entities\ModuleQuery;

/**
 * Base class that represents a query for the 'keeko_module' table.
 *
 *
 *
 * @method ModuleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ModuleQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method ModuleQuery orderByUnixname($order = Criteria::ASC) Order by the unixname column
 * @method ModuleQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method ModuleQuery orderByClassname($order = Criteria::ASC) Order by the classname column
 *
 * @method ModuleQuery groupById() Group by the id column
 * @method ModuleQuery groupByName() Group by the name column
 * @method ModuleQuery groupByUnixname() Group by the unixname column
 * @method ModuleQuery groupByVersion() Group by the version column
 * @method ModuleQuery groupByClassname() Group by the classname column
 *
 * @method ModuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ModuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ModuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ModuleQuery leftJoinAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Action relation
 * @method ModuleQuery rightJoinAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Action relation
 * @method ModuleQuery innerJoinAction($relationAlias = null) Adds a INNER JOIN clause to the query using the Action relation
 *
 * @method Module findOne(PropelPDO $con = null) Return the first Module matching the query
 * @method Module findOneOrCreate(PropelPDO $con = null) Return the first Module matching the query, or a new Module object populated from the query conditions when no match is found
 *
 * @method Module findOneByName(string $name) Return the first Module filtered by the name column
 * @method Module findOneByUnixname(string $unixname) Return the first Module filtered by the unixname column
 * @method Module findOneByVersion(string $version) Return the first Module filtered by the version column
 * @method Module findOneByClassname(string $classname) Return the first Module filtered by the classname column
 *
 * @method array findById(int $id) Return Module objects filtered by the id column
 * @method array findByName(string $name) Return Module objects filtered by the name column
 * @method array findByUnixname(string $unixname) Return Module objects filtered by the unixname column
 * @method array findByVersion(string $version) Return Module objects filtered by the version column
 * @method array findByClassname(string $classname) Return Module objects filtered by the classname column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseModuleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseModuleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Module', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ModuleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ModuleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ModuleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ModuleQuery) {
            return $criteria;
        }
        $query = new ModuleQuery();
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
     * @return   Module|Module[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ModulePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ModulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Module A model object, or null if the key is not found
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
     * @return   Module A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `UNIXNAME`, `VERSION`, `CLASSNAME` FROM `keeko_module` WHERE `ID` = :p0';
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
            $obj = new Module();
            $obj->hydrate($row);
            ModulePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Module|Module[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Module[]|mixed the list of results, formatted by the current formatter
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
     * @return ModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ModulePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ModulePeer::ID, $keys, Criteria::IN);
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
     * @return ModuleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ModulePeer::ID, $id, $comparison);
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
     * @return ModuleQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ModulePeer::NAME, $name, $comparison);
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
     * @return ModuleQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ModulePeer::UNIXNAME, $unixname, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion('fooValue');   // WHERE version = 'fooValue'
     * $query->filterByVersion('%fooValue%'); // WHERE version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $version The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($version)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $version)) {
                $version = str_replace('*', '%', $version);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ModulePeer::VERSION, $version, $comparison);
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
     * @return ModuleQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ModulePeer::CLASSNAME, $classname, $comparison);
    }

    /**
     * Filter the query by a related Action object
     *
     * @param   Action|PropelObjectCollection $action  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAction($action, $comparison = null)
    {
        if ($action instanceof Action) {
            return $this
                ->addUsingAlias(ModulePeer::ID, $action->getModuleId(), $comparison);
        } elseif ($action instanceof PropelObjectCollection) {
            return $this
                ->useActionQuery()
                ->filterByPrimaryKeys($action->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAction() only accepts arguments of type Action or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Action relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleQuery The current query, for fluid interface
     */
    public function joinAction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Action');

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
            $this->addJoinObject($join, 'Action');
        }

        return $this;
    }

    /**
     * Use the Action relation Action object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\ActionQuery A secondary query class using the current class as primary query
     */
    public function useActionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Action', '\keeko\entities\ActionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Module $module Object to remove from the list of results
     *
     * @return ModuleQuery The current query, for fluid interface
     */
    public function prune($module = null)
    {
        if ($module) {
            $this->addUsingAlias(ModulePeer::ID, $module->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
