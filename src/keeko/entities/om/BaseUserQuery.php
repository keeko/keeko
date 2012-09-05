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
use keeko\entities\Group;
use keeko\entities\GroupUser;
use keeko\entities\Subdivision;
use keeko\entities\User;
use keeko\entities\UserPeer;
use keeko\entities\UserQuery;

/**
 * Base class that represents a query for the 'keeko_user' table.
 *
 *
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UserQuery orderByLoginName($order = Criteria::ASC) Order by the login_name column
 * @method UserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method UserQuery orderByGivenName($order = Criteria::ASC) Order by the given_name column
 * @method UserQuery orderByFamilyName($order = Criteria::ASC) Order by the family_name column
 * @method UserQuery orderByDisplayName($order = Criteria::ASC) Order by the display_name column
 * @method UserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method UserQuery orderByCountryIsoNr($order = Criteria::ASC) Order by the country_iso_nr column
 * @method UserQuery orderBySubdivisionId($order = Criteria::ASC) Order by the subdivision_id column
 * @method UserQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method UserQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method UserQuery orderByBirthday($order = Criteria::ASC) Order by the birthday column
 * @method UserQuery orderBySex($order = Criteria::ASC) Order by the sex column
 * @method UserQuery orderByClub($order = Criteria::ASC) Order by the club column
 * @method UserQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method UserQuery orderByPostalCode($order = Criteria::ASC) Order by the postal_code column
 * @method UserQuery orderByTan($order = Criteria::ASC) Order by the tan column
 * @method UserQuery orderByPasswordRecoverCode($order = Criteria::ASC) Order by the password_recover_code column
 * @method UserQuery orderByPasswordRecoverTime($order = Criteria::ASC) Order by the password_recover_time column
 * @method UserQuery orderByLocationStatus($order = Criteria::ASC) Order by the location_status column
 * @method UserQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method UserQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method UserQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method UserQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method UserQuery groupById() Group by the id column
 * @method UserQuery groupByLoginName() Group by the login_name column
 * @method UserQuery groupByPassword() Group by the password column
 * @method UserQuery groupByGivenName() Group by the given_name column
 * @method UserQuery groupByFamilyName() Group by the family_name column
 * @method UserQuery groupByDisplayName() Group by the display_name column
 * @method UserQuery groupByEmail() Group by the email column
 * @method UserQuery groupByCountryIsoNr() Group by the country_iso_nr column
 * @method UserQuery groupBySubdivisionId() Group by the subdivision_id column
 * @method UserQuery groupByAddress() Group by the address column
 * @method UserQuery groupByAddress2() Group by the address2 column
 * @method UserQuery groupByBirthday() Group by the birthday column
 * @method UserQuery groupBySex() Group by the sex column
 * @method UserQuery groupByClub() Group by the club column
 * @method UserQuery groupByCity() Group by the city column
 * @method UserQuery groupByPostalCode() Group by the postal_code column
 * @method UserQuery groupByTan() Group by the tan column
 * @method UserQuery groupByPasswordRecoverCode() Group by the password_recover_code column
 * @method UserQuery groupByPasswordRecoverTime() Group by the password_recover_time column
 * @method UserQuery groupByLocationStatus() Group by the location_status column
 * @method UserQuery groupByLatitude() Group by the latitude column
 * @method UserQuery groupByLongitude() Group by the longitude column
 * @method UserQuery groupByCreated() Group by the created column
 * @method UserQuery groupByUpdated() Group by the updated column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method UserQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method UserQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method UserQuery leftJoinSubdivision($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subdivision relation
 * @method UserQuery rightJoinSubdivision($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subdivision relation
 * @method UserQuery innerJoinSubdivision($relationAlias = null) Adds a INNER JOIN clause to the query using the Subdivision relation
 *
 * @method UserQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method UserQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method UserQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method UserQuery leftJoinGroupUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the GroupUser relation
 * @method UserQuery rightJoinGroupUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GroupUser relation
 * @method UserQuery innerJoinGroupUser($relationAlias = null) Adds a INNER JOIN clause to the query using the GroupUser relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByLoginName(string $login_name) Return the first User filtered by the login_name column
 * @method User findOneByPassword(string $password) Return the first User filtered by the password column
 * @method User findOneByGivenName(string $given_name) Return the first User filtered by the given_name column
 * @method User findOneByFamilyName(string $family_name) Return the first User filtered by the family_name column
 * @method User findOneByDisplayName(string $display_name) Return the first User filtered by the display_name column
 * @method User findOneByEmail(string $email) Return the first User filtered by the email column
 * @method User findOneByCountryIsoNr(int $country_iso_nr) Return the first User filtered by the country_iso_nr column
 * @method User findOneBySubdivisionId(int $subdivision_id) Return the first User filtered by the subdivision_id column
 * @method User findOneByAddress(string $address) Return the first User filtered by the address column
 * @method User findOneByAddress2(string $address2) Return the first User filtered by the address2 column
 * @method User findOneByBirthday(string $birthday) Return the first User filtered by the birthday column
 * @method User findOneBySex(int $sex) Return the first User filtered by the sex column
 * @method User findOneByClub(string $club) Return the first User filtered by the club column
 * @method User findOneByCity(string $city) Return the first User filtered by the city column
 * @method User findOneByPostalCode(string $postal_code) Return the first User filtered by the postal_code column
 * @method User findOneByTan(string $tan) Return the first User filtered by the tan column
 * @method User findOneByPasswordRecoverCode(string $password_recover_code) Return the first User filtered by the password_recover_code column
 * @method User findOneByPasswordRecoverTime(string $password_recover_time) Return the first User filtered by the password_recover_time column
 * @method User findOneByLocationStatus(int $location_status) Return the first User filtered by the location_status column
 * @method User findOneByLatitude(double $latitude) Return the first User filtered by the latitude column
 * @method User findOneByLongitude(double $longitude) Return the first User filtered by the longitude column
 * @method User findOneByCreated(string $created) Return the first User filtered by the created column
 * @method User findOneByUpdated(string $updated) Return the first User filtered by the updated column
 *
 * @method array findById(int $id) Return User objects filtered by the id column
 * @method array findByLoginName(string $login_name) Return User objects filtered by the login_name column
 * @method array findByPassword(string $password) Return User objects filtered by the password column
 * @method array findByGivenName(string $given_name) Return User objects filtered by the given_name column
 * @method array findByFamilyName(string $family_name) Return User objects filtered by the family_name column
 * @method array findByDisplayName(string $display_name) Return User objects filtered by the display_name column
 * @method array findByEmail(string $email) Return User objects filtered by the email column
 * @method array findByCountryIsoNr(int $country_iso_nr) Return User objects filtered by the country_iso_nr column
 * @method array findBySubdivisionId(int $subdivision_id) Return User objects filtered by the subdivision_id column
 * @method array findByAddress(string $address) Return User objects filtered by the address column
 * @method array findByAddress2(string $address2) Return User objects filtered by the address2 column
 * @method array findByBirthday(string $birthday) Return User objects filtered by the birthday column
 * @method array findBySex(int $sex) Return User objects filtered by the sex column
 * @method array findByClub(string $club) Return User objects filtered by the club column
 * @method array findByCity(string $city) Return User objects filtered by the city column
 * @method array findByPostalCode(string $postal_code) Return User objects filtered by the postal_code column
 * @method array findByTan(string $tan) Return User objects filtered by the tan column
 * @method array findByPasswordRecoverCode(string $password_recover_code) Return User objects filtered by the password_recover_code column
 * @method array findByPasswordRecoverTime(string $password_recover_time) Return User objects filtered by the password_recover_time column
 * @method array findByLocationStatus(int $location_status) Return User objects filtered by the location_status column
 * @method array findByLatitude(double $latitude) Return User objects filtered by the latitude column
 * @method array findByLongitude(double $longitude) Return User objects filtered by the longitude column
 * @method array findByCreated(string $created) Return User objects filtered by the created column
 * @method array findByUpdated(string $updated) Return User objects filtered by the updated column
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = 'keeko\\entities\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
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
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   User A model object, or null if the key is not found
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
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LOGIN_NAME`, `PASSWORD`, `GIVEN_NAME`, `FAMILY_NAME`, `DISPLAY_NAME`, `EMAIL`, `COUNTRY_ISO_NR`, `SUBDIVISION_ID`, `ADDRESS`, `ADDRESS2`, `BIRTHDAY`, `SEX`, `CLUB`, `CITY`, `POSTAL_CODE`, `TAN`, `PASSWORD_RECOVER_CODE`, `PASSWORD_RECOVER_TIME`, `LOCATION_STATUS`, `LATITUDE`, `LONGITUDE`, `CREATED`, `UPDATED` FROM `keeko_user` WHERE `ID` = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the login_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLoginName('fooValue');   // WHERE login_name = 'fooValue'
     * $query->filterByLoginName('%fooValue%'); // WHERE login_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $loginName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLoginName($loginName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($loginName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $loginName)) {
                $loginName = str_replace('*', '%', $loginName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::LOGIN_NAME, $loginName, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the given_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGivenName('fooValue');   // WHERE given_name = 'fooValue'
     * $query->filterByGivenName('%fooValue%'); // WHERE given_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $givenName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByGivenName($givenName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($givenName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $givenName)) {
                $givenName = str_replace('*', '%', $givenName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::GIVEN_NAME, $givenName, $comparison);
    }

    /**
     * Filter the query on the family_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFamilyName('fooValue');   // WHERE family_name = 'fooValue'
     * $query->filterByFamilyName('%fooValue%'); // WHERE family_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $familyName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByFamilyName($familyName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($familyName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $familyName)) {
                $familyName = str_replace('*', '%', $familyName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::FAMILY_NAME, $familyName, $comparison);
    }

    /**
     * Filter the query on the display_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayName('fooValue');   // WHERE display_name = 'fooValue'
     * $query->filterByDisplayName('%fooValue%'); // WHERE display_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $displayName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByDisplayName($displayName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $displayName)) {
                $displayName = str_replace('*', '%', $displayName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::DISPLAY_NAME, $displayName, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::EMAIL, $email, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCountryIsoNr($countryIsoNr = null, $comparison = null)
    {
        if (is_array($countryIsoNr)) {
            $useMinMax = false;
            if (isset($countryIsoNr['min'])) {
                $this->addUsingAlias(UserPeer::COUNTRY_ISO_NR, $countryIsoNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryIsoNr['max'])) {
                $this->addUsingAlias(UserPeer::COUNTRY_ISO_NR, $countryIsoNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::COUNTRY_ISO_NR, $countryIsoNr, $comparison);
    }

    /**
     * Filter the query on the subdivision_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubdivisionId(1234); // WHERE subdivision_id = 1234
     * $query->filterBySubdivisionId(array(12, 34)); // WHERE subdivision_id IN (12, 34)
     * $query->filterBySubdivisionId(array('min' => 12)); // WHERE subdivision_id > 12
     * </code>
     *
     * @see       filterBySubdivision()
     *
     * @param     mixed $subdivisionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterBySubdivisionId($subdivisionId = null, $comparison = null)
    {
        if (is_array($subdivisionId)) {
            $useMinMax = false;
            if (isset($subdivisionId['min'])) {
                $this->addUsingAlias(UserPeer::SUBDIVISION_ID, $subdivisionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subdivisionId['max'])) {
                $this->addUsingAlias(UserPeer::SUBDIVISION_ID, $subdivisionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::SUBDIVISION_ID, $subdivisionId, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%'); // WHERE address2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAddress2($address2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address2)) {
                $address2 = str_replace('*', '%', $address2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::ADDRESS2, $address2, $comparison);
    }

    /**
     * Filter the query on the birthday column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthday('2011-03-14'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday('now'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday(array('max' => 'yesterday')); // WHERE birthday > '2011-03-13'
     * </code>
     *
     * @param     mixed $birthday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByBirthday($birthday = null, $comparison = null)
    {
        if (is_array($birthday)) {
            $useMinMax = false;
            if (isset($birthday['min'])) {
                $this->addUsingAlias(UserPeer::BIRTHDAY, $birthday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthday['max'])) {
                $this->addUsingAlias(UserPeer::BIRTHDAY, $birthday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::BIRTHDAY, $birthday, $comparison);
    }

    /**
     * Filter the query on the sex column
     *
     * Example usage:
     * <code>
     * $query->filterBySex(1234); // WHERE sex = 1234
     * $query->filterBySex(array(12, 34)); // WHERE sex IN (12, 34)
     * $query->filterBySex(array('min' => 12)); // WHERE sex > 12
     * </code>
     *
     * @param     mixed $sex The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterBySex($sex = null, $comparison = null)
    {
        if (is_array($sex)) {
            $useMinMax = false;
            if (isset($sex['min'])) {
                $this->addUsingAlias(UserPeer::SEX, $sex['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sex['max'])) {
                $this->addUsingAlias(UserPeer::SEX, $sex['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::SEX, $sex, $comparison);
    }

    /**
     * Filter the query on the club column
     *
     * Example usage:
     * <code>
     * $query->filterByClub('fooValue');   // WHERE club = 'fooValue'
     * $query->filterByClub('%fooValue%'); // WHERE club LIKE '%fooValue%'
     * </code>
     *
     * @param     string $club The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByClub($club = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($club)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $club)) {
                $club = str_replace('*', '%', $club);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::CLUB, $club, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the postal_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCode('fooValue');   // WHERE postal_code = 'fooValue'
     * $query->filterByPostalCode('%fooValue%'); // WHERE postal_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postalCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPostalCode($postalCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postalCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postalCode)) {
                $postalCode = str_replace('*', '%', $postalCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::POSTAL_CODE, $postalCode, $comparison);
    }

    /**
     * Filter the query on the tan column
     *
     * Example usage:
     * <code>
     * $query->filterByTan('fooValue');   // WHERE tan = 'fooValue'
     * $query->filterByTan('%fooValue%'); // WHERE tan LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tan The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByTan($tan = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tan)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tan)) {
                $tan = str_replace('*', '%', $tan);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::TAN, $tan, $comparison);
    }

    /**
     * Filter the query on the password_recover_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordRecoverCode('fooValue');   // WHERE password_recover_code = 'fooValue'
     * $query->filterByPasswordRecoverCode('%fooValue%'); // WHERE password_recover_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordRecoverCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPasswordRecoverCode($passwordRecoverCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordRecoverCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passwordRecoverCode)) {
                $passwordRecoverCode = str_replace('*', '%', $passwordRecoverCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD_RECOVER_CODE, $passwordRecoverCode, $comparison);
    }

    /**
     * Filter the query on the password_recover_time column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordRecoverTime('2011-03-14'); // WHERE password_recover_time = '2011-03-14'
     * $query->filterByPasswordRecoverTime('now'); // WHERE password_recover_time = '2011-03-14'
     * $query->filterByPasswordRecoverTime(array('max' => 'yesterday')); // WHERE password_recover_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $passwordRecoverTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPasswordRecoverTime($passwordRecoverTime = null, $comparison = null)
    {
        if (is_array($passwordRecoverTime)) {
            $useMinMax = false;
            if (isset($passwordRecoverTime['min'])) {
                $this->addUsingAlias(UserPeer::PASSWORD_RECOVER_TIME, $passwordRecoverTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($passwordRecoverTime['max'])) {
                $this->addUsingAlias(UserPeer::PASSWORD_RECOVER_TIME, $passwordRecoverTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD_RECOVER_TIME, $passwordRecoverTime, $comparison);
    }

    /**
     * Filter the query on the location_status column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationStatus(1234); // WHERE location_status = 1234
     * $query->filterByLocationStatus(array(12, 34)); // WHERE location_status IN (12, 34)
     * $query->filterByLocationStatus(array('min' => 12)); // WHERE location_status > 12
     * </code>
     *
     * @param     mixed $locationStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLocationStatus($locationStatus = null, $comparison = null)
    {
        if (is_array($locationStatus)) {
            $useMinMax = false;
            if (isset($locationStatus['min'])) {
                $this->addUsingAlias(UserPeer::LOCATION_STATUS, $locationStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationStatus['max'])) {
                $this->addUsingAlias(UserPeer::LOCATION_STATUS, $locationStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::LOCATION_STATUS, $locationStatus, $comparison);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude(1234); // WHERE latitude = 1234
     * $query->filterByLatitude(array(12, 34)); // WHERE latitude IN (12, 34)
     * $query->filterByLatitude(array('min' => 12)); // WHERE latitude > 12
     * </code>
     *
     * @param     mixed $latitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, $comparison = null)
    {
        if (is_array($latitude)) {
            $useMinMax = false;
            if (isset($latitude['min'])) {
                $this->addUsingAlias(UserPeer::LATITUDE, $latitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitude['max'])) {
                $this->addUsingAlias(UserPeer::LATITUDE, $latitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::LATITUDE, $latitude, $comparison);
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude(1234); // WHERE longitude = 1234
     * $query->filterByLongitude(array(12, 34)); // WHERE longitude IN (12, 34)
     * $query->filterByLongitude(array('min' => 12)); // WHERE longitude > 12
     * </code>
     *
     * @param     mixed $longitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, $comparison = null)
    {
        if (is_array($longitude)) {
            $useMinMax = false;
            if (isset($longitude['min'])) {
                $this->addUsingAlias(UserPeer::LONGITUDE, $longitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitude['max'])) {
                $this->addUsingAlias(UserPeer::LONGITUDE, $longitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::LONGITUDE, $longitude, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(UserPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(UserPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdated('2011-03-14'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated('now'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated(array('max' => 'yesterday')); // WHERE updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $updated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(UserPeer::UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(UserPeer::UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(UserPeer::COUNTRY_ISO_NR, $country->getIsoNr(), $comparison);
        } elseif ($country instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::COUNTRY_ISO_NR, $country->toKeyValue('PrimaryKey', 'IsoNr'), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * Filter the query by a related Subdivision object
     *
     * @param   Subdivision|PropelObjectCollection $subdivision The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySubdivision($subdivision, $comparison = null)
    {
        if ($subdivision instanceof Subdivision) {
            return $this
                ->addUsingAlias(UserPeer::SUBDIVISION_ID, $subdivision->getId(), $comparison);
        } elseif ($subdivision instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::SUBDIVISION_ID, $subdivision->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * Filter the query by a related Group object
     *
     * @param   Group|PropelObjectCollection $group  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof Group) {
            return $this
                ->addUsingAlias(UserPeer::ID, $group->getUserId(), $comparison);
        } elseif ($group instanceof PropelObjectCollection) {
            return $this
                ->useGroupQuery()
                ->filterByPrimaryKeys($group->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type Group or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

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
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\keeko\entities\GroupQuery');
    }

    /**
     * Filter the query by a related GroupUser object
     *
     * @param   GroupUser|PropelObjectCollection $groupUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroupUser($groupUser, $comparison = null)
    {
        if ($groupUser instanceof GroupUser) {
            return $this
                ->addUsingAlias(UserPeer::ID, $groupUser->getUserId(), $comparison);
        } elseif ($groupUser instanceof PropelObjectCollection) {
            return $this
                ->useGroupUserQuery()
                ->filterByPrimaryKeys($groupUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGroupUser() only accepts arguments of type GroupUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GroupUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinGroupUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GroupUser');

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
            $this->addJoinObject($join, 'GroupUser');
        }

        return $this;
    }

    /**
     * Use the GroupUser relation GroupUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \keeko\entities\GroupUserQuery A secondary query class using the current class as primary query
     */
    public function useGroupUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroupUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GroupUser', '\keeko\entities\GroupUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::UPDATED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::UPDATED);
    }

    /**
     * Order by update date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::UPDATED);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::CREATED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::CREATED);
    }

    /**
     * Order by create date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::CREATED);
    }
}
