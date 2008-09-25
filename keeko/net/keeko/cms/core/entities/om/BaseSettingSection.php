<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::SettingSectionPeer;
use net::keeko::cms::core::entities::LanguageTextPeer;
use net::keeko::cms::core::entities::SettingPeer;



/**
 * Base class that represents a row from the 'setting_section' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseSettingSection extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SettingSectionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name_id field.
	 * @var        int
	 */
	protected $name_id;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageText;

	/**
	 * @var        array Setting[] Collection to store aggregation of Setting objects.
	 */
	protected $collSettings;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collSettings.
	 */
	private $lastSettingCriteria = null;

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
	 * Initializes internal state of BaseSettingSection object.
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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SettingSection The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SettingSectionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SettingSection The current object (for fluent API support)
	 */
	public function setNameId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->name_id !== $v) {
			$this->name_id = $v;
			$this->modifiedColumns[] = SettingSectionPeer::NAME_ID;
		}

		if ($this->aLanguageText !== null && $this->aLanguageText->getId() !== $v) {
			$this->aLanguageText = null;
		}

		return $this;
	} // setNameId()

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 2; // 2 = SettingSectionPeer::NUM_COLUMNS - SettingSectionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating SettingSection object", $e);
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

		if ($this->aLanguageText !== null && $this->name_id !== $this->aLanguageText->getId()) {
			$this->aLanguageText = null;
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
			$con = ::Propel::getConnection(SettingSectionPeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SettingSectionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aLanguageText = null;
			$this->collSettings = null;
			$this->lastSettingCriteria = null;

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
			$con = ::Propel::getConnection(SettingSectionPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			SettingSectionPeer::doDelete($this, $con);
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
			$con = ::Propel::getConnection(SettingSectionPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			SettingSectionPeer::addInstanceToPool($this);
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

			if ($this->aLanguageText !== null) {
				if ($this->aLanguageText->isModified() || $this->aLanguageText->isNew()) {
					$affectedRows += $this->aLanguageText->save($con);
				}
				$this->setLanguageText($this->aLanguageText);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SettingSectionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SettingSectionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSettings !== null) {
				foreach ($this->collSettings as $referrerFK) {
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


			if (($retval = SettingSectionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSettings !== null) {
					foreach ($this->collSettings as $referrerFK) {
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
		$pos = SettingSectionPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				return $this->getNameId();
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
		$keys = SettingSectionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNameId(),
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
		$pos = SettingSectionPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setNameId($value);
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
		$keys = SettingSectionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNameId($arr[$keys[1]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(SettingSectionPeer::DATABASE_NAME);

		if ($this->isColumnModified(SettingSectionPeer::ID)) $criteria->add(SettingSectionPeer::ID, $this->id);
		if ($this->isColumnModified(SettingSectionPeer::NAME_ID)) $criteria->add(SettingSectionPeer::NAME_ID, $this->name_id);

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
		$criteria = new ::Criteria(SettingSectionPeer::DATABASE_NAME);

		$criteria->add(SettingSectionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SettingSection (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNameId($this->name_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSettings() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSetting($relObj->copy($deepCopy));
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
	 * @return     SettingSection Clone of current object.
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
	 * @return     SettingSectionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SettingSectionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a LanguageText object.
	 *
	 * @param      LanguageText $v
	 * @return     SettingSection The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setLanguageText(LanguageText $v = null)
	{
		if ($v === null) {
			$this->setNameId(NULL);
		} else {
			$this->setNameId($v->getId());
		}

		$this->aLanguageText = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addSettingSection($this);
		}

		return $this;
	}


	/**
	 * Get the associated LanguageText object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     LanguageText The associated LanguageText object.
	 * @throws     ::PropelException
	 */
	public function getLanguageText(::PropelPDO $con = null)
	{
		if ($this->aLanguageText === null && ($this->name_id !== null)) {
			$this->aLanguageText = LanguageTextPeer::retrieveByPK($this->name_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageText->addSettingSections($this);
			 */
		}
		return $this->aLanguageText;
	}

	/**
	 * Temporary storage of collSettings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addSettings() method.
	 * @see        addSettings()
	 */
	public function initSettings()
	{
		if ($this->collSettings === null) {
			$this->collSettings = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this SettingSection has previously been saved, it will retrieve
	 * related Settings from storage. If this SettingSection is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getSettings($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettings === null) {
			if ($this->isNew()) {
			   $this->collSettings = array();
			} else {

				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				SettingPeer::addSelectColumns($criteria);
				$this->collSettings = SettingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				SettingPeer::addSelectColumns($criteria);
				if (!isset($this->lastSettingCriteria) || !$this->lastSettingCriteria->equals($criteria)) {
					$this->collSettings = SettingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSettingCriteria = $criteria;
		return $this->collSettings;
	}

	/**
	 * Returns the number of related Settings.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countSettings(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collSettings === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				$count = SettingPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				if (!isset($this->lastSettingCriteria) || !$this->lastSettingCriteria->equals($criteria)) {
					$count = SettingPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSettings);
				}
			} else {
				$count = count($this->collSettings);
			}
		}
		$this->lastSettingCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Setting object to this object
	 * through the Setting foreign key attribute.
	 *
	 * @param      Setting $l Setting
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addSetting(Setting $l)
	{
		if ($this->collSettings === null) {
			$this->collSettings = array();
		}
		if (!in_array($l, $this->collSettings, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSettings, $l);
			$l->setSettingSection($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SettingSection is new, it will return
	 * an empty collection; or if this SettingSection has previously
	 * been saved, it will retrieve related Settings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SettingSection.
	 */
	public function getSettingsJoinSettingCat($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettings === null) {
			if ($this->isNew()) {
				$this->collSettings = array();
			} else {

				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				$this->collSettings = SettingPeer::doSelectJoinSettingCat($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SettingPeer::SECTION_ID, $this->getId());

			if (!isset($this->lastSettingCriteria) || !$this->lastSettingCriteria->equals($criteria)) {
				$this->collSettings = SettingPeer::doSelectJoinSettingCat($criteria, $con);
			}
		}
		$this->lastSettingCriteria = $criteria;

		return $this->collSettings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SettingSection is new, it will return
	 * an empty collection; or if this SettingSection has previously
	 * been saved, it will retrieve related Settings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SettingSection.
	 */
	public function getSettingsJoinModule($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettings === null) {
			if ($this->isNew()) {
				$this->collSettings = array();
			} else {

				$criteria->add(SettingPeer::SECTION_ID, $this->getId());

				$this->collSettings = SettingPeer::doSelectJoinModule($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SettingPeer::SECTION_ID, $this->getId());

			if (!isset($this->lastSettingCriteria) || !$this->lastSettingCriteria->equals($criteria)) {
				$this->collSettings = SettingPeer::doSelectJoinModule($criteria, $con);
			}
		}
		$this->lastSettingCriteria = $criteria;

		return $this->collSettings;
	}

} // BaseSettingSection
