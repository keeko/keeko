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
use keeko\entities\L10ntest;
use keeko\entities\L10ntestI18n;
use keeko\entities\L10ntestPeer;
use keeko\entities\L10ntestQuery;

/**
 * Base class that represents a query for the 'keeko_l10ntest' table.
 *
 *
 *
 * @method L10ntestQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method L10ntestQuery groupById() Group by the id column
 *
 * @method L10ntestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method L10ntestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method L10ntestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method L10ntestQuery leftJoinL10ntestI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the L10ntestI18n relation
 * @method L10ntestQuery rightJoinL10ntestI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the L10ntestI18n relation
 * @method L10ntestQuery innerJoinL10ntestI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the L10ntestI18n relation
 *
 * @method L10ntest findOne(PropelPDO $con = null) Return the first L10ntest matching the query
 * @method L10ntest findOneOrCreate(PropelPDO $con = null) Return the first L10ntest matching the query, or a new L10ntest object populated from the query conditions when no match is found
 *
 *
 * @method array findById(int $id) Return L10ntest objects filtered by the id column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseL10ntestQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseL10ntestQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\L10ntest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new L10ntestQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     L10ntestQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return L10ntestQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof L10ntestQuery) {
            return $criteria;
        }
        $query = new L10ntestQuery();
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
     * @return   L10ntest|L10ntest[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = L10ntestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(L10ntestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   L10ntest A model object, or null if the key is not found
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
     * @return   L10ntest A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID` FROM `keeko_l10ntest` WHERE `ID` = :p0';
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
            $obj = new L10ntest();
            $obj->hydrate($row);
            L10ntestPeer::addInstanceToPool($obj, (string) $key);
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
     * @return L10ntest|L10ntest[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|L10ntest[]|mixed the list of results, formatted by the current formatter
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
     * @return L10ntestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(L10ntestPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return L10ntestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(L10ntestPeer::ID, $keys, Criteria::IN);
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
     * @return L10ntestQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(L10ntestPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query by a related L10ntestI18n object
     *
     * @param   L10ntestI18n|PropelObjectCollection $l10ntestI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   L10ntestQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByL10ntestI18n($l10ntestI18n, $comparison = null)
    {
        if ($l10ntestI18n instanceof L10ntestI18n) {
            return $this
                ->addUsingAlias(L10ntestPeer::ID, $l10ntestI18n->getId(), $comparison);
        } elseif ($l10ntestI18n instanceof PropelObjectCollection) {
            return $this
                ->useL10ntestI18nQuery()
                ->filterByPrimaryKeys($l10ntestI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByL10ntestI18n() only accepts arguments of type L10ntestI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the L10ntestI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return L10ntestQuery The current query, for fluid interface
     */
    public function joinL10ntestI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('L10ntestI18n');

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
            $this->addJoinObject($join, 'L10ntestI18n');
        }

        return $this;
    }

    /**
     * Use the L10ntestI18n relation L10ntestI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\L10ntestI18nQuery A secondary query class using the current class as primary query
     */
    public function useL10ntestI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinL10ntestI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'L10ntestI18n', '\keeko\entities\L10ntestI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   L10ntest $l10ntest Object to remove from the list of results
     *
     * @return L10ntestQuery The current query, for fluid interface
     */
    public function prune($l10ntest = null)
    {
        if ($l10ntest) {
            $this->addUsingAlias(L10ntestPeer::ID, $l10ntest->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    L10ntestQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_EN', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'L10ntestI18n';

        return $this
            ->joinL10ntestI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    L10ntestQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_EN', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('L10ntestI18n');
        $this->with['L10ntestI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    L10ntestI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_EN', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'L10ntestI18n', 'keeko\entities\L10ntestI18nQuery');
    }

}
