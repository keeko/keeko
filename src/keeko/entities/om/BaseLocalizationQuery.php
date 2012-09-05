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
use keeko\entities\AppUri;
use keeko\entities\Country;
use keeko\entities\Language;
use keeko\entities\Localization;
use keeko\entities\LocalizationPeer;
use keeko\entities\LocalizationQuery;

/**
 * Base class that represents a query for the 'keeko_localization' table.
 *
 *
 *
 * @method LocalizationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LocalizationQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method LocalizationQuery orderByLanguageId($order = Criteria::ASC) Order by the language_id column
 * @method LocalizationQuery orderByCountryIsoNr($order = Criteria::ASC) Order by the country_iso_nr column
 * @method LocalizationQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 *
 * @method LocalizationQuery groupById() Group by the id column
 * @method LocalizationQuery groupByParentId() Group by the parent_id column
 * @method LocalizationQuery groupByLanguageId() Group by the language_id column
 * @method LocalizationQuery groupByCountryIsoNr() Group by the country_iso_nr column
 * @method LocalizationQuery groupByIsDefault() Group by the is_default column
 *
 * @method LocalizationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LocalizationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LocalizationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LocalizationQuery leftJoinLocalizationRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the LocalizationRelatedByParentId relation
 * @method LocalizationQuery rightJoinLocalizationRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LocalizationRelatedByParentId relation
 * @method LocalizationQuery innerJoinLocalizationRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the LocalizationRelatedByParentId relation
 *
 * @method LocalizationQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method LocalizationQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method LocalizationQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method LocalizationQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method LocalizationQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method LocalizationQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method LocalizationQuery leftJoinLocalizationRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the LocalizationRelatedById relation
 * @method LocalizationQuery rightJoinLocalizationRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LocalizationRelatedById relation
 * @method LocalizationQuery innerJoinLocalizationRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the LocalizationRelatedById relation
 *
 * @method LocalizationQuery leftJoinAppUri($relationAlias = null) Adds a LEFT JOIN clause to the query using the AppUri relation
 * @method LocalizationQuery rightJoinAppUri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AppUri relation
 * @method LocalizationQuery innerJoinAppUri($relationAlias = null) Adds a INNER JOIN clause to the query using the AppUri relation
 *
 * @method Localization findOne(PropelPDO $con = null) Return the first Localization matching the query
 * @method Localization findOneOrCreate(PropelPDO $con = null) Return the first Localization matching the query, or a new Localization object populated from the query conditions when no match is found
 *
 * @method Localization findOneByParentId(int $parent_id) Return the first Localization filtered by the parent_id column
 * @method Localization findOneByLanguageId(int $language_id) Return the first Localization filtered by the language_id column
 * @method Localization findOneByCountryIsoNr(int $country_iso_nr) Return the first Localization filtered by the country_iso_nr column
 * @method Localization findOneByIsDefault(boolean $is_default) Return the first Localization filtered by the is_default column
 *
 * @method array findById(int $id) Return Localization objects filtered by the id column
 * @method array findByParentId(int $parent_id) Return Localization objects filtered by the parent_id column
 * @method array findByLanguageId(int $language_id) Return Localization objects filtered by the language_id column
 * @method array findByCountryIsoNr(int $country_iso_nr) Return Localization objects filtered by the country_iso_nr column
 * @method array findByIsDefault(boolean $is_default) Return Localization objects filtered by the is_default column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseLocalizationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLocalizationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\Localization', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LocalizationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     LocalizationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LocalizationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LocalizationQuery) {
            return $criteria;
        }
        $query = new LocalizationQuery();
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
     * @return   Localization|Localization[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LocalizationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LocalizationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Localization A model object, or null if the key is not found
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
     * @return   Localization A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `PARENT_ID`, `LANGUAGE_ID`, `COUNTRY_ISO_NR`, `IS_DEFAULT` FROM `keeko_localization` WHERE `ID` = :p0';
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
            $obj = new Localization();
            $obj->hydrate($row);
            LocalizationPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Localization|Localization[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Localization[]|mixed the list of results, formatted by the current formatter
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
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LocalizationPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LocalizationPeer::ID, $keys, Criteria::IN);
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
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(LocalizationPeer::ID, $id, $comparison);
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
     * @see       filterByLocalizationRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(LocalizationPeer::PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(LocalizationPeer::PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocalizationPeer::PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the language_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguageId(1234); // WHERE language_id = 1234
     * $query->filterByLanguageId(array(12, 34)); // WHERE language_id IN (12, 34)
     * $query->filterByLanguageId(array('min' => 12)); // WHERE language_id > 12
     * </code>
     *
     * @see       filterByLanguage()
     *
     * @param     mixed $languageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByLanguageId($languageId = null, $comparison = null)
    {
        if (is_array($languageId)) {
            $useMinMax = false;
            if (isset($languageId['min'])) {
                $this->addUsingAlias(LocalizationPeer::LANGUAGE_ID, $languageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($languageId['max'])) {
                $this->addUsingAlias(LocalizationPeer::LANGUAGE_ID, $languageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocalizationPeer::LANGUAGE_ID, $languageId, $comparison);
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
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByCountryIsoNr($countryIsoNr = null, $comparison = null)
    {
        if (is_array($countryIsoNr)) {
            $useMinMax = false;
            if (isset($countryIsoNr['min'])) {
                $this->addUsingAlias(LocalizationPeer::COUNTRY_ISO_NR, $countryIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryIsoNr['max'])) {
                $this->addUsingAlias(LocalizationPeer::COUNTRY_ISO_NR, $countryIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocalizationPeer::COUNTRY_ISO_NR, $countryIsoNr, $comparison);
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     boolean|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, $comparison = null)
    {
        if (is_string($isDefault)) {
            $is_default = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LocalizationPeer::IS_DEFAULT, $isDefault, $comparison);
    }

    /**
     * Filter the query by a related Localization object
     *
     * @param   Localization|PropelObjectCollection $localization The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LocalizationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLocalizationRelatedByParentId($localization, $comparison = null)
    {
        if ($localization instanceof Localization) {
            return $this
                ->addUsingAlias(LocalizationPeer::PARENT_ID, $localization->getId(), $comparison);
        } elseif ($localization instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LocalizationPeer::PARENT_ID, $localization->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLocalizationRelatedByParentId() only accepts arguments of type Localization or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LocalizationRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function joinLocalizationRelatedByParentId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LocalizationRelatedByParentId');

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
            $this->addJoinObject($join, 'LocalizationRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the LocalizationRelatedByParentId relation Localization object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LocalizationQuery A secondary query class using the current class as primary query
     */
    public function useLocalizationRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLocalizationRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LocalizationRelatedByParentId', '\keeko\entities\LocalizationQuery');
    }

    /**
     * Filter the query by a related Language object
     *
     * @param   Language|PropelObjectCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LocalizationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLanguage($language, $comparison = null)
    {
        if ($language instanceof Language) {
            return $this
                ->addUsingAlias(LocalizationPeer::LANGUAGE_ID, $language->getId(), $comparison);
        } elseif ($language instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LocalizationPeer::LANGUAGE_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLanguage() only accepts arguments of type Language or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Language relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function joinLanguage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Language');

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
            $this->addJoinObject($join, 'Language');
        }

        return $this;
    }

    /**
     * Use the Language relation Language object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LanguageQuery A secondary query class using the current class as primary query
     */
    public function useLanguageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLanguage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Language', '\keeko\entities\LanguageQuery');
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LocalizationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(LocalizationPeer::COUNTRY_ISO_NR, $country->getIsoNr(), $comparison);
        } elseif ($country instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LocalizationPeer::COUNTRY_ISO_NR, $country->toKeyValue('PrimaryKey', 'IsoNr'), $comparison);
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
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\keeko\entities\CountryQuery');
    }

    /**
     * Filter the query by a related Localization object
     *
     * @param   Localization|PropelObjectCollection $localization  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LocalizationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLocalizationRelatedById($localization, $comparison = null)
    {
        if ($localization instanceof Localization) {
            return $this
                ->addUsingAlias(LocalizationPeer::ID, $localization->getParentId(), $comparison);
        } elseif ($localization instanceof PropelObjectCollection) {
            return $this
                ->useLocalizationRelatedByIdQuery()
                ->filterByPrimaryKeys($localization->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLocalizationRelatedById() only accepts arguments of type Localization or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LocalizationRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function joinLocalizationRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LocalizationRelatedById');

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
            $this->addJoinObject($join, 'LocalizationRelatedById');
        }

        return $this;
    }

    /**
     * Use the LocalizationRelatedById relation Localization object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\LocalizationQuery A secondary query class using the current class as primary query
     */
    public function useLocalizationRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLocalizationRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LocalizationRelatedById', '\keeko\entities\LocalizationQuery');
    }

    /**
     * Filter the query by a related AppUri object
     *
     * @param   AppUri|PropelObjectCollection $appUri  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LocalizationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAppUri($appUri, $comparison = null)
    {
        if ($appUri instanceof AppUri) {
            return $this
                ->addUsingAlias(LocalizationPeer::ID, $appUri->getLocalizationId(), $comparison);
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
     * @return LocalizationQuery The current query, for fluid interface
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
     * @param   Localization $localization Object to remove from the list of results
     *
     * @return LocalizationQuery The current query, for fluid interface
     */
    public function prune($localization = null)
    {
        if ($localization) {
            $this->addUsingAlias(LocalizationPeer::ID, $localization->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
