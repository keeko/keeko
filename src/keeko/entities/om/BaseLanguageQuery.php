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
use keeko\entities\Language;
use keeko\entities\LanguagePeer;
use keeko\entities\LanguageQuery;
use keeko\entities\LanguageScope;
use keeko\entities\LanguageType;
use keeko\entities\Localization;

/**
 * Base class that represents a query for the 'keeko_language' table.
 *
 *
 *
 * @method LanguageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LanguageQuery orderByAlpha2($order = Criteria::ASC) Order by the alpha_2 column
 * @method LanguageQuery orderByAlpha3T($order = Criteria::ASC) Order by the alpha_3T column
 * @method LanguageQuery orderByAlpha3B($order = Criteria::ASC) Order by the alpha_3B column
 * @method LanguageQuery orderByAlpha3($order = Criteria::ASC) Order by the alpha_3 column
 * @method LanguageQuery orderByLocalName($order = Criteria::ASC) Order by the local_name column
 * @method LanguageQuery orderByEnName($order = Criteria::ASC) Order by the en_name column
 * @method LanguageQuery orderByCollate($order = Criteria::ASC) Order by the collate column
 * @method LanguageQuery orderByScopeId($order = Criteria::ASC) Order by the scope_id column
 * @method LanguageQuery orderByTypeId($order = Criteria::ASC) Order by the type_id column
 *
 * @method LanguageQuery groupById() Group by the id column
 * @method LanguageQuery groupByAlpha2() Group by the alpha_2 column
 * @method LanguageQuery groupByAlpha3T() Group by the alpha_3T column
 * @method LanguageQuery groupByAlpha3B() Group by the alpha_3B column
 * @method LanguageQuery groupByAlpha3() Group by the alpha_3 column
 * @method LanguageQuery groupByLocalName() Group by the local_name column
 * @method LanguageQuery groupByEnName() Group by the en_name column
 * @method LanguageQuery groupByCollate() Group by the collate column
 * @method LanguageQuery groupByScopeId() Group by the scope_id column
 * @method LanguageQuery groupByTypeId() Group by the type_id column
 *
 * @method LanguageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LanguageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LanguageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LanguageQuery leftJoinLanguageScope($relationAlias = null) Adds a LEFT JOIN clause to the query using the LanguageScope relation
 * @method LanguageQuery rightJoinLanguageScope($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LanguageScope relation
 * @method LanguageQuery innerJoinLanguageScope($relationAlias = null) Adds a INNER JOIN clause to the query using the LanguageScope relation
 *
 * @method LanguageQuery leftJoinLanguageType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LanguageType relation
 * @method LanguageQuery rightJoinLanguageType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LanguageType relation
 * @method LanguageQuery innerJoinLanguageType($relationAlias = null) Adds a INNER JOIN clause to the query using the LanguageType relation
 *
 * @method LanguageQuery leftJoinLocalization($relationAlias = null) Adds a LEFT JOIN clause to the query using the Localization relation
 * @method LanguageQuery rightJoinLocalization($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Localization relation
 * @method LanguageQuery innerJoinLocalization($relationAlias = null) Adds a INNER JOIN clause to the query using the Localization relation
 *
 * @method Language findOne(PropelPDO $con = null) Return the first Language matching the query
 * @method Language findOneOrCreate(PropelPDO $con = null) Return the first Language matching the query, or a new Language object populated from the query conditions when no match is found
 *
 * @method Language findOneByAlpha2(string $alpha_2) Return the first Language filtered by the alpha_2 column
 * @method Language findOneByAlpha3T(string $alpha_3T) Return the first Language filtered by the alpha_3T column
 * @method Language findOneByAlpha3B(string $alpha_3B) Return the first Language filtered by the alpha_3B column
 * @method Language findOneByAlpha3(string $alpha_3) Return the first Language filtered by the alpha_3 column
 * @method Language findOneByLocalName(string $local_name) Return the first Language filtered by the local_name column
 * @method Language findOneByEnName(string $en_name) Return the first Language filtered by the en_name column
 * @method Language findOneByCollate(string $collate) Return the first Language filtered by the collate column
 * @method Language findOneByScopeId(int $scope_id) Return the first Language filtered by the scope_id column
 * @method Language findOneByTypeId(int $type_id) Return the first Language filtered by the type_id column
 *
 * @method array findById(int $id) Return Language objects filtered by the id column
 * @method array findByAlpha2(string $alpha_2) Return Language objects filtered by the alpha_2 column
 * @method array findByAlpha3T(string $alpha_3T) Return Language objects filtered by the alpha_3T column
 * @method array findByAlpha3B(string $alpha_3B) Return Language objects filtered by the alpha_3B column
 * @method array findByAlpha3(string $alpha_3) Return Language objects filtered by the alpha_3 column
 * @method array findByLocalName(string $local_name) Return Language objects filtered by the local_name column
 * @method array findByEnName(string $en_name) Return Language objects filtered by the en_name column
 * @method array findByCollate(string $collate) Return Language objects filtered by the collate column
 * @method array findByScopeId(int $scope_id) Return Language objects filtered by the scope_id column
 * @method array findByTypeId(int $type_id) Return Language objects filtered by the type_id column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseLanguageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLanguageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Language', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LanguageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     LanguageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LanguageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LanguageQuery) {
            return $criteria;
        }
        $query = new LanguageQuery();
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
     * @return   Language|Language[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LanguagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Language A model object, or null if the key is not found
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
     * @return   Language A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `ALPHA_2`, `ALPHA_3T`, `ALPHA_3B`, `ALPHA_3`, `LOCAL_NAME`, `EN_NAME`, `COLLATE`, `SCOPE_ID`, `TYPE_ID` FROM `keeko_language` WHERE `ID` = :p0';
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
            $obj = new Language();
            $obj->hydrate($row);
            LanguagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Language|Language[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Language[]|mixed the list of results, formatted by the current formatter
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
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LanguagePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LanguagePeer::ID, $keys, Criteria::IN);
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
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(LanguagePeer::ID, $id, $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LanguagePeer::ALPHA_2, $alpha2, $comparison);
    }

    /**
     * Filter the query on the alpha_3T column
     *
     * Example usage:
     * <code>
     * $query->filterByAlpha3T('fooValue');   // WHERE alpha_3T = 'fooValue'
     * $query->filterByAlpha3T('%fooValue%'); // WHERE alpha_3T LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alpha3T The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByAlpha3T($alpha3T = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alpha3T)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alpha3T)) {
                $alpha3T = str_replace('*', '%', $alpha3T);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LanguagePeer::ALPHA_3T, $alpha3T, $comparison);
    }

    /**
     * Filter the query on the alpha_3B column
     *
     * Example usage:
     * <code>
     * $query->filterByAlpha3B('fooValue');   // WHERE alpha_3B = 'fooValue'
     * $query->filterByAlpha3B('%fooValue%'); // WHERE alpha_3B LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alpha3B The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByAlpha3B($alpha3B = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alpha3B)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alpha3B)) {
                $alpha3B = str_replace('*', '%', $alpha3B);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LanguagePeer::ALPHA_3B, $alpha3B, $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LanguagePeer::ALPHA_3, $alpha3, $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LanguagePeer::LOCAL_NAME, $localName, $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LanguagePeer::EN_NAME, $enName, $comparison);
    }

    /**
     * Filter the query on the collate column
     *
     * Example usage:
     * <code>
     * $query->filterByCollate('fooValue');   // WHERE collate = 'fooValue'
     * $query->filterByCollate('%fooValue%'); // WHERE collate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $collate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByCollate($collate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($collate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $collate)) {
                $collate = str_replace('*', '%', $collate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LanguagePeer::COLLATE, $collate, $comparison);
    }

    /**
     * Filter the query on the scope_id column
     *
     * Example usage:
     * <code>
     * $query->filterByScopeId(1234); // WHERE scope_id = 1234
     * $query->filterByScopeId(array(12, 34)); // WHERE scope_id IN (12, 34)
     * $query->filterByScopeId(array('min' => 12)); // WHERE scope_id > 12
     * </code>
     *
     * @see       filterByLanguageScope()
     *
     * @param     mixed $scopeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByScopeId($scopeId = null, $comparison = null)
    {
        if (is_array($scopeId)) {
            $useMinMax = false;
            if (isset($scopeId['min'])) {
                $this->addUsingAlias(LanguagePeer::SCOPE_ID, $scopeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scopeId['max'])) {
                $this->addUsingAlias(LanguagePeer::SCOPE_ID, $scopeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LanguagePeer::SCOPE_ID, $scopeId, $comparison);
    }

    /**
     * Filter the query on the type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE type_id = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE type_id IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE type_id > 12
     * </code>
     *
     * @see       filterByLanguageType()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(LanguagePeer::TYPE_ID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(LanguagePeer::TYPE_ID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LanguagePeer::TYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query by a related LanguageScope object
     *
     * @param   LanguageScope|PropelObjectCollection $languageScope The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLanguageScope($languageScope, $comparison = null)
    {
        if ($languageScope instanceof LanguageScope) {
            return $this
                ->addUsingAlias(LanguagePeer::SCOPE_ID, $languageScope->getId(), $comparison);
        } elseif ($languageScope instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LanguagePeer::SCOPE_ID, $languageScope->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLanguageScope() only accepts arguments of type LanguageScope or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LanguageScope relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function joinLanguageScope($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LanguageScope');

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
            $this->addJoinObject($join, 'LanguageScope');
        }

        return $this;
    }

    /**
     * Use the LanguageScope relation LanguageScope object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LanguageScopeQuery A secondary query class using the current class as primary query
     */
    public function useLanguageScopeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLanguageScope($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LanguageScope', '\keeko\entities\LanguageScopeQuery');
    }

    /**
     * Filter the query by a related LanguageType object
     *
     * @param   LanguageType|PropelObjectCollection $languageType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLanguageType($languageType, $comparison = null)
    {
        if ($languageType instanceof LanguageType) {
            return $this
                ->addUsingAlias(LanguagePeer::TYPE_ID, $languageType->getId(), $comparison);
        } elseif ($languageType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LanguagePeer::TYPE_ID, $languageType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLanguageType() only accepts arguments of type LanguageType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LanguageType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function joinLanguageType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LanguageType');

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
            $this->addJoinObject($join, 'LanguageType');
        }

        return $this;
    }

    /**
     * Use the LanguageType relation LanguageType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LanguageTypeQuery A secondary query class using the current class as primary query
     */
    public function useLanguageTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLanguageType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LanguageType', '\keeko\entities\LanguageTypeQuery');
    }

    /**
     * Filter the query by a related Localization object
     *
     * @param   Localization|PropelObjectCollection $localization  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLocalization($localization, $comparison = null)
    {
        if ($localization instanceof Localization) {
            return $this
                ->addUsingAlias(LanguagePeer::ID, $localization->getLanguageId(), $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Language $language Object to remove from the list of results
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function prune($language = null)
    {
        if ($language) {
            $this->addUsingAlias(LanguagePeer::ID, $language->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
