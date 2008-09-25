<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::SettingPeer;
use net::keeko::cms::core::entities::SettingCatPeer;
use net::keeko::cms::core::entities::ModulePeer;
use net::keeko::cms::core::entities::SettingSectionPeer;



/**
 * Base class that represents a row from the 'setting' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseSetting extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SettingPeer
	 */
	protected static $peer;

	/**
	 * The value for the keyname field.
	 * @var        string
	 */
	protected $keyname;

	/**
	 * The value for the cat_id field.
	 * @var        int
	 */
	protected $cat_id;

	/**
	 * The value for the section_id field.
	 * @var        int
	 */
	protected $section_id;

	/**
	 * The value for the module_id field.
	 * @var        int
	 */
	protected $module_id;

	/**
	 * The value for the value field.
	 * @var        string
	 */
	protected $value;

	/**
	 * The value for the format field.
	 * @var        int
	 */
	protected $format;

	/**
	 * The value for the hide field.
	 * @var        boolean
	 */
	protected $hide;

	/**
	 * @var        SettingCat
	 */
	protected $aSettingCat;

	/**
	 * @var        Module
	 */
	protected $aModule;

	/**
	 * @var        SettingSection
	 */
	protected $aSettingSection;

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
	 * Initializes internal state of BaseSetting object.
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
	}

	/**
	 * Get the [keyname] column value.
	 * 
	 * @return     string
	 */
	public function getKeyname()
	{
		return $this->keyname;
	}

	/**
	 * Get the [cat_id] column value.
	 * 
	 * @return     int
	 */
	public function getCatId()
	{
		return $this->cat_id;
	}

	/**
	 * Get the [section_id] column value.
	 * 
	 * @return     int
	 */
	public function getSectionId()
	{
		return $this->section_id;
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
	 * Get the [value] column value.
	 * 
	 * @return     string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Get the [format] column value.
	 * 
	 * @return     int
	 */
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * Get the [hide] column value.
	 * 
	 * @return     boolean
	 */
	public function getHide()
	{
		return $this->hide;
	}

	/**
	 * Set the value of [keyname] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setKeyname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->keyname !== $v) {
			$this->keyname = $v;
			$this->modifiedColumns[] = SettingPeer::KEYNAME;
		}

		return $this;
	} // setKeyname()

	/**
	 * Set the value of [cat_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setCatId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cat_id !== $v) {
			$this->cat_id = $v;
			$this->modifiedColumns[] = SettingPeer::CAT_ID;
		}

		if ($this->aSettingCat !== null && $this->aSettingCat->getId() !== $v) {
			$this->aSettingCat = null;
		}

		return $this;
	} // setCatId()

	/**
	 * Set the value of [section_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setSectionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->section_id !== $v) {
			$this->section_id = $v;
			$this->modifiedColumns[] = SettingPeer::SECTION_ID;
		}

		if ($this->aSettingSection !== null && $this->aSettingSection->getId() !== $v) {
			$this->aSettingSection = null;
		}

		return $this;
	} // setSectionId()

	/**
	 * Set the value of [module_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setModuleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->module_id !== $v) {
			$this->module_id = $v;
			$this->modifiedColumns[] = SettingPeer::MODULE_ID;
		}

		if ($this->aModule !== null && $this->aModule->getId() !== $v) {
			$this->aModule = null;
		}

		return $this;
	} // setModuleId()

	/**
	 * Set the value of [value] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setValue($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = SettingPeer::VALUE;
		}

		return $this;
	} // setValue()

	/**
	 * Set the value of [format] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setFormat($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->format !== $v) {
			$this->format = $v;
			$this->modifiedColumns[] = SettingPeer::FORMAT;
		}

		return $this;
	} // setFormat()

	/**
	 * Set the value of [hide] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setHide($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->hide !== $v) {
			$this->hide = $v;
			$this->modifiedColumns[] = SettingPeer::HIDE;
		}

		return $this;
	} // setHide()

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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     ::PropelException  - Any caught Exception will be rewrapped as a ::PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->keyname = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->cat_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->section_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->module_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->value = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->format = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->hide = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = SettingPeer::NUM_COLUMNS - SettingPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating Setting object", $e);
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

		if ($this->aSettingCat !== null && $this->cat_id !== $this->aSettingCat->getId()) {
			$this->aSettingCat = null;
		}
	
		if ($this->aSettingSection !== null && $this->section_id !== $this->aSettingSection->getId()) {
			$this->aSettingSection = null;
		}
	
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
			$con = ::Propel::getConnection(SettingPeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SettingPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSettingCat = null;
			$this->aModule = null;
			$this->aSettingSection = null;
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
			$con = ::Propel::getConnection(SettingPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			SettingPeer::doDelete($this, $con);
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
			$con = ::Propel::getConnection(SettingPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			SettingPeer::addInstanceToPool($this);
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

			if ($this->aSettingCat !== null) {
				if ($this->aSettingCat->isModified() || $this->aSettingCat->isNew()) {
					$affectedRows += $this->aSettingCat->save($con);
				}
				$this->setSettingCat($this->aSettingCat);
			}

			if ($this->aModule !== null) {
				if ($this->aModule->isModified() || $this->aModule->isNew()) {
					$affectedRows += $this->aModule->save($con);
				}
				$this->setModule($this->aModule);
			}

			if ($this->aSettingSection !== null) {
				if ($this->aSettingSection->isModified() || $this->aSettingSection->isNew()) {
					$affectedRows += $this->aSettingSection->save($con);
				}
				$this->setSettingSection($this->aSettingSection);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SettingPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SettingPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aSettingCat !== null) {
				if (!$this->aSettingCat->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSettingCat->getValidationFailures());
				}
			}

			if ($this->aModule !== null) {
				if (!$this->aModule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModule->getValidationFailures());
				}
			}

			if ($this->aSettingSection !== null) {
				if (!$this->aSettingSection->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSettingSection->getValidationFailures());
				}
			}


			if (($retval = SettingPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = SettingPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				return $this->getKeyname();
				break;
			case 1:
				return $this->getCatId();
				break;
			case 2:
				return $this->getSectionId();
				break;
			case 3:
				return $this->getModuleId();
				break;
			case 4:
				return $this->getValue();
				break;
			case 5:
				return $this->getFormat();
				break;
			case 6:
				return $this->getHide();
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
		$keys = SettingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKeyname(),
			$keys[1] => $this->getCatId(),
			$keys[2] => $this->getSectionId(),
			$keys[3] => $this->getModuleId(),
			$keys[4] => $this->getValue(),
			$keys[5] => $this->getFormat(),
			$keys[6] => $this->getHide(),
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
		$pos = SettingPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setKeyname($value);
				break;
			case 1:
				$this->setCatId($value);
				break;
			case 2:
				$this->setSectionId($value);
				break;
			case 3:
				$this->setModuleId($value);
				break;
			case 4:
				$this->setValue($value);
				break;
			case 5:
				$this->setFormat($value);
				break;
			case 6:
				$this->setHide($value);
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
		$keys = SettingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKeyname($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCatId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSectionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setModuleId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setValue($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFormat($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHide($arr[$keys[6]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(SettingPeer::DATABASE_NAME);

		if ($this->isColumnModified(SettingPeer::KEYNAME)) $criteria->add(SettingPeer::KEYNAME, $this->keyname);
		if ($this->isColumnModified(SettingPeer::CAT_ID)) $criteria->add(SettingPeer::CAT_ID, $this->cat_id);
		if ($this->isColumnModified(SettingPeer::SECTION_ID)) $criteria->add(SettingPeer::SECTION_ID, $this->section_id);
		if ($this->isColumnModified(SettingPeer::MODULE_ID)) $criteria->add(SettingPeer::MODULE_ID, $this->module_id);
		if ($this->isColumnModified(SettingPeer::VALUE)) $criteria->add(SettingPeer::VALUE, $this->value);
		if ($this->isColumnModified(SettingPeer::FORMAT)) $criteria->add(SettingPeer::FORMAT, $this->format);
		if ($this->isColumnModified(SettingPeer::HIDE)) $criteria->add(SettingPeer::HIDE, $this->hide);

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
		$criteria = new ::Criteria(SettingPeer::DATABASE_NAME);

		$criteria->add(SettingPeer::KEYNAME, $this->keyname);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getKeyname();
	}

	/**
	 * Generic method to set the primary key (keyname column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setKeyname($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Setting (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCatId($this->cat_id);

		$copyObj->setSectionId($this->section_id);

		$copyObj->setModuleId($this->module_id);

		$copyObj->setValue($this->value);

		$copyObj->setFormat($this->format);

		$copyObj->setHide($this->hide);


		$copyObj->setNew(true);

		$copyObj->setKeyname(NULL); // this is a pkey column, so set to default value

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
	 * @return     Setting Clone of current object.
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
	 * @return     SettingPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SettingPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SettingCat object.
	 *
	 * @param      SettingCat $v
	 * @return     Setting The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setSettingCat(SettingCat $v = null)
	{
		if ($v === null) {
			$this->setCatId(NULL);
		} else {
			$this->setCatId($v->getId());
		}

		$this->aSettingCat = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SettingCat object, it will not be re-added.
		if ($v !== null) {
			$v->addSetting($this);
		}

		return $this;
	}


	/**
	 * Get the associated SettingCat object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     SettingCat The associated SettingCat object.
	 * @throws     ::PropelException
	 */
	public function getSettingCat(::PropelPDO $con = null)
	{
		if ($this->aSettingCat === null && ($this->cat_id !== null)) {
			$this->aSettingCat = SettingCatPeer::retrieveByPK($this->cat_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSettingCat->addSettings($this);
			 */
		}
		return $this->aSettingCat;
	}

	/**
	 * Declares an association between this object and a Module object.
	 *
	 * @param      Module $v
	 * @return     Setting The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setModule(Module $v = null)
	{
		if ($v === null) {
			$this->setModuleId(NULL);
		} else {
			$this->setModuleId($v->getId());
		}

		$this->aModule = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Module object, it will not be re-added.
		if ($v !== null) {
			$v->addSetting($this);
		}

		return $this;
	}


	/**
	 * Get the associated Module object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     Module The associated Module object.
	 * @throws     ::PropelException
	 */
	public function getModule(::PropelPDO $con = null)
	{
		if ($this->aModule === null && ($this->module_id !== null)) {
			$this->aModule = ModulePeer::retrieveByPK($this->module_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aModule->addSettings($this);
			 */
		}
		return $this->aModule;
	}

	/**
	 * Declares an association between this object and a SettingSection object.
	 *
	 * @param      SettingSection $v
	 * @return     Setting The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setSettingSection(SettingSection $v = null)
	{
		if ($v === null) {
			$this->setSectionId(NULL);
		} else {
			$this->setSectionId($v->getId());
		}

		$this->aSettingSection = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SettingSection object, it will not be re-added.
		if ($v !== null) {
			$v->addSetting($this);
		}

		return $this;
	}


	/**
	 * Get the associated SettingSection object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     SettingSection The associated SettingSection object.
	 * @throws     ::PropelException
	 */
	public function getSettingSection(::PropelPDO $con = null)
	{
		if ($this->aSettingSection === null && ($this->section_id !== null)) {
			$this->aSettingSection = SettingSectionPeer::retrieveByPK($this->section_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSettingSection->addSettings($this);
			 */
		}
		return $this->aSettingSection;
	}

} // BaseSetting
