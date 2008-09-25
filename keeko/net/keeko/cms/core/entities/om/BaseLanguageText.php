<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::LanguageTextPeer;
use net::keeko::cms::core::entities::LanguagePeer;
use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::SettingCatPeer;
use net::keeko::cms::core::entities::MenuItemPeer;
use net::keeko::cms::core::entities::UserExtPeer;
use net::keeko::cms::core::entities::UserExtCatPeer;
use net::keeko::cms::core::entities::SettingSectionPeer;



/**
 * Base class that represents a row from the 'language_text' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLanguageText extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LanguageTextPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the language_id field.
	 * @var        int
	 */
	protected $language_id;

	/**
	 * The value for the content field.
	 * @var        string
	 */
	protected $content;

	/**
	 * @var        Language
	 */
	protected $aLanguage;

	/**
	 * @var        array Page[] Collection to store aggregation of Page objects.
	 */
	protected $collPagesRelatedByTitleId;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagesRelatedByTitleId.
	 */
	private $lastPageRelatedByTitleIdCriteria = null;

	/**
	 * @var        array Page[] Collection to store aggregation of Page objects.
	 */
	protected $collPagesRelatedByDescriptionId;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagesRelatedByDescriptionId.
	 */
	private $lastPageRelatedByDescriptionIdCriteria = null;

	/**
	 * @var        array Page[] Collection to store aggregation of Page objects.
	 */
	protected $collPagesRelatedByKeywordsId;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagesRelatedByKeywordsId.
	 */
	private $lastPageRelatedByKeywordsIdCriteria = null;

	/**
	 * @var        array SettingCat[] Collection to store aggregation of SettingCat objects.
	 */
	protected $collSettingCats;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collSettingCats.
	 */
	private $lastSettingCatCriteria = null;

	/**
	 * @var        array MenuItem[] Collection to store aggregation of MenuItem objects.
	 */
	protected $collMenuItems;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collMenuItems.
	 */
	private $lastMenuItemCriteria = null;

	/**
	 * @var        array UserExt[] Collection to store aggregation of UserExt objects.
	 */
	protected $collUserExts;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collUserExts.
	 */
	private $lastUserExtCriteria = null;

	/**
	 * @var        array UserExtCat[] Collection to store aggregation of UserExtCat objects.
	 */
	protected $collUserExtCats;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collUserExtCats.
	 */
	private $lastUserExtCatCriteria = null;

	/**
	 * @var        array SettingSection[] Collection to store aggregation of SettingSection objects.
	 */
	protected $collSettingSections;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collSettingSections.
	 */
	private $lastSettingSectionCriteria = null;

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
	 * Initializes internal state of BaseLanguageText object.
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
	 * Get the [language_id] column value.
	 * 
	 * @return     int
	 */
	public function getLanguageId()
	{
		return $this->language_id;
	}

	/**
	 * Get the [content] column value.
	 * 
	 * @return     string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     LanguageText The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LanguageTextPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [language_id] column.
	 * 
	 * @param      int $v new value
	 * @return     LanguageText The current object (for fluent API support)
	 */
	public function setLanguageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->language_id !== $v) {
			$this->language_id = $v;
			$this->modifiedColumns[] = LanguageTextPeer::LANGUAGE_ID;
		}

		if ($this->aLanguage !== null && $this->aLanguage->getId() !== $v) {
			$this->aLanguage = null;
		}

		return $this;
	} // setLanguageId()

	/**
	 * Set the value of [content] column.
	 * 
	 * @param      string $v new value
	 * @return     LanguageText The current object (for fluent API support)
	 */
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = LanguageTextPeer::CONTENT;
		}

		return $this;
	} // setContent()

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
			$this->language_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->content = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = LanguageTextPeer::NUM_COLUMNS - LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating LanguageText object", $e);
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

		if ($this->aLanguage !== null && $this->language_id !== $this->aLanguage->getId()) {
			$this->aLanguage = null;
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
			$con = ::Propel::getConnection(LanguageTextPeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = LanguageTextPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aLanguage = null;
			$this->collPagesRelatedByTitleId = null;
			$this->lastPageRelatedByTitleIdCriteria = null;

			$this->collPagesRelatedByDescriptionId = null;
			$this->lastPageRelatedByDescriptionIdCriteria = null;

			$this->collPagesRelatedByKeywordsId = null;
			$this->lastPageRelatedByKeywordsIdCriteria = null;

			$this->collSettingCats = null;
			$this->lastSettingCatCriteria = null;

			$this->collMenuItems = null;
			$this->lastMenuItemCriteria = null;

			$this->collUserExts = null;
			$this->lastUserExtCriteria = null;

			$this->collUserExtCats = null;
			$this->lastUserExtCatCriteria = null;

			$this->collSettingSections = null;
			$this->lastSettingSectionCriteria = null;

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
			$con = ::Propel::getConnection(LanguageTextPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			LanguageTextPeer::doDelete($this, $con);
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
			$con = ::Propel::getConnection(LanguageTextPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			LanguageTextPeer::addInstanceToPool($this);
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

			if ($this->aLanguage !== null) {
				if ($this->aLanguage->isModified() || $this->aLanguage->isNew()) {
					$affectedRows += $this->aLanguage->save($con);
				}
				$this->setLanguage($this->aLanguage);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LanguageTextPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += LanguageTextPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPagesRelatedByTitleId !== null) {
				foreach ($this->collPagesRelatedByTitleId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPagesRelatedByDescriptionId !== null) {
				foreach ($this->collPagesRelatedByDescriptionId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPagesRelatedByKeywordsId !== null) {
				foreach ($this->collPagesRelatedByKeywordsId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSettingCats !== null) {
				foreach ($this->collSettingCats as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMenuItems !== null) {
				foreach ($this->collMenuItems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserExts !== null) {
				foreach ($this->collUserExts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserExtCats !== null) {
				foreach ($this->collUserExtCats as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSettingSections !== null) {
				foreach ($this->collSettingSections as $referrerFK) {
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

			if ($this->aLanguage !== null) {
				if (!$this->aLanguage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguage->getValidationFailures());
				}
			}


			if (($retval = LanguageTextPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPagesRelatedByTitleId !== null) {
					foreach ($this->collPagesRelatedByTitleId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPagesRelatedByDescriptionId !== null) {
					foreach ($this->collPagesRelatedByDescriptionId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPagesRelatedByKeywordsId !== null) {
					foreach ($this->collPagesRelatedByKeywordsId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSettingCats !== null) {
					foreach ($this->collSettingCats as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMenuItems !== null) {
					foreach ($this->collMenuItems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserExts !== null) {
					foreach ($this->collUserExts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserExtCats !== null) {
					foreach ($this->collUserExtCats as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSettingSections !== null) {
					foreach ($this->collSettingSections as $referrerFK) {
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
		$pos = LanguageTextPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				return $this->getLanguageId();
				break;
			case 2:
				return $this->getContent();
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
		$keys = LanguageTextPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getLanguageId(),
			$keys[2] => $this->getContent(),
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
		$pos = LanguageTextPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setLanguageId($value);
				break;
			case 2:
				$this->setContent($value);
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
		$keys = LanguageTextPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLanguageId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(LanguageTextPeer::DATABASE_NAME);

		if ($this->isColumnModified(LanguageTextPeer::ID)) $criteria->add(LanguageTextPeer::ID, $this->id);
		if ($this->isColumnModified(LanguageTextPeer::LANGUAGE_ID)) $criteria->add(LanguageTextPeer::LANGUAGE_ID, $this->language_id);
		if ($this->isColumnModified(LanguageTextPeer::CONTENT)) $criteria->add(LanguageTextPeer::CONTENT, $this->content);

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
		$criteria = new ::Criteria(LanguageTextPeer::DATABASE_NAME);

		$criteria->add(LanguageTextPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of LanguageText (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setLanguageId($this->language_id);

		$copyObj->setContent($this->content);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPagesRelatedByTitleId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageRelatedByTitleId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPagesRelatedByDescriptionId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageRelatedByDescriptionId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPagesRelatedByKeywordsId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageRelatedByKeywordsId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSettingCats() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSettingCat($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMenuItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMenuItem($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserExts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserExt($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserExtCats() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserExtCat($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSettingSections() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSettingSection($relObj->copy($deepCopy));
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
	 * @return     LanguageText Clone of current object.
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
	 * @return     LanguageTextPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LanguageTextPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Language object.
	 *
	 * @param      Language $v
	 * @return     LanguageText The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setLanguage(Language $v = null)
	{
		if ($v === null) {
			$this->setLanguageId(NULL);
		} else {
			$this->setLanguageId($v->getId());
		}

		$this->aLanguage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Language object, it will not be re-added.
		if ($v !== null) {
			$v->addLanguageText($this);
		}

		return $this;
	}


	/**
	 * Get the associated Language object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     Language The associated Language object.
	 * @throws     ::PropelException
	 */
	public function getLanguage(::PropelPDO $con = null)
	{
		if ($this->aLanguage === null && ($this->language_id !== null)) {
			$this->aLanguage = LanguagePeer::retrieveByPK($this->language_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguage->addLanguageTexts($this);
			 */
		}
		return $this->aLanguage;
	}

	/**
	 * Temporary storage of collPagesRelatedByTitleId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPagesRelatedByTitleId() method.
	 * @see        addPagesRelatedByTitleId()
	 */
	public function initPagesRelatedByTitleId()
	{
		if ($this->collPagesRelatedByTitleId === null) {
			$this->collPagesRelatedByTitleId = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByTitleId from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPagesRelatedByTitleId($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByTitleId = array();
			} else {

				$criteria->add(PagePeer::TITLE_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByTitleId = PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePeer::TITLE_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByTitleId = PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;
		return $this->collPagesRelatedByTitleId;
	}

	/**
	 * Returns the number of related PagesRelatedByTitleId.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPagesRelatedByTitleId(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PagePeer::TITLE_ID, $this->getId());

				$count = PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePeer::TITLE_ID, $this->getId());

				if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
					$count = PagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPagesRelatedByTitleId);
				}
			} else {
				$count = count($this->collPagesRelatedByTitleId);
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Page object to this object
	 * through the Page foreign key attribute.
	 *
	 * @param      Page $l Page
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPageRelatedByTitleId(Page $l)
	{
		if ($this->collPagesRelatedByTitleId === null) {
			$this->collPagesRelatedByTitleId = array();
		}
		if (!in_array($l, $this->collPagesRelatedByTitleId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPagesRelatedByTitleId, $l);
			$l->setLanguageTextRelatedByTitleId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related PagesRelatedByTitleId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getPagesRelatedByTitleIdJoinPageRelatedByParentId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByTitleId = array();
			} else {

				$criteria->add(PagePeer::TITLE_ID, $this->getId());

				$this->collPagesRelatedByTitleId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::TITLE_ID, $this->getId());

			if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByTitleId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;

		return $this->collPagesRelatedByTitleId;
	}

	/**
	 * Temporary storage of collPagesRelatedByDescriptionId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPagesRelatedByDescriptionId() method.
	 * @see        addPagesRelatedByDescriptionId()
	 */
	public function initPagesRelatedByDescriptionId()
	{
		if ($this->collPagesRelatedByDescriptionId === null) {
			$this->collPagesRelatedByDescriptionId = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByDescriptionId from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPagesRelatedByDescriptionId($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByDescriptionId = array();
			} else {

				$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByDescriptionId = PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByDescriptionId = PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;
		return $this->collPagesRelatedByDescriptionId;
	}

	/**
	 * Returns the number of related PagesRelatedByDescriptionId.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPagesRelatedByDescriptionId(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

				$count = PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

				if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
					$count = PagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPagesRelatedByDescriptionId);
				}
			} else {
				$count = count($this->collPagesRelatedByDescriptionId);
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Page object to this object
	 * through the Page foreign key attribute.
	 *
	 * @param      Page $l Page
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPageRelatedByDescriptionId(Page $l)
	{
		if ($this->collPagesRelatedByDescriptionId === null) {
			$this->collPagesRelatedByDescriptionId = array();
		}
		if (!in_array($l, $this->collPagesRelatedByDescriptionId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPagesRelatedByDescriptionId, $l);
			$l->setLanguageTextRelatedByDescriptionId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related PagesRelatedByDescriptionId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getPagesRelatedByDescriptionIdJoinPageRelatedByParentId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByDescriptionId = array();
			} else {

				$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

				$this->collPagesRelatedByDescriptionId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::DESCRIPTION_ID, $this->getId());

			if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByDescriptionId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;

		return $this->collPagesRelatedByDescriptionId;
	}

	/**
	 * Temporary storage of collPagesRelatedByKeywordsId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPagesRelatedByKeywordsId() method.
	 * @see        addPagesRelatedByKeywordsId()
	 */
	public function initPagesRelatedByKeywordsId()
	{
		if ($this->collPagesRelatedByKeywordsId === null) {
			$this->collPagesRelatedByKeywordsId = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByKeywordsId from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPagesRelatedByKeywordsId($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByKeywordsId = array();
			} else {

				$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByKeywordsId = PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByKeywordsId = PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;
		return $this->collPagesRelatedByKeywordsId;
	}

	/**
	 * Returns the number of related PagesRelatedByKeywordsId.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPagesRelatedByKeywordsId(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

				$count = PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

				if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
					$count = PagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPagesRelatedByKeywordsId);
				}
			} else {
				$count = count($this->collPagesRelatedByKeywordsId);
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Page object to this object
	 * through the Page foreign key attribute.
	 *
	 * @param      Page $l Page
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPageRelatedByKeywordsId(Page $l)
	{
		if ($this->collPagesRelatedByKeywordsId === null) {
			$this->collPagesRelatedByKeywordsId = array();
		}
		if (!in_array($l, $this->collPagesRelatedByKeywordsId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPagesRelatedByKeywordsId, $l);
			$l->setLanguageTextRelatedByKeywordsId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related PagesRelatedByKeywordsId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getPagesRelatedByKeywordsIdJoinPageRelatedByParentId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByKeywordsId = array();
			} else {

				$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

				$this->collPagesRelatedByKeywordsId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::KEYWORDS_ID, $this->getId());

			if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByKeywordsId = PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con);
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;

		return $this->collPagesRelatedByKeywordsId;
	}

	/**
	 * Temporary storage of collSettingCats to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addSettingCats() method.
	 * @see        addSettingCats()
	 */
	public function initSettingCats()
	{
		if ($this->collSettingCats === null) {
			$this->collSettingCats = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related SettingCats from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getSettingCats($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettingCats === null) {
			if ($this->isNew()) {
			   $this->collSettingCats = array();
			} else {

				$criteria->add(SettingCatPeer::NAME_ID, $this->getId());

				SettingCatPeer::addSelectColumns($criteria);
				$this->collSettingCats = SettingCatPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SettingCatPeer::NAME_ID, $this->getId());

				SettingCatPeer::addSelectColumns($criteria);
				if (!isset($this->lastSettingCatCriteria) || !$this->lastSettingCatCriteria->equals($criteria)) {
					$this->collSettingCats = SettingCatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSettingCatCriteria = $criteria;
		return $this->collSettingCats;
	}

	/**
	 * Returns the number of related SettingCats.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countSettingCats(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collSettingCats === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SettingCatPeer::NAME_ID, $this->getId());

				$count = SettingCatPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SettingCatPeer::NAME_ID, $this->getId());

				if (!isset($this->lastSettingCatCriteria) || !$this->lastSettingCatCriteria->equals($criteria)) {
					$count = SettingCatPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSettingCats);
				}
			} else {
				$count = count($this->collSettingCats);
			}
		}
		$this->lastSettingCatCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a SettingCat object to this object
	 * through the SettingCat foreign key attribute.
	 *
	 * @param      SettingCat $l SettingCat
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addSettingCat(SettingCat $l)
	{
		if ($this->collSettingCats === null) {
			$this->collSettingCats = array();
		}
		if (!in_array($l, $this->collSettingCats, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSettingCats, $l);
			$l->setLanguageText($this);
		}
	}

	/**
	 * Temporary storage of collMenuItems to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addMenuItems() method.
	 * @see        addMenuItems()
	 */
	public function initMenuItems()
	{
		if ($this->collMenuItems === null) {
			$this->collMenuItems = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related MenuItems from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getMenuItems($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
			   $this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				MenuItemPeer::addSelectColumns($criteria);
				$this->collMenuItems = MenuItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				MenuItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
					$this->collMenuItems = MenuItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMenuItemCriteria = $criteria;
		return $this->collMenuItems;
	}

	/**
	 * Returns the number of related MenuItems.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countMenuItems(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$count = MenuItemPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
					$count = MenuItemPeer::doCount($criteria, $con);
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
	 * Method called to associate a MenuItem object to this object
	 * through the MenuItem foreign key attribute.
	 *
	 * @param      MenuItem $l MenuItem
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addMenuItem(MenuItem $l)
	{
		if ($this->collMenuItems === null) {
			$this->collMenuItems = array();
		}
		if (!in_array($l, $this->collMenuItems, true)) { // only add it if the **same** object is not already associated
			array_push($this->collMenuItems, $l);
			$l->setLanguageText($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinPage($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinPage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinPage($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinMenu($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinMenu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinMenu($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinMenuItemRelatedByParentId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinModule($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinModule($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinModule($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinAction($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinAction($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::TEXT_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinAction($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}

	/**
	 * Temporary storage of collUserExts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addUserExts() method.
	 * @see        addUserExts()
	 */
	public function initUserExts()
	{
		if ($this->collUserExts === null) {
			$this->collUserExts = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related UserExts from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getUserExts($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExts === null) {
			if ($this->isNew()) {
			   $this->collUserExts = array();
			} else {

				$criteria->add(UserExtPeer::NAME_ID, $this->getId());

				UserExtPeer::addSelectColumns($criteria);
				$this->collUserExts = UserExtPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserExtPeer::NAME_ID, $this->getId());

				UserExtPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
					$this->collUserExts = UserExtPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserExtCriteria = $criteria;
		return $this->collUserExts;
	}

	/**
	 * Returns the number of related UserExts.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countUserExts(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collUserExts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserExtPeer::NAME_ID, $this->getId());

				$count = UserExtPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserExtPeer::NAME_ID, $this->getId());

				if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
					$count = UserExtPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserExts);
				}
			} else {
				$count = count($this->collUserExts);
			}
		}
		$this->lastUserExtCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a UserExt object to this object
	 * through the UserExt foreign key attribute.
	 *
	 * @param      UserExt $l UserExt
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addUserExt(UserExt $l)
	{
		if ($this->collUserExts === null) {
			$this->collUserExts = array();
		}
		if (!in_array($l, $this->collUserExts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserExts, $l);
			$l->setLanguageText($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related UserExts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getUserExtsJoinUserExtCat($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExts === null) {
			if ($this->isNew()) {
				$this->collUserExts = array();
			} else {

				$criteria->add(UserExtPeer::NAME_ID, $this->getId());

				$this->collUserExts = UserExtPeer::doSelectJoinUserExtCat($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UserExtPeer::NAME_ID, $this->getId());

			if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
				$this->collUserExts = UserExtPeer::doSelectJoinUserExtCat($criteria, $con);
			}
		}
		$this->lastUserExtCriteria = $criteria;

		return $this->collUserExts;
	}

	/**
	 * Temporary storage of collUserExtCats to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addUserExtCats() method.
	 * @see        addUserExtCats()
	 */
	public function initUserExtCats()
	{
		if ($this->collUserExtCats === null) {
			$this->collUserExtCats = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related UserExtCats from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getUserExtCats($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtCats === null) {
			if ($this->isNew()) {
			   $this->collUserExtCats = array();
			} else {

				$criteria->add(UserExtCatPeer::TITLE_ID, $this->getId());

				UserExtCatPeer::addSelectColumns($criteria);
				$this->collUserExtCats = UserExtCatPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UserExtCatPeer::TITLE_ID, $this->getId());

				UserExtCatPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserExtCatCriteria) || !$this->lastUserExtCatCriteria->equals($criteria)) {
					$this->collUserExtCats = UserExtCatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserExtCatCriteria = $criteria;
		return $this->collUserExtCats;
	}

	/**
	 * Returns the number of related UserExtCats.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countUserExtCats(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collUserExtCats === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UserExtCatPeer::TITLE_ID, $this->getId());

				$count = UserExtCatPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UserExtCatPeer::TITLE_ID, $this->getId());

				if (!isset($this->lastUserExtCatCriteria) || !$this->lastUserExtCatCriteria->equals($criteria)) {
					$count = UserExtCatPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUserExtCats);
				}
			} else {
				$count = count($this->collUserExtCats);
			}
		}
		$this->lastUserExtCatCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a UserExtCat object to this object
	 * through the UserExtCat foreign key attribute.
	 *
	 * @param      UserExtCat $l UserExtCat
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addUserExtCat(UserExtCat $l)
	{
		if ($this->collUserExtCats === null) {
			$this->collUserExtCats = array();
		}
		if (!in_array($l, $this->collUserExtCats, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserExtCats, $l);
			$l->setLanguageText($this);
		}
	}

	/**
	 * Temporary storage of collSettingSections to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addSettingSections() method.
	 * @see        addSettingSections()
	 */
	public function initSettingSections()
	{
		if ($this->collSettingSections === null) {
			$this->collSettingSections = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this LanguageText has previously been saved, it will retrieve
	 * related SettingSections from storage. If this LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getSettingSections($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettingSections === null) {
			if ($this->isNew()) {
			   $this->collSettingSections = array();
			} else {

				$criteria->add(SettingSectionPeer::NAME_ID, $this->getId());

				SettingSectionPeer::addSelectColumns($criteria);
				$this->collSettingSections = SettingSectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SettingSectionPeer::NAME_ID, $this->getId());

				SettingSectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSettingSectionCriteria) || !$this->lastSettingSectionCriteria->equals($criteria)) {
					$this->collSettingSections = SettingSectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSettingSectionCriteria = $criteria;
		return $this->collSettingSections;
	}

	/**
	 * Returns the number of related SettingSections.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countSettingSections(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collSettingSections === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SettingSectionPeer::NAME_ID, $this->getId());

				$count = SettingSectionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SettingSectionPeer::NAME_ID, $this->getId());

				if (!isset($this->lastSettingSectionCriteria) || !$this->lastSettingSectionCriteria->equals($criteria)) {
					$count = SettingSectionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSettingSections);
				}
			} else {
				$count = count($this->collSettingSections);
			}
		}
		$this->lastSettingSectionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a SettingSection object to this object
	 * through the SettingSection foreign key attribute.
	 *
	 * @param      SettingSection $l SettingSection
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addSettingSection(SettingSection $l)
	{
		if ($this->collSettingSections === null) {
			$this->collSettingSections = array();
		}
		if (!in_array($l, $this->collSettingSections, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSettingSections, $l);
			$l->setLanguageText($this);
		}
	}

} // BaseLanguageText
