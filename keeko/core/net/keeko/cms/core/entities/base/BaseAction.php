<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'action' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseAction extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\ActionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the module_id field.
	 * @var        int
	 */
	protected $module_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * @var        Module
	 */
	protected $aModule;

	/**
	 * @var        array net\keeko\cms\core\entities\MenuItem[] Collection to store aggregation of net\keeko\cms\core\entities\MenuItem objects.
	 */
	protected $collMenuItems;

	/**
	 * @var        Criteria The criteria used to select the current contents of collMenuItems.
	 */
	private $lastMenuItemCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\RoleAction[] Collection to store aggregation of net\keeko\cms\core\entities\RoleAction objects.
	 */
	protected $collRoleActions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRoleActions.
	 */
	private $lastRoleActionCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\UnitAction[] Collection to store aggregation of net\keeko\cms\core\entities\UnitAction objects.
	 */
	protected $collUnitActions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUnitActions.
	 */
	private $lastUnitActionCriteria = null;

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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseAction object.
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
	 * Get the [module_id] column value.
	 * 
	 * @return     int
	 */
	public function getModuleId()
	{
		return $this->module_id;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Action The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\ActionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [module_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Action The current object (for fluent API support)
	 */
	public function setModuleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->module_id !== $v) {
			$this->module_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\ActionPeer::MODULE_ID;
		}

		if ($this->aModule !== null && $this->aModule->getId() !== $v) {
			$this->aModule = null;
		}

		return $this;
	} // setModuleId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Action The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\ActionPeer::NAME;
		}

		return $this;
	} // setName()

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
			$this->module_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = \net\keeko\cms\core\entities\peer\ActionPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\ActionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating Action object", $e);
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

		if ($this->aModule !== null && $this->module_id !== $this->aModule->getId()) {
			$this->aModule = null;
		}
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\ActionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aModule = null;
			$this->collMenuItems = null;
			$this->lastMenuItemCriteria = null;

			$this->collRoleActions = null;
			$this->lastRoleActionCriteria = null;

			$this->collUnitActions = null;
			$this->lastUnitActionCriteria = null;

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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\ActionPeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\ActionPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aModule !== null) {
				if ($this->aModule->isModified() || $this->aModule->isNew()) {
					$affectedRows += $this->aModule->save($con);
				}
				$this->setModule($this->aModule);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\ActionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\ActionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\ActionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collMenuItems !== null) {
				foreach ($this->collMenuItems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRoleActions !== null) {
				foreach ($this->collRoleActions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUnitActions !== null) {
				foreach ($this->collUnitActions as $referrerFK) {
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

			if ($this->aModule !== null) {
				if (!$this->aModule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModule->getValidationFailures());
				}
			}


			if (($retval = \net\keeko\cms\core\entities\peer\ActionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMenuItems !== null) {
					foreach ($this->collMenuItems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRoleActions !== null) {
					foreach ($this->collRoleActions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUnitActions !== null) {
					foreach ($this->collUnitActions as $referrerFK) {
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
		$pos = \net\keeko\cms\core\entities\peer\ActionPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				return $this->getModuleId();
				break;
			case 2:
				return $this->getName();
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
		$keys = \net\keeko\cms\core\entities\peer\ActionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getModuleId(),
			$keys[2] => $this->getName(),
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
		$pos = \net\keeko\cms\core\entities\peer\ActionPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				$this->setModuleId($value);
				break;
			case 2:
				$this->setName($value);
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
		$keys = \net\keeko\cms\core\entities\peer\ActionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setModuleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\ActionPeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\ActionPeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\ActionPeer::MODULE_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\ActionPeer::MODULE_ID, $this->module_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\ActionPeer::NAME)) $criteria->add(\net\keeko\cms\core\entities\peer\ActionPeer::NAME, $this->name);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\ActionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\Action (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setModuleId($this->module_id);

		$copyObj->setName($this->name);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getMenuItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMenuItem($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRoleActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRoleAction($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUnitActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUnitAction($relObj->copy($deepCopy));
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
	 * @return     net\keeko\cms\core\entities\Action Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\ActionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\ActionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Module object.
	 *
	 * @param      net\keeko\cms\core\entities\Module $v
	 * @return     net\keeko\cms\core\entities\Action The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setModule(\net\keeko\cms\core\entities\Module $v = null)
	{
		if ($v === null) {
			$this->setModuleId(NULL);
		} else {
			$this->setModuleId($v->getId());
		}

		$this->aModule = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Module object, it will not be re-added.
		if ($v !== null) {
			$v->addAction($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Module object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Module The associated net\keeko\cms\core\entities\Module object.
	 * @throws     PropelException
	 */
	public function getModule(\PropelPDO $con = null)
	{
		if ($this->aModule === null && ($this->module_id !== null)) {
			$this->aModule = \net\keeko\cms\core\entities\peer\ModulePeer::retrieveByPK($this->module_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aModule->addActions($this);
			 */
		}
		return $this->aModule;
	}

	/**
	 * Clears out the collMenuItems collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMenuItems()
	 */
	public function clearMenuItems()
	{
		$this->collMenuItems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMenuItems collection (array).
	 *
	 * By default this just sets the collMenuItems collection to an empty array (like clearcollMenuItems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initMenuItems()
	{
		$this->collMenuItems = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\MenuItem objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Action has previously been saved, it will retrieve
	 * related MenuItems from storage. If this net\keeko\cms\core\entities\Action is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\MenuItem[]
	 * @throws     PropelException
	 */
	public function getMenuItems($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
			   $this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\MenuItemPeer::addSelectColumns($criteria);
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\MenuItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
					$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMenuItemCriteria = $criteria;
		return $this->collMenuItems;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\MenuItem objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\MenuItem objects.
	 * @throws     PropelException
	 */
	public function countMenuItems(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\MenuItemPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\MenuItemPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collMenuItems);
				}
			} else {
				$count = count($this->collMenuItems);
			}
		}
		$this->lastMenuItemCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\MenuItem object to this object
	 * through the net\keeko\cms\core\entities\MenuItem foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\MenuItem $l net\keeko\cms\core\entities\MenuItem
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMenuItem(\net\keeko\cms\core\entities\MenuItem $l)
	{
		if ($this->collMenuItems === null) {
			$this->initMenuItems();
		}
	
		if (!in_array($l, $this->collMenuItems, true)) { // only add it if the **same** object is not already associated
			array_push($this->collMenuItems, $l);
			$l->setAction($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getMenuItemsJoinPage($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getMenuItemsJoinLanguageText($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinLanguageText($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinLanguageText($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getMenuItemsJoinMenu($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenu($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenu($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getMenuItemsJoinMenuItemRelatedByParentId($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getMenuItemsJoinModule($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}

	/**
	 * Clears out the collRoleActions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRoleActions()
	 */
	public function clearRoleActions()
	{
		$this->collRoleActions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRoleActions collection (array).
	 *
	 * By default this just sets the collRoleActions collection to an empty array (like clearcollRoleActions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRoleActions()
	{
		$this->collRoleActions = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\RoleAction objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Action has previously been saved, it will retrieve
	 * related RoleActions from storage. If this net\keeko\cms\core\entities\Action is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\RoleAction[]
	 * @throws     PropelException
	 */
	public function getRoleActions($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleActions === null) {
			if ($this->isNew()) {
			   $this->collRoleActions = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RoleActionPeer::addSelectColumns($criteria);
				$this->collRoleActions = \net\keeko\cms\core\entities\peer\RoleActionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\RoleActionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
					$this->collRoleActions = \net\keeko\cms\core\entities\peer\RoleActionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleActionCriteria = $criteria;
		return $this->collRoleActions;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\RoleAction objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\RoleAction objects.
	 * @throws     PropelException
	 */
	public function countRoleActions(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\RoleActionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

				if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\RoleActionPeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\RoleAction object to this object
	 * through the net\keeko\cms\core\entities\RoleAction foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\RoleAction $l net\keeko\cms\core\entities\RoleAction
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoleAction(\net\keeko\cms\core\entities\RoleAction $l)
	{
		if ($this->collRoleActions === null) {
			$this->initRoleActions();
		}
	
		if (!in_array($l, $this->collRoleActions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRoleActions, $l);
			$l->setAction($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related RoleActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getRoleActionsJoinRole($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleActions === null) {
			if ($this->isNew()) {
				$this->collRoleActions = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

				$this->collRoleActions = \net\keeko\cms\core\entities\peer\RoleActionPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\RoleActionPeer::ACTION_ID, $this->id);

			if (!isset($this->lastRoleActionCriteria) || !$this->lastRoleActionCriteria->equals($criteria)) {
				$this->collRoleActions = \net\keeko\cms\core\entities\peer\RoleActionPeer::doSelectJoinRole($criteria, $con, $join_behavior);
			}
		}
		$this->lastRoleActionCriteria = $criteria;

		return $this->collRoleActions;
	}

	/**
	 * Clears out the collUnitActions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUnitActions()
	 */
	public function clearUnitActions()
	{
		$this->collUnitActions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUnitActions collection (array).
	 *
	 * By default this just sets the collUnitActions collection to an empty array (like clearcollUnitActions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUnitActions()
	{
		$this->collUnitActions = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\UnitAction objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Action has previously been saved, it will retrieve
	 * related UnitActions from storage. If this net\keeko\cms\core\entities\Action is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\UnitAction[]
	 * @throws     PropelException
	 */
	public function getUnitActions($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUnitActions === null) {
			if ($this->isNew()) {
			   $this->collUnitActions = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UnitActionPeer::addSelectColumns($criteria);
				$this->collUnitActions = \net\keeko\cms\core\entities\peer\UnitActionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UnitActionPeer::addSelectColumns($criteria);
				if (!isset($this->lastUnitActionCriteria) || !$this->lastUnitActionCriteria->equals($criteria)) {
					$this->collUnitActions = \net\keeko\cms\core\entities\peer\UnitActionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUnitActionCriteria = $criteria;
		return $this->collUnitActions;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\UnitAction objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\UnitAction objects.
	 * @throws     PropelException
	 */
	public function countUnitActions(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUnitActions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UnitActionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

				if (!isset($this->lastUnitActionCriteria) || !$this->lastUnitActionCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UnitActionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUnitActions);
				}
			} else {
				$count = count($this->collUnitActions);
			}
		}
		$this->lastUnitActionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\UnitAction object to this object
	 * through the net\keeko\cms\core\entities\UnitAction foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\UnitAction $l net\keeko\cms\core\entities\UnitAction
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUnitAction(\net\keeko\cms\core\entities\UnitAction $l)
	{
		if ($this->collUnitActions === null) {
			$this->initUnitActions();
		}
	
		if (!in_array($l, $this->collUnitActions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUnitActions, $l);
			$l->setAction($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Action is new, it will return
	 * an empty collection; or if this Action has previously
	 * been saved, it will retrieve related UnitActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Action.
	 */
	public function getUnitActionsJoinUnit($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\ActionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUnitActions === null) {
			if ($this->isNew()) {
				$this->collUnitActions = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

				$this->collUnitActions = \net\keeko\cms\core\entities\peer\UnitActionPeer::doSelectJoinUnit($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\UnitActionPeer::ACTION_ID, $this->id);

			if (!isset($this->lastUnitActionCriteria) || !$this->lastUnitActionCriteria->equals($criteria)) {
				$this->collUnitActions = \net\keeko\cms\core\entities\peer\UnitActionPeer::doSelectJoinUnit($criteria, $con, $join_behavior);
			}
		}
		$this->lastUnitActionCriteria = $criteria;

		return $this->collUnitActions;
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
			if ($this->collMenuItems) {
				foreach ((array) $this->collMenuItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRoleActions) {
				foreach ((array) $this->collRoleActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUnitActions) {
				foreach ((array) $this->collUnitActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collMenuItems = null;
		$this->collRoleActions = null;
		$this->collUnitActions = null;
			$this->aModule = null;
	}

} // net\keeko\cms\core\entities\base\BaseAction
