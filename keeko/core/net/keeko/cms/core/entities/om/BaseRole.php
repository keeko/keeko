<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::RolePeer;
use net::keeko::cms::core::entities::UserPeer;
use net::keeko::cms::core::entities::RoleActionPeer;
use net::keeko::cms::core::entities::RoleUserPeer;
use net::keeko::cms::core::entities::PagePermissionPeer;



/**
 * Base class that represents a row from the 'role' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseRole extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RolePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the is_guest field.
	 * @var        boolean
	 */
	protected $is_guest;

	/**
	 * The value for the is_default field.
	 * @var        boolean
	 */
	protected $is_default;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the is_system field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_system;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        array RoleAction[] Collection to store aggregation of RoleAction objects.
	 */
	protected $collRoleActions;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collRoleActions.
	 */
	private $lastRoleActionCriteria = null;

	/**
	 * @var        array RoleUser[] Collection to store aggregation of RoleUser objects.
	 */
	protected $collRoleUsers;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collRoleUsers.
	 */
	private $lastRoleUserCriteria = null;

	/**
	 * @var        array PagePermission[] Collection to store aggregation of PagePermission objects.
	 */
	protected $collPagePermissions;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagePermissions.
	 */
	private $lastPagePermissionCriteria = null;

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
	 * Initializes internal state of BaseRole object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
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
		$this->is_active = true;
		$this->is_system = false;
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
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
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
	 * Get the [is_guest] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsGuest()
	{
		return $this->is_guest;
	}

	/**
	 * Get the [is_default] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsDefault()
	{
		return $this->is_default;
	}

	/**
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	 * Get the [is_system] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSystem()
	{
		return $this->is_system;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RolePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = RolePeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = RolePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [is_guest] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setIsGuest($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_guest !== $v) {
			$this->is_guest = $v;
			$this->modifiedColumns[] = RolePeer::IS_GUEST;
		}

		return $this;
	} // setIsGuest()

	/**
	 * Set the value of [is_default] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setIsDefault($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_default !== $v) {
			$this->is_default = $v;
			$this->modifiedColumns[] = RolePeer::IS_DEFAULT;
		}

		return $this;
	} // setIsDefault()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = RolePeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [is_system] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Role The current object (for fluent API support)
	 */
	public function setIsSystem($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_system !== $v || $v === false) {
			$this->is_system = $v;
			$this->modifiedColumns[] = RolePeer::IS_SYSTEM;
		}

		return $this;
	} // setIsSystem()

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
			if (array_diff($this->modifiedColumns, array(RolePeer::IS_ACTIVE,RolePeer::IS_SYSTEM))) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_system !== false) {
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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     ::PropelException  - Any caught Exception will be rewrapped as a ::PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->is_guest = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->is_default = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->is_active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->is_system = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating Role object", $e);
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
	 * @throws     ::PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
			$this->aUser = null;
		}
	
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      ::PropelPDO $con (optional) The ::PropelPDO connection to use.
	 * @return     void
	 * @throws     ::PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, ::PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new ::PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new ::PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = ::Propel::getConnection(RolePeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RolePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->collRoleActions = null;
			$this->lastRoleActionCriteria = null;

			$this->collRoleUsers = null;
			$this->lastRoleUserCriteria = null;

			$this->collPagePermissions = null;
			$this->lastPagePermissionCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      ::PropelPDO $con
	 * @return     void
	 * @throws     ::PropelException
	 * @see        ::BaseObject::setDeleted()
	 * @see        ::BaseObject::isDeleted()
	 */
	public function delete(::PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new ::PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = ::Propel::getConnection(RolePeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			RolePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      ::PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     ::PropelException
	 * @see        doSave()
	 */
	public function save(::PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new ::PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = ::Propel::getConnection(RolePeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			RolePeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (::PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      ::PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     ::PropelException
	 * @see        save()
	 */
	protected function doSave(::PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if ($this->aUser->isModified() || $this->aUser->isNew()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RolePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RolePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRoleActions !== null) {
				foreach ($this->collRoleActions as $referrerFK) {
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

			if ($this->collPagePermissions !== null) {
				foreach ($this->collPagePermissions as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = RolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRoleActions !== null) {
					foreach ($this->collRoleActions as $referrerFK) {
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

				if ($this->collPagePermissions !== null) {
					foreach ($this->collPagePermissions as $referrerFK) {
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
	 *                     one of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME
	 *                     ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = ::BasePeer::TYPE_PHPNAME)
	{
		$pos = RolePeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getIsGuest();
				break;
			case 4:
				return $this->getIsDefault();
				break;
			case 5:
				return $this->getIsActive();
				break;
			case 6:
				return $this->getIsSystem();
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
	 * @param      string $keyType (optional) One of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME
	 *                        ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM. Defaults to ::BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = ::BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getIsGuest(),
			$keys[4] => $this->getIsDefault(),
			$keys[5] => $this->getIsActive(),
			$keys[6] => $this->getIsSystem(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME
	 *                     ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = ::BasePeer::TYPE_PHPNAME)
	{
		$pos = RolePeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setIsGuest($value);
				break;
			case 4:
				$this->setIsDefault($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
			case 6:
				$this->setIsSystem($value);
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
	 * of the class type constants ::BasePeer::TYPE_PHPNAME, ::BasePeer::TYPE_STUDLYPHPNAME,
	 * ::BasePeer::TYPE_COLNAME, ::BasePeer::TYPE_FIELDNAME, ::BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = ::BasePeer::TYPE_PHPNAME)
	{
		$keys = RolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsGuest($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsDefault($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsSystem($arr[$keys[6]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(RolePeer::DATABASE_NAME);

		if ($this->isColumnModified(RolePeer::ID)) $criteria->add(RolePeer::ID, $this->id);
		if ($this->isColumnModified(RolePeer::USER_ID)) $criteria->add(RolePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(RolePeer::NAME)) $criteria->add(RolePeer::NAME, $this->name);
		if ($this->isColumnModified(RolePeer::IS_GUEST)) $criteria->add(RolePeer::IS_GUEST, $this->is_guest);
		if ($this->isColumnModified(RolePeer::IS_DEFAULT)) $criteria->add(RolePeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(RolePeer::IS_ACTIVE)) $criteria->add(RolePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(RolePeer::IS_SYSTEM)) $criteria->add(RolePeer::IS_SYSTEM, $this->is_system);

		return $criteria;
	}

	/**
	 * Builds a ::Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     ::Criteria The ::Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new ::Criteria(RolePeer::DATABASE_NAME);

		$criteria->add(RolePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Role (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setName($this->name);

		$copyObj->setIsGuest($this->is_guest);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSystem($this->is_system);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRoleActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRoleAction($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRoleUsers() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRoleUser($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPagePermissions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPagePermission($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

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
	 * @return     Role Clone of current object.
	 * @throws     ::PropelException
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
	 * @return     RolePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RolePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Role The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addRole($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     ::PropelException
	 */
	public function getUser(::PropelPDO $con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUser->addRoles($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Temporary storage of collRoleActions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addRoleActions() method.
	 * @see        addRoleActions()
	 */
	public function initRoleActions()
	{
		if ($this->collRoleActions === null) {
			$this->collRoleActions = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related RoleActions from storage. If this Role is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getRoleActions($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleActions === null) {
			if ($this->isNew()) {
			   $this->collRoleActions = array();
			} else {

				$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

				RoleActionPeer::addSelectColumns($criteria);
				$this->collRoleActions = RoleActionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

				RoleActionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
					$this->collRoleActions = RoleActionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleActionCriteria = $criteria;
		return $this->collRoleActions;
	}

	/**
	 * Returns the number of related RoleActions.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countRoleActions(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRoleActions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

				$count = RoleActionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

				if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
					$count = RoleActionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRoleActions);
				}
			} else {
				$count = count($this->collRoleActions);
			}
		}
		$this->lastRoleActionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RoleAction object to this object
	 * through the RoleAction foreign key attribute.
	 *
	 * @param      RoleAction $l RoleAction
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addRoleAction(RoleAction $l)
	{
		if ($this->collRoleActions === null) {
			$this->collRoleActions = array();
		}
		if (!in_array($l, $this->collRoleActions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRoleActions, $l);
			$l->setRole($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related RoleActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getRoleActionsJoinAction($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleActions === null) {
			if ($this->isNew()) {
				$this->collRoleActions = array();
			} else {

				$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

				$this->collRoleActions = RoleActionPeer::doSelectJoinAction($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RoleActionPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
				$this->collRoleActions = RoleActionPeer::doSelectJoinAction($criteria, $con);
			}
		}
		$this->lastRoleActionCriteria = $criteria;

		return $this->collRoleActions;
	}

	/**
	 * Temporary storage of collRoleUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addRoleUsers() method.
	 * @see        addRoleUsers()
	 */
	public function initRoleUsers()
	{
		if ($this->collRoleUsers === null) {
			$this->collRoleUsers = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related RoleUsers from storage. If this Role is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getRoleUsers($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
			   $this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleUserCriteria = $criteria;
		return $this->collRoleUsers;
	}

	/**
	 * Returns the number of related RoleUsers.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countRoleUsers(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
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

				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				$count = RoleUserPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$count = RoleUserPeer::doCount($criteria, $con);
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
	 * Method called to associate a RoleUser object to this object
	 * through the RoleUser foreign key attribute.
	 *
	 * @param      RoleUser $l RoleUser
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addRoleUser(RoleUser $l)
	{
		if ($this->collRoleUsers === null) {
			$this->collRoleUsers = array();
		}
		if (!in_array($l, $this->collRoleUsers, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRoleUsers, $l);
			$l->setRole($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getRoleUsersJoinUser($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
				$this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				$this->collRoleUsers = RoleUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
				$this->collRoleUsers = RoleUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastRoleUserCriteria = $criteria;

		return $this->collRoleUsers;
	}

	/**
	 * Temporary storage of collPagePermissions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPagePermissions() method.
	 * @see        addPagePermissions()
	 */
	public function initPagePermissions()
	{
		if ($this->collPagePermissions === null) {
			$this->collPagePermissions = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Role has previously been saved, it will retrieve
	 * related PagePermissions from storage. If this Role is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPagePermissions($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagePermissions === null) {
			if ($this->isNew()) {
			   $this->collPagePermissions = array();
			} else {

				$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

				PagePermissionPeer::addSelectColumns($criteria);
				$this->collPagePermissions = PagePermissionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

				PagePermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastPagePermissionCriteria) || !$this->lastPagePermissionCriteria->equals($criteria)) {
					$this->collPagePermissions = PagePermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPagePermissionCriteria = $criteria;
		return $this->collPagePermissions;
	}

	/**
	 * Returns the number of related PagePermissions.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPagePermissions(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPagePermissions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

				$count = PagePermissionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

				if (!isset($this->lastPagePermissionCriteria) || !$this->lastPagePermissionCriteria->equals($criteria)) {
					$count = PagePermissionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPagePermissions);
				}
			} else {
				$count = count($this->collPagePermissions);
			}
		}
		$this->lastPagePermissionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PagePermission object to this object
	 * through the PagePermission foreign key attribute.
	 *
	 * @param      PagePermission $l PagePermission
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPagePermission(PagePermission $l)
	{
		if ($this->collPagePermissions === null) {
			$this->collPagePermissions = array();
		}
		if (!in_array($l, $this->collPagePermissions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPagePermissions, $l);
			$l->setRole($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related PagePermissions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getPagePermissionsJoinPage($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagePermissions === null) {
			if ($this->isNew()) {
				$this->collPagePermissions = array();
			} else {

				$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

				$this->collPagePermissions = PagePermissionPeer::doSelectJoinPage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePermissionPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastPagePermissionCriteria) || !$this->lastPagePermissionCriteria->equals($criteria)) {
				$this->collPagePermissions = PagePermissionPeer::doSelectJoinPage($criteria, $con);
			}
		}
		$this->lastPagePermissionCriteria = $criteria;

		return $this->collPagePermissions;
	}

} // BaseRole
