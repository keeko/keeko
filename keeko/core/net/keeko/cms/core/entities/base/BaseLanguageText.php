<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'language_text' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLanguageText extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\LanguageTextPeer
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
	 * @var        array net\keeko\cms\core\entities\Page[] Collection to store aggregation of net\keeko\cms\core\entities\Page objects.
	 */
	protected $collPagesRelatedByTitleId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPagesRelatedByTitleId.
	 */
	private $lastPageRelatedByTitleIdCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\Page[] Collection to store aggregation of net\keeko\cms\core\entities\Page objects.
	 */
	protected $collPagesRelatedByDescriptionId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPagesRelatedByDescriptionId.
	 */
	private $lastPageRelatedByDescriptionIdCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\Page[] Collection to store aggregation of net\keeko\cms\core\entities\Page objects.
	 */
	protected $collPagesRelatedByKeywordsId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPagesRelatedByKeywordsId.
	 */
	private $lastPageRelatedByKeywordsIdCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\MenuItem[] Collection to store aggregation of net\keeko\cms\core\entities\MenuItem objects.
	 */
	protected $collMenuItems;

	/**
	 * @var        Criteria The criteria used to select the current contents of collMenuItems.
	 */
	private $lastMenuItemCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\UserExt[] Collection to store aggregation of net\keeko\cms\core\entities\UserExt objects.
	 */
	protected $collUserExts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserExts.
	 */
	private $lastUserExtCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\UserExtCat[] Collection to store aggregation of net\keeko\cms\core\entities\UserExtCat objects.
	 */
	protected $collUserExtCats;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUserExtCats.
	 */
	private $lastUserExtCatCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\SettingSection[] Collection to store aggregation of net\keeko\cms\core\entities\SettingSection objects.
	 */
	protected $collSettingSections;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSettingSections.
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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseLanguageText object.
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
	 * @return     net\keeko\cms\core\entities\LanguageText The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguageTextPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [language_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\LanguageText The current object (for fluent API support)
	 */
	public function setLanguageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->language_id !== $v) {
			$this->language_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID;
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
	 * @return     net\keeko\cms\core\entities\LanguageText The current object (for fluent API support)
	 */
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguageTextPeer::CONTENT;
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
			$this->language_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->content = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = \net\keeko\cms\core\entities\peer\LanguageTextPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\LanguageTextPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating LanguageText object", $e);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\LanguageTextPeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\LanguageTextPeer::addInstanceToPool($this);
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

			if ($this->aLanguage !== null) {
				if ($this->aLanguage->isModified() || $this->aLanguage->isNew()) {
					$affectedRows += $this->aLanguage->save($con);
				}
				$this->setLanguage($this->aLanguage);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguageTextPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\LanguageTextPeer::doUpdate($this, $con);
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


			if (($retval = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = \BasePeer::TYPE_PHPNAME)
	{
		$pos = \net\keeko\cms\core\entities\peer\LanguageTextPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = \BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = \net\keeko\cms\core\entities\peer\LanguageTextPeer::getFieldNames($keyType);
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = \net\keeko\cms\core\entities\peer\LanguageTextPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
		$keys = \net\keeko\cms\core\entities\peer\LanguageTextPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLanguageId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguageTextPeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID, $this->language_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguageTextPeer::CONTENT)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::CONTENT, $this->content);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\LanguageText (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
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
	 * @return     net\keeko\cms\core\entities\LanguageText Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\LanguageTextPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\LanguageTextPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Language object.
	 *
	 * @param      net\keeko\cms\core\entities\Language $v
	 * @return     net\keeko\cms\core\entities\LanguageText The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setLanguage(\net\keeko\cms\core\entities\Language $v = null)
	{
		if ($v === null) {
			$this->setLanguageId(NULL);
		} else {
			$this->setLanguageId($v->getId());
		}

		$this->aLanguage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Language object, it will not be re-added.
		if ($v !== null) {
			$v->addLanguageText($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Language object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Language The associated net\keeko\cms\core\entities\Language object.
	 * @throws     PropelException
	 */
	public function getLanguage(\PropelPDO $con = null)
	{
		if ($this->aLanguage === null && ($this->language_id !== null)) {
			$this->aLanguage = \net\keeko\cms\core\entities\peer\LanguagePeer::retrieveByPK($this->language_id, $con);
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
	 * Clears out the collPagesRelatedByTitleId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPagesRelatedByTitleId()
	 */
	public function clearPagesRelatedByTitleId()
	{
		$this->collPagesRelatedByTitleId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPagesRelatedByTitleId collection (array).
	 *
	 * By default this just sets the collPagesRelatedByTitleId collection to an empty array (like clearcollPagesRelatedByTitleId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPagesRelatedByTitleId()
	{
		$this->collPagesRelatedByTitleId = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Page objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByTitleId from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Page[]
	 * @throws     PropelException
	 */
	public function getPagesRelatedByTitleId($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByTitleId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;
		return $this->collPagesRelatedByTitleId;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Page objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException
	 */
	public function countPagesRelatedByTitleId(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\Page object to this object
	 * through the net\keeko\cms\core\entities\Page foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Page $l net\keeko\cms\core\entities\Page
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPageRelatedByTitleId(\net\keeko\cms\core\entities\Page $l)
	{
		if ($this->collPagesRelatedByTitleId === null) {
			$this->initPagesRelatedByTitleId();
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
	public function getPagesRelatedByTitleIdJoinPageRelatedByParentId($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByTitleId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

			if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;

		return $this->collPagesRelatedByTitleId;
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
	public function getPagesRelatedByTitleIdJoinApp($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByTitleId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByTitleId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

				$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::TITLE_ID, $this->id);

			if (!isset($this->lastPageRelatedByTitleIdCriteria) || !$this->lastPageRelatedByTitleIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByTitleId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByTitleIdCriteria = $criteria;

		return $this->collPagesRelatedByTitleId;
	}

	/**
	 * Clears out the collPagesRelatedByDescriptionId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPagesRelatedByDescriptionId()
	 */
	public function clearPagesRelatedByDescriptionId()
	{
		$this->collPagesRelatedByDescriptionId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPagesRelatedByDescriptionId collection (array).
	 *
	 * By default this just sets the collPagesRelatedByDescriptionId collection to an empty array (like clearcollPagesRelatedByDescriptionId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPagesRelatedByDescriptionId()
	{
		$this->collPagesRelatedByDescriptionId = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Page objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByDescriptionId from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Page[]
	 * @throws     PropelException
	 */
	public function getPagesRelatedByDescriptionId($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByDescriptionId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;
		return $this->collPagesRelatedByDescriptionId;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Page objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException
	 */
	public function countPagesRelatedByDescriptionId(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\Page object to this object
	 * through the net\keeko\cms\core\entities\Page foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Page $l net\keeko\cms\core\entities\Page
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPageRelatedByDescriptionId(\net\keeko\cms\core\entities\Page $l)
	{
		if ($this->collPagesRelatedByDescriptionId === null) {
			$this->initPagesRelatedByDescriptionId();
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
	public function getPagesRelatedByDescriptionIdJoinPageRelatedByParentId($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByDescriptionId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

			if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;

		return $this->collPagesRelatedByDescriptionId;
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
	public function getPagesRelatedByDescriptionIdJoinApp($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByDescriptionId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByDescriptionId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

				$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::DESCRIPTION_ID, $this->id);

			if (!isset($this->lastPageRelatedByDescriptionIdCriteria) || !$this->lastPageRelatedByDescriptionIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByDescriptionId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByDescriptionIdCriteria = $criteria;

		return $this->collPagesRelatedByDescriptionId;
	}

	/**
	 * Clears out the collPagesRelatedByKeywordsId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPagesRelatedByKeywordsId()
	 */
	public function clearPagesRelatedByKeywordsId()
	{
		$this->collPagesRelatedByKeywordsId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPagesRelatedByKeywordsId collection (array).
	 *
	 * By default this just sets the collPagesRelatedByKeywordsId collection to an empty array (like clearcollPagesRelatedByKeywordsId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPagesRelatedByKeywordsId()
	{
		$this->collPagesRelatedByKeywordsId = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Page objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related PagesRelatedByKeywordsId from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Page[]
	 * @throws     PropelException
	 */
	public function getPagesRelatedByKeywordsId($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByKeywordsId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				\net\keeko\cms\core\entities\peer\PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;
		return $this->collPagesRelatedByKeywordsId;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Page objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Page objects.
	 * @throws     PropelException
	 */
	public function countPagesRelatedByKeywordsId(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\PagePeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\Page object to this object
	 * through the net\keeko\cms\core\entities\Page foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Page $l net\keeko\cms\core\entities\Page
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPageRelatedByKeywordsId(\net\keeko\cms\core\entities\Page $l)
	{
		if ($this->collPagesRelatedByKeywordsId === null) {
			$this->initPagesRelatedByKeywordsId();
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
	public function getPagesRelatedByKeywordsIdJoinPageRelatedByParentId($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByKeywordsId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

			if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinPageRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;

		return $this->collPagesRelatedByKeywordsId;
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
	public function getPagesRelatedByKeywordsIdJoinApp($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByKeywordsId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByKeywordsId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

				$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\PagePeer::KEYWORDS_ID, $this->id);

			if (!isset($this->lastPageRelatedByKeywordsIdCriteria) || !$this->lastPageRelatedByKeywordsIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByKeywordsId = \net\keeko\cms\core\entities\peer\PagePeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		}
		$this->lastPageRelatedByKeywordsIdCriteria = $criteria;

		return $this->collPagesRelatedByKeywordsId;
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
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related MenuItems from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
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
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
			   $this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				\net\keeko\cms\core\entities\peer\MenuItemPeer::addSelectColumns($criteria);
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

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
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\MenuItemPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

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
	public function getMenuItemsJoinPage($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

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
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinMenu($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenu($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

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
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinMenuItemRelatedByParentId($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

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
	 * Otherwise if this LanguageText is new, it will return
	 * an empty collection; or if this LanguageText has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in LanguageText.
	 */
	public function getMenuItemsJoinModule($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
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
	public function getMenuItemsJoinAction($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItems === null) {
			if ($this->isNew()) {
				$this->collMenuItems = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinAction($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->id);

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinAction($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}

	/**
	 * Clears out the collUserExts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserExts()
	 */
	public function clearUserExts()
	{
		$this->collUserExts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserExts collection (array).
	 *
	 * By default this just sets the collUserExts collection to an empty array (like clearcollUserExts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserExts()
	{
		$this->collUserExts = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\UserExt objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related UserExts from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\UserExt[]
	 * @throws     PropelException
	 */
	public function getUserExts($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExts === null) {
			if ($this->isNew()) {
			   $this->collUserExts = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtPeer::addSelectColumns($criteria);
				$this->collUserExts = \net\keeko\cms\core\entities\peer\UserExtPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
					$this->collUserExts = \net\keeko\cms\core\entities\peer\UserExtPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserExtCriteria = $criteria;
		return $this->collUserExts;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\UserExt objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\UserExt objects.
	 * @throws     PropelException
	 */
	public function countUserExts(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UserExtPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

				if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UserExtPeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\UserExt object to this object
	 * through the net\keeko\cms\core\entities\UserExt foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\UserExt $l net\keeko\cms\core\entities\UserExt
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserExt(\net\keeko\cms\core\entities\UserExt $l)
	{
		if ($this->collUserExts === null) {
			$this->initUserExts();
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
	public function getUserExtsJoinUserExtCat($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExts === null) {
			if ($this->isNew()) {
				$this->collUserExts = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

				$this->collUserExts = \net\keeko\cms\core\entities\peer\UserExtPeer::doSelectJoinUserExtCat($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\UserExtPeer::NAME_ID, $this->id);

			if (!isset($this->lastUserExtCriteria) || !$this->lastUserExtCriteria->equals($criteria)) {
				$this->collUserExts = \net\keeko\cms\core\entities\peer\UserExtPeer::doSelectJoinUserExtCat($criteria, $con, $join_behavior);
			}
		}
		$this->lastUserExtCriteria = $criteria;

		return $this->collUserExts;
	}

	/**
	 * Clears out the collUserExtCats collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserExtCats()
	 */
	public function clearUserExtCats()
	{
		$this->collUserExtCats = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserExtCats collection (array).
	 *
	 * By default this just sets the collUserExtCats collection to an empty array (like clearcollUserExtCats());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUserExtCats()
	{
		$this->collUserExtCats = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\UserExtCat objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related UserExtCats from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\UserExtCat[]
	 * @throws     PropelException
	 */
	public function getUserExtCats($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserExtCats === null) {
			if ($this->isNew()) {
			   $this->collUserExtCats = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtCatPeer::TITLE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtCatPeer::addSelectColumns($criteria);
				$this->collUserExtCats = \net\keeko\cms\core\entities\peer\UserExtCatPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtCatPeer::TITLE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UserExtCatPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserExtCatCriteria) || !$this->lastUserExtCatCriteria->equals($criteria)) {
					$this->collUserExtCats = \net\keeko\cms\core\entities\peer\UserExtCatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserExtCatCriteria = $criteria;
		return $this->collUserExtCats;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\UserExtCat objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\UserExtCat objects.
	 * @throws     PropelException
	 */
	public function countUserExtCats(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtCatPeer::TITLE_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UserExtCatPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UserExtCatPeer::TITLE_ID, $this->id);

				if (!isset($this->lastUserExtCatCriteria) || !$this->lastUserExtCatCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UserExtCatPeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\UserExtCat object to this object
	 * through the net\keeko\cms\core\entities\UserExtCat foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\UserExtCat $l net\keeko\cms\core\entities\UserExtCat
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUserExtCat(\net\keeko\cms\core\entities\UserExtCat $l)
	{
		if ($this->collUserExtCats === null) {
			$this->initUserExtCats();
		}
	
		if (!in_array($l, $this->collUserExtCats, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUserExtCats, $l);
			$l->setLanguageText($this);
		}
	}

	/**
	 * Clears out the collSettingSections collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSettingSections()
	 */
	public function clearSettingSections()
	{
		$this->collSettingSections = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSettingSections collection (array).
	 *
	 * By default this just sets the collSettingSections collection to an empty array (like clearcollSettingSections());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSettingSections()
	{
		$this->collSettingSections = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\SettingSection objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\LanguageText has previously been saved, it will retrieve
	 * related SettingSections from storage. If this net\keeko\cms\core\entities\LanguageText is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\SettingSection[]
	 * @throws     PropelException
	 */
	public function getSettingSections($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSettingSections === null) {
			if ($this->isNew()) {
			   $this->collSettingSections = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\SettingSectionPeer::NAME_ID, $this->id);

				\net\keeko\cms\core\entities\peer\SettingSectionPeer::addSelectColumns($criteria);
				$this->collSettingSections = \net\keeko\cms\core\entities\peer\SettingSectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\SettingSectionPeer::NAME_ID, $this->id);

				\net\keeko\cms\core\entities\peer\SettingSectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSettingSectionCriteria) || !$this->lastSettingSectionCriteria->equals($criteria)) {
					$this->collSettingSections = \net\keeko\cms\core\entities\peer\SettingSectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSettingSectionCriteria = $criteria;
		return $this->collSettingSections;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\SettingSection objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\SettingSection objects.
	 * @throws     PropelException
	 */
	public function countSettingSections(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguageTextPeer::DATABASE_NAME);
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

				$criteria->add(\net\keeko\cms\core\entities\peer\SettingSectionPeer::NAME_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\SettingSectionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\SettingSectionPeer::NAME_ID, $this->id);

				if (!isset($this->lastSettingSectionCriteria) || !$this->lastSettingSectionCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\SettingSectionPeer::doCount($criteria, $con);
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
	 * Method called to associate a net\keeko\cms\core\entities\SettingSection object to this object
	 * through the net\keeko\cms\core\entities\SettingSection foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\SettingSection $l net\keeko\cms\core\entities\SettingSection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSettingSection(\net\keeko\cms\core\entities\SettingSection $l)
	{
		if ($this->collSettingSections === null) {
			$this->initSettingSections();
		}
	
		if (!in_array($l, $this->collSettingSections, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSettingSections, $l);
			$l->setLanguageText($this);
		}
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
			if ($this->collPagesRelatedByTitleId) {
				foreach ((array) $this->collPagesRelatedByTitleId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPagesRelatedByDescriptionId) {
				foreach ((array) $this->collPagesRelatedByDescriptionId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPagesRelatedByKeywordsId) {
				foreach ((array) $this->collPagesRelatedByKeywordsId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMenuItems) {
				foreach ((array) $this->collMenuItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserExts) {
				foreach ((array) $this->collUserExts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserExtCats) {
				foreach ((array) $this->collUserExtCats as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSettingSections) {
				foreach ((array) $this->collSettingSections as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPagesRelatedByTitleId = null;
		$this->collPagesRelatedByDescriptionId = null;
		$this->collPagesRelatedByKeywordsId = null;
		$this->collMenuItems = null;
		$this->collUserExts = null;
		$this->collUserExtCats = null;
		$this->collSettingSections = null;
			$this->aLanguage = null;
	}

} // net\keeko\cms\core\entities\base\BaseLanguageText
