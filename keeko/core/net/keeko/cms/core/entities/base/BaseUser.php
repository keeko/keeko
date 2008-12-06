<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseUser extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\UserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the passwd field.
	 * @var        string
	 */
	protected $passwd;

	/**
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;

	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;

	/**
	 * The value for the birth field.
	 * @var        string
	 */
	protected $birth;

	/**
	 * The value for the created field.
	 * @var        string
	 */
	protected $created;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the gender field.
	 * @var        string
	 */
	protected $gender;

	/**
	 * @var        array net\keeko\cms\core\entities\Role[] Collection to store aggregation of net\keeko\cms\core\entities\Role objects.
	 */
	protected $collRoles;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRoles.
	 */
	private $lastRoleCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\RoleUser[] Collection to store aggregation of net\keeko\cms\core\entities\RoleUser objects.
	 */
	protected $collRoleUsers;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRoleUsers.
	 */
	private $lastRoleUserCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\UserExtVal[] Collection to store aggregation of net\keeko\cms\core\entities\UserExtVal objects.
	 */
	protected $collUserExtVals;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserExtVals.
	 */
	private $lastUserExtValCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\UserSettingValue[] Collection to store aggregation of net\keeko\cms\core\entities\UserSettingValue objects.
	 */
	protected $collUserSettingValues;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserSettingValues.
	 */
	private $lastUserSettingValueCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseUser object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [passwd] column value.
	 * 
	 * @return     string
	 */
	public function getPasswd()
	{
		return $this->passwd;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{
		return $this->first_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{
		return $this->last_name;
	}

	/**
	 * Get the [optionally formatted] temporal [birth] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getBirth($format = '%x')
	{
		if ($this->birth === null) {
			return null;
		}


		if ($this->birth === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->birth);
			} catch (Exception $x) {
				throw new \PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birth, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [created] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreated($format = 'Y-m-d H:i:s')
	{
		if ($this->created === null) {
			return null;
		}


		if ($this->created === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created);
			} catch (Exception $x) {
				throw new \PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [gender] column value.
	 * 
	 * @return     string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->passwd !== $v) {
			$this->passwd = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::PASSWD;
		}

		return $this;
	} // setPasswd()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::FIRST_NAME;
		}

		return $this;
	} // setFirstName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::LAST_NAME;
		}

		return $this;
	} // setLastName()

	/**
	 * Sets the value of [birth] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setBirth($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new \PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->birth !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->birth !== null && $tmpDt = new DateTime($this->birth)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->birth = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::BIRTH;
			}
		} // if either are not null

		return $this;
	} // setBirth()

	/**
	 * Sets the value of [created] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setCreated($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new \PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created !== null && $tmpDt = new DateTime($this->created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::CREATED;
			}
		} // if either are not null

		return $this;
	} // setCreated()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [gender] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\User The current object (for fluent API support)
	 */
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::GENDER;
		}

		return $this;
	} // setGender()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by \PDOStatement->fetch(\PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->passwd = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->first_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->last_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->birth = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->created = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->email = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->gender = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = \net\keeko\cms\core\entities\peer\UserPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\UserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating User object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, \PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new \PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new \PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collRoles = null;
			$this->lastRoleCriteria = null;

			$this->collRoleUsers = null;
			$this->lastRoleUserCriteria = null;

			$this->collUserExtVals = null;
			$this->lastUserExtValCriteria = null;

			$this->collUserSettingValues = null;
			$this->lastUserSettingValueCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(\PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new \PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (\PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(\PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new \PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\UserPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (\PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(\PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\UserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\UserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRoles !== null) {
				foreach ($this->collRoles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRoleUsers !== null) {
				foreach ($this->collRoleUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserExtVals !== null) {
				foreach ($this->collUserExtVals as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserSettingValues !== null) {
				foreach ($this->collUserSettingValues as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = \net\keeko\cms\core\entities\peer\UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRoles !== null) {
					foreach ($this->collRoles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRoleUsers !== null) {
					foreach ($this->collRoleUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserExtVals !== null) {
					foreach ($this->collUserExtVals as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserSettingValues !== null) {
					foreach ($this->collUserSettingValues as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = \BasePeer::TYPE_PHPNAME)
	{
		$pos = \net\keeko\cms\core\entities\peer\UserPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getPasswd();
				break;
			case 3:
				return $this->getFirstName();
				break;
			case 4:
				return $this->getLastName();
				break;
			case 5:
				return $this->getBirth();
				break;
			case 6:
				return $this->getCreated();
				break;
			case 7:
				return $this->getEmail();
				break;
			case 8:
				return $this->getGender();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = \BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = \net\keeko\cms\core\entities\peer\UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getPasswd(),
			$keys[3] => $this->getFirstName(),
			$keys[4] => $this->getLastName(),
			$keys[5] => $this->getBirth(),
			$keys[6] => $this->getCreated(),
			$keys[7] => $this->getEmail(),
			$keys[8] => $this->getGender(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = \net\keeko\cms\core\entities\peer\UserPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setPasswd($value);
				break;
			case 3:
				$this->setFirstName($value);
				break;
			case 4:
				$this->setLastName($value);
				break;
			case 5:
				$this->setBirth($value);
				break;
			case 6:
				$this->setCreated($value);
				break;
			case 7:
				$this->setEmail($value);
				break;
			case 8:
				$this->setGender($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = \BasePeer::TYPE_PHPNAME)
	{
		$keys = \net\keeko\cms\core\entities\peer\UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPasswd($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFirstName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBirth($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreated($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setGender($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::NAME)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::NAME, $this->name);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::PASSWD)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::PASSWD, $this->passwd);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::FIRST_NAME)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::LAST_NAME)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::BIRTH)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::BIRTH, $this->birth);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::CREATED)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::CREATED, $this->created);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::EMAIL)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserPeer::GENDER)) $criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::GENDER, $this->gender);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\UserPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setPasswd($this->passwd);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setBirth($this->birth);

		$copyObj->setCreated($this->created);

		$copyObj->setEmail($this->email);

		$copyObj->setGender($this->gender);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRoles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRole($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRoleUsers() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRoleUser($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserExtVals() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserExtVal($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserSettingValues() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserSettingValue($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     net\keeko\cms\core\entities\User Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     \net\keeko\cms\core\entities\peer\UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\UserPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collRoles collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRoles()
	 */
	public function clearRoles()
	{
		$this->collRoles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRoles collection (array).
	 *
	 * By default this just sets the collRoles collection to an empty array (like clearcollRoles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRoles()
	{
		$this->collRoles = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Role objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\User has previously been saved, it will retrieve
	 * related Roles from storage. If this net\keeko\cms\core\entities\User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Role[]
	 * @throws     PropelException
	 */
	public function getRoles($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoles === null) {
			if ($this->isNew()) {
			   $this->collRoles = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RolePeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RolePeer::addSelectColumns($criteria);
				$this->collRoles = \net\keeko\cms\core\entities\peer\RolePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RolePeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RolePeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleCriteria) || !$this->lastRoleCriteria->equals($criteria)) {
					$this->collRoles = \net\keeko\cms\core\entities\peer\RolePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleCriteria = $criteria;
		return $this->collRoles;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Role objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Role objects.
	 * @throws     PropelException
	 */
	public function countRoles(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRoles === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RolePeer::USER_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\RolePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RolePeer::USER_ID, $this->id);

				if (!isset($this->lastRoleCriteria) || !$this->lastRoleCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\RolePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRoles);
				}
			} else {
				$count = count($this->collRoles);
			}
		}
		$this->lastRoleCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\Role object to this object
	 * through the net\keeko\cms\core\entities\Role foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Role $l net\keeko\cms\core\entities\Role
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRole(net\keeko\cms\core\entities\Role $l)
	{
		if ($this->collRoles === null) {
			$this->initRoles();
		}
	
		if (!in_array($l, $this->collRoles, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRoles, $l);
			$l->setUser($this);
		}
	}

	/**
	 * Clears out the collRoleUsers collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRoleUsers()
	 */
	public function clearRoleUsers()
	{
		$this->collRoleUsers = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRoleUsers collection (array).
	 *
	 * By default this just sets the collRoleUsers collection to an empty array (like clearcollRoleUsers());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRoleUsers()
	{
		$this->collRoleUsers = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\RoleUser objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\User has previously been saved, it will retrieve
	 * related RoleUsers from storage. If this net\keeko\cms\core\entities\User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\RoleUser[]
	 * @throws     PropelException
	 */
	public function getRoleUsers($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
			   $this->collRoleUsers = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RoleUserPeer::addSelectColumns($criteria);
				$this->collRoleUsers = \net\keeko\cms\core\entities\peer\RoleUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RoleUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$this->collRoleUsers = \net\keeko\cms\core\entities\peer\RoleUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleUserCriteria = $criteria;
		return $this->collRoleUsers;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\RoleUser objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\RoleUser objects.
	 * @throws     PropelException
	 */
	public function countRoleUsers(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\RoleUserPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\RoleUserPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRoleUsers);
				}
			} else {
				$count = count($this->collRoleUsers);
			}
		}
		$this->lastRoleUserCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\RoleUser object to this object
	 * through the net\keeko\cms\core\entities\RoleUser foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\RoleUser $l net\keeko\cms\core\entities\RoleUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoleUser(net\keeko\cms\core\entities\RoleUser $l)
	{
		if ($this->collRoleUsers === null) {
			$this->initRoleUsers();
		}
	
		if (!in_array($l, $this->collRoleUsers, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRoleUsers, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getRoleUsersJoinRole($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
				$this->collRoleUsers = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

				$this->collRoleUsers = \net\keeko\cms\core\entities\peer\RoleUserPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\RoleUserPeer::USER_ID, $this->id);

			if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
				$this->collRoleUsers = \net\keeko\cms\core\entities\peer\RoleUserPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastRoleUserCriteria = $criteria;

		return $this->collRoleUsers;
	}

	/**
	 * Clears out the collUserExtVals collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserExtVals()
	 */
	public function clearUserExtVals()
	{
		$this->collUserExtVals = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserExtVals collection (array).
	 *
	 * By default this just sets the collUserExtVals collection to an empty array (like clearcollUserExtVals());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserExtVals()
	{
		$this->collUserExtVals = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\UserExtVal objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\User has previously been saved, it will retrieve
	 * related UserExtVals from storage. If this net\keeko\cms\core\entities\User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\UserExtVal[]
	 * @throws     PropelException
	 */
	public function getUserExtVals($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtVals === null) {
			if ($this->isNew()) {
			   $this->collUserExtVals = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtValPeer::addSelectColumns($criteria);
				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtValPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserExtValCriteria) || !$this->lastUserExtValCriteria->equals($criteria)) {
					$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserExtValCriteria = $criteria;
		return $this->collUserExtVals;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\UserExtVal objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\UserExtVal objects.
	 * @throws     PropelException
	 */
	public function countUserExtVals(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserExtVals === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UserExtValPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

				if (!isset($this->lastUserExtValCriteria) || !$this->lastUserExtValCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UserExtValPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserExtVals);
				}
			} else {
				$count = count($this->collUserExtVals);
			}
		}
		$this->lastUserExtValCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\UserExtVal object to this object
	 * through the net\keeko\cms\core\entities\UserExtVal foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\UserExtVal $l net\keeko\cms\core\entities\UserExtVal
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserExtVal(net\keeko\cms\core\entities\UserExtVal $l)
	{
		if ($this->collUserExtVals === null) {
			$this->initUserExtVals();
		}
	
		if (!in_array($l, $this->collUserExtVals, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserExtVals, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related UserExtVals from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getUserExtValsJoinUserExt($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtVals === null) {
			if ($this->isNew()) {
				$this->collUserExtVals = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelectJoinUserExt($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::USER_ID, $this->id);

			if (!isset($this->lastUserExtValCriteria) || !$this->lastUserExtValCriteria->equals($criteria)) {
				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelectJoinUserExt($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserExtValCriteria = $criteria;

		return $this->collUserExtVals;
	}

	/**
	 * Clears out the collUserSettingValues collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserSettingValues()
	 */
	public function clearUserSettingValues()
	{
		$this->collUserSettingValues = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserSettingValues collection (array).
	 *
	 * By default this just sets the collUserSettingValues collection to an empty array (like clearcollUserSettingValues());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserSettingValues()
	{
		$this->collUserSettingValues = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\UserSettingValue objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\User has previously been saved, it will retrieve
	 * related UserSettingValues from storage. If this net\keeko\cms\core\entities\User is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\UserSettingValue[]
	 * @throws     PropelException
	 */
	public function getUserSettingValues($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSettingValues === null) {
			if ($this->isNew()) {
			   $this->collUserSettingValues = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserSettingValuePeer::addSelectColumns($criteria);
				$this->collUserSettingValues = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserSettingValuePeer::addSelectColumns($criteria);
				if (!isset($this->lastUserSettingValueCriteria) || !$this->lastUserSettingValueCriteria->equals($criteria)) {
					$this->collUserSettingValues = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserSettingValueCriteria = $criteria;
		return $this->collUserSettingValues;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\UserSettingValue objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\UserSettingValue objects.
	 * @throws     PropelException
	 */
	public function countUserSettingValues(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUserSettingValues === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

				if (!isset($this->lastUserSettingValueCriteria) || !$this->lastUserSettingValueCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserSettingValues);
				}
			} else {
				$count = count($this->collUserSettingValues);
			}
		}
		$this->lastUserSettingValueCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\UserSettingValue object to this object
	 * through the net\keeko\cms\core\entities\UserSettingValue foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\UserSettingValue $l net\keeko\cms\core\entities\UserSettingValue
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserSettingValue(net\keeko\cms\core\entities\UserSettingValue $l)
	{
		if ($this->collUserSettingValues === null) {
			$this->initUserSettingValues();
		}
	
		if (!in_array($l, $this->collUserSettingValues, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserSettingValues, $l);
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related UserSettingValues from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getUserSettingValuesJoinUserSetting($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSettingValues === null) {
			if ($this->isNew()) {
				$this->collUserSettingValues = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

				$this->collUserSettingValues = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doSelectJoinUserSetting($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\UserSettingValuePeer::USER_ID, $this->id);

			if (!isset($this->lastUserSettingValueCriteria) || !$this->lastUserSettingValueCriteria->equals($criteria)) {
				$this->collUserSettingValues = \net\keeko\cms\core\entities\peer\UserSettingValuePeer::doSelectJoinUserSetting($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserSettingValueCriteria = $criteria;

		return $this->collUserSettingValues;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRoles) {
				foreach ((array) $this->collRoles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRoleUsers) {
				foreach ((array) $this->collRoleUsers as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserExtVals) {
				foreach ((array) $this->collUserExtVals as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserSettingValues) {
				foreach ((array) $this->collUserSettingValues as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRoles = null;
		$this->collRoleUsers = null;
		$this->collUserExtVals = null;
		$this->collUserSettingValues = null;
	}

} // net\keeko\cms\core\entities\base\BaseUser
