<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'user_ext' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseUserExt extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\UserExtPeer
	 */
	protected static $peer;

	/**
	 * The value for the keyname field.
	 * @var        string
	 */
	protected $keyname;

	/**
	 * The value for the name_id field.
	 * @var        int
	 */
	protected $name_id;

	/**
	 * The value for the cat_id field.
	 * @var        int
	 */
	protected $cat_id;

	/**
	 * The value for the hide field.
	 * @var        boolean
	 */
	protected $hide;

	/**
	 * The value for the format field.
	 * @var        int
	 */
	protected $format;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageText;

	/**
	 * @var        UserExtCat
	 */
	protected $aUserExtCat;

	/**
	 * @var        array net\keeko\cms\core\entities\UserExtVal[] Collection to store aggregation of net\keeko\cms\core\entities\UserExtVal objects.
	 */
	protected $collUserExtVals;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserExtVals.
	 */
	private $lastUserExtValCriteria = null;

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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseUserExt object.
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
	 * Get the [keyname] column value.
	 * 
	 * @return     string
	 */
	public function getKeyname()
	{
		return $this->keyname;
	}

	/**
	 * Get the [name_id] column value.
	 * 
	 * @return     int
	 */
	public function getNameId()
	{
		return $this->name_id;
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
	 * Get the [hide] column value.
	 * 
	 * @return     boolean
	 */
	public function getHide()
	{
		return $this->hide;
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
	 * Set the value of [keyname] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 */
	public function setKeyname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->keyname !== $v) {
			$this->keyname = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserExtPeer::KEYNAME;
		}

		return $this;
	} // setKeyname()

	/**
	 * Set the value of [name_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 */
	public function setNameId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->name_id !== $v) {
			$this->name_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID;
		}

		if ($this->aLanguageText !== null && $this->aLanguageText->getId() !== $v) {
			$this->aLanguageText = null;
		}

		return $this;
	} // setNameId()

	/**
	 * Set the value of [cat_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 */
	public function setCatId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cat_id !== $v) {
			$this->cat_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserExtPeer::CAT_ID;
		}

		if ($this->aUserExtCat !== null && $this->aUserExtCat->getId() !== $v) {
			$this->aUserExtCat = null;
		}

		return $this;
	} // setCatId()

	/**
	 * Set the value of [hide] column.
	 * 
	 * @param      boolean $v new value
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 */
	public function setHide($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->hide !== $v) {
			$this->hide = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserExtPeer::HIDE;
		}

		return $this;
	} // setHide()

	/**
	 * Set the value of [format] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 */
	public function setFormat($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->format !== $v) {
			$this->format = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\UserExtPeer::FORMAT;
		}

		return $this;
	} // setFormat()

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

			$this->keyname = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->name_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->cat_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->hide = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->format = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = \net\keeko\cms\core\entities\peer\UserExtPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\UserExtPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating UserExt object", $e);
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

		if ($this->aLanguageText !== null && $this->name_id !== $this->aLanguageText->getId()) {
			$this->aLanguageText = null;
		}
		if ($this->aUserExtCat !== null && $this->cat_id !== $this->aUserExtCat->getId()) {
			$this->aUserExtCat = null;
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\UserExtPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aLanguageText = null;
			$this->aUserExtCat = null;
			$this->collUserExtVals = null;
			$this->lastUserExtValCriteria = null;

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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\UserExtPeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\UserExtPeer::addInstanceToPool($this);
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

			if ($this->aLanguageText !== null) {
				if ($this->aLanguageText->isModified() || $this->aLanguageText->isNew()) {
					$affectedRows += $this->aLanguageText->save($con);
				}
				$this->setLanguageText($this->aLanguageText);
			}

			if ($this->aUserExtCat !== null) {
				if ($this->aUserExtCat->isModified() || $this->aUserExtCat->isNew()) {
					$affectedRows += $this->aUserExtCat->save($con);
				}
				$this->setUserExtCat($this->aUserExtCat);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\UserExtPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\UserExtPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collUserExtVals !== null) {
				foreach ($this->collUserExtVals as $referrerFK) {
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

			if ($this->aLanguageText !== null) {
				if (!$this->aLanguageText->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageText->getValidationFailures());
				}
			}

			if ($this->aUserExtCat !== null) {
				if (!$this->aUserExtCat->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserExtCat->getValidationFailures());
				}
			}


			if (($retval = \net\keeko\cms\core\entities\peer\UserExtPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUserExtVals !== null) {
					foreach ($this->collUserExtVals as $referrerFK) {
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
		$pos = \net\keeko\cms\core\entities\peer\UserExtPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				return $this->getKeyname();
				break;
			case 1:
				return $this->getNameId();
				break;
			case 2:
				return $this->getCatId();
				break;
			case 3:
				return $this->getHide();
				break;
			case 4:
				return $this->getFormat();
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
		$keys = \net\keeko\cms\core\entities\peer\UserExtPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKeyname(),
			$keys[1] => $this->getNameId(),
			$keys[2] => $this->getCatId(),
			$keys[3] => $this->getHide(),
			$keys[4] => $this->getFormat(),
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
		$pos = \net\keeko\cms\core\entities\peer\UserExtPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				$this->setNameId($value);
				break;
			case 2:
				$this->setCatId($value);
				break;
			case 3:
				$this->setHide($value);
				break;
			case 4:
				$this->setFormat($value);
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
		$keys = \net\keeko\cms\core\entities\peer\UserExtPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKeyname($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNameId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCatId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHide($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFormat($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserExtPeer::KEYNAME)) $criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::KEYNAME, $this->keyname);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->name_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserExtPeer::CAT_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::CAT_ID, $this->cat_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserExtPeer::HIDE)) $criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::HIDE, $this->hide);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\UserExtPeer::FORMAT)) $criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::FORMAT, $this->format);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::KEYNAME, $this->keyname);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\UserExt (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setKeyname($this->keyname);

		$copyObj->setNameId($this->name_id);

		$copyObj->setCatId($this->cat_id);

		$copyObj->setHide($this->hide);

		$copyObj->setFormat($this->format);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getUserExtVals() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserExtVal($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     net\keeko\cms\core\entities\UserExt Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\UserExtPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\UserExtPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\LanguageText object.
	 *
	 * @param      net\keeko\cms\core\entities\LanguageText $v
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setLanguageText(\net\keeko\cms\core\entities\LanguageText $v = null)
	{
		if ($v === null) {
			$this->setNameId(NULL);
		} else {
			$this->setNameId($v->getId());
		}

		$this->aLanguageText = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addUserExt($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\LanguageText object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\LanguageText The associated net\keeko\cms\core\entities\LanguageText object.
	 * @throws     PropelException
	 */
	public function getLanguageText(\PropelPDO $con = null)
	{
		if ($this->aLanguageText === null && ($this->name_id !== null)) {
			$this->aLanguageText = \net\keeko\cms\core\entities\peer\LanguageTextPeer::retrieveByPK($this->name_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageText->addUserExts($this);
			 */
		}
		return $this->aLanguageText;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\UserExtCat object.
	 *
	 * @param      net\keeko\cms\core\entities\UserExtCat $v
	 * @return     net\keeko\cms\core\entities\UserExt The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserExtCat(\net\keeko\cms\core\entities\UserExtCat $v = null)
	{
		if ($v === null) {
			$this->setCatId(NULL);
		} else {
			$this->setCatId($v->getId());
		}

		$this->aUserExtCat = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\UserExtCat object, it will not be re-added.
		if ($v !== null) {
			$v->addUserExt($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\UserExtCat object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\UserExtCat The associated net\keeko\cms\core\entities\UserExtCat object.
	 * @throws     PropelException
	 */
	public function getUserExtCat(\PropelPDO $con = null)
	{
		if ($this->aUserExtCat === null && ($this->cat_id !== null)) {
			$this->aUserExtCat = \net\keeko\cms\core\entities\peer\UserExtCatPeer::retrieveByPK($this->cat_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUserExtCat->addUserExts($this);
			 */
		}
		return $this->aUserExtCat;
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
	 * Otherwise if this net\keeko\cms\core\entities\UserExt has previously been saved, it will retrieve
	 * related UserExtVals from storage. If this net\keeko\cms\core\entities\UserExt is new, it will return
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
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtVals === null) {
			if ($this->isNew()) {
			   $this->collUserExtVals = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

				\net\keeko\cms\core\entities\peer\UserExtValPeer::addSelectColumns($criteria);
				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

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
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

				$count = \net\keeko\cms\core\entities\peer\UserExtValPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

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
	public function addUserExtVal(\net\keeko\cms\core\entities\UserExtVal $l)
	{
		if ($this->collUserExtVals === null) {
			$this->initUserExtVals();
		}
	
		if (!in_array($l, $this->collUserExtVals, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserExtVals, $l);
			$l->setUserExt($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this UserExt is new, it will return
	 * an empty collection; or if this UserExt has previously
	 * been saved, it will retrieve related UserExtVals from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in UserExt.
	 */
	public function getUserExtValsJoinUser($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\UserExtPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtVals === null) {
			if ($this->isNew()) {
				$this->collUserExtVals = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\UserExtValPeer::KEYNAME, $this->keyname);

			if (!isset($this->lastUserExtValCriteria) || !$this->lastUserExtValCriteria->equals($criteria)) {
				$this->collUserExtVals = \net\keeko\cms\core\entities\peer\UserExtValPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserExtValCriteria = $criteria;

		return $this->collUserExtVals;
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
			if ($this->collUserExtVals) {
				foreach ((array) $this->collUserExtVals as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collUserExtVals = null;
			$this->aLanguageText = null;
			$this->aUserExtCat = null;
	}

} // net\keeko\cms\core\entities\base\BaseUserExt
