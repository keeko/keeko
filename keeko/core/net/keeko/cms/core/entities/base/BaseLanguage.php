<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'language' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLanguage extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\LanguagePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the fallback field.
	 * @var        int
	 */
	protected $fallback;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the country field.
	 * @var        string
	 */
	protected $country;

	/**
	 * The value for the language field.
	 * @var        string
	 */
	protected $language;

	/**
	 * The value for the variant field.
	 * @var        string
	 */
	protected $variant;

	/**
	 * The value for the is_default field.
	 * @var        boolean
	 */
	protected $is_default;

	/**
	 * The value for the is_active field.
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the interface_language field.
	 * @var        string
	 */
	protected $interface_language;

	/**
	 * @var        Language
	 */
	protected $aLanguageRelatedByFallback;

	/**
	 * @var        array net\keeko\cms\core\entities\Language[] Collection to store aggregation of net\keeko\cms\core\entities\Language objects.
	 */
	protected $collLanguagesRelatedByFallback;

	/**
	 * @var        Criteria The criteria used to select the current contents of collLanguagesRelatedByFallback.
	 */
	private $lastLanguageRelatedByFallbackCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\LanguageText[] Collection to store aggregation of net\keeko\cms\core\entities\LanguageText objects.
	 */
	protected $collLanguageTexts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collLanguageTexts.
	 */
	private $lastLanguageTextCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\LanguageUri[] Collection to store aggregation of net\keeko\cms\core\entities\LanguageUri objects.
	 */
	protected $collLanguageUris;

	/**
	 * @var        Criteria The criteria used to select the current contents of collLanguageUris.
	 */
	private $lastLanguageUriCriteria = null;

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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseLanguage object.
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
	 * Get the [fallback] column value.
	 * 
	 * @return     int
	 */
	public function getFallback()
	{
		return $this->fallback;
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
	 * Get the [country] column value.
	 * 
	 * @return     string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * Get the [language] column value.
	 * 
	 * @return     string
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * Get the [variant] column value.
	 * 
	 * @return     string
	 */
	public function getVariant()
	{
		return $this->variant;
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
	 * Get the [interface_language] column value.
	 * 
	 * @return     string
	 */
	public function getInterfaceLanguage()
	{
		return $this->interface_language;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [fallback] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setFallback($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->fallback !== $v) {
			$this->fallback = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK;
		}

		if ($this->aLanguageRelatedByFallback !== null && $this->aLanguageRelatedByFallback->getId() !== $v) {
			$this->aLanguageRelatedByFallback = null;
		}

		return $this;
	} // setFallback()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [country] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::COUNTRY;
		}

		return $this;
	} // setCountry()

	/**
	 * Set the value of [language] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setLanguage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::LANGUAGE;
		}

		return $this;
	} // setLanguage()

	/**
	 * Set the value of [variant] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setVariant($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->variant !== $v) {
			$this->variant = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::VARIANT;
		}

		return $this;
	} // setVariant()

	/**
	 * Set the value of [is_default] column.
	 * 
	 * @param      boolean $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setIsDefault($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_default !== $v) {
			$this->is_default = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::IS_DEFAULT;
		}

		return $this;
	} // setIsDefault()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [interface_language] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 */
	public function setInterfaceLanguage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->interface_language !== $v) {
			$this->interface_language = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::INTERFACE_LANGUAGE;
		}

		return $this;
	} // setInterfaceLanguage()

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
			$this->fallback = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->country = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->language = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->variant = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->is_default = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->is_active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->interface_language = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = \net\keeko\cms\core\entities\peer\LanguagePeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\LanguagePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating Language object", $e);
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

		if ($this->aLanguageRelatedByFallback !== null && $this->fallback !== $this->aLanguageRelatedByFallback->getId()) {
			$this->aLanguageRelatedByFallback = null;
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\LanguagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aLanguageRelatedByFallback = null;
			$this->collLanguagesRelatedByFallback = null;
			$this->lastLanguageRelatedByFallbackCriteria = null;

			$this->collLanguageTexts = null;
			$this->lastLanguageTextCriteria = null;

			$this->collLanguageUris = null;
			$this->lastLanguageUriCriteria = null;

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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\LanguagePeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\LanguagePeer::addInstanceToPool($this);
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

			if ($this->aLanguageRelatedByFallback !== null) {
				if ($this->aLanguageRelatedByFallback->isModified() || $this->aLanguageRelatedByFallback->isNew()) {
					$affectedRows += $this->aLanguageRelatedByFallback->save($con);
				}
				$this->setLanguageRelatedByFallback($this->aLanguageRelatedByFallback);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\LanguagePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\LanguagePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\LanguagePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collLanguagesRelatedByFallback !== null) {
				foreach ($this->collLanguagesRelatedByFallback as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLanguageTexts !== null) {
				foreach ($this->collLanguageTexts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLanguageUris !== null) {
				foreach ($this->collLanguageUris as $referrerFK) {
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

			if ($this->aLanguageRelatedByFallback !== null) {
				if (!$this->aLanguageRelatedByFallback->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageRelatedByFallback->getValidationFailures());
				}
			}


			if (($retval = \net\keeko\cms\core\entities\peer\LanguagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLanguagesRelatedByFallback !== null) {
					foreach ($this->collLanguagesRelatedByFallback as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLanguageTexts !== null) {
					foreach ($this->collLanguageTexts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLanguageUris !== null) {
					foreach ($this->collLanguageUris as $referrerFK) {
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
		$pos = \net\keeko\cms\core\entities\peer\LanguagePeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				return $this->getFallback();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getCountry();
				break;
			case 4:
				return $this->getLanguage();
				break;
			case 5:
				return $this->getVariant();
				break;
			case 6:
				return $this->getIsDefault();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getInterfaceLanguage();
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
		$keys = \net\keeko\cms\core\entities\peer\LanguagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFallback(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getCountry(),
			$keys[4] => $this->getLanguage(),
			$keys[5] => $this->getVariant(),
			$keys[6] => $this->getIsDefault(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getInterfaceLanguage(),
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
		$pos = \net\keeko\cms\core\entities\peer\LanguagePeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				$this->setFallback($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setCountry($value);
				break;
			case 4:
				$this->setLanguage($value);
				break;
			case 5:
				$this->setVariant($value);
				break;
			case 6:
				$this->setIsDefault($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setInterfaceLanguage($value);
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
		$keys = \net\keeko\cms\core\entities\peer\LanguagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFallback($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCountry($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLanguage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVariant($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsDefault($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInterfaceLanguage($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK, $this->fallback);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::NAME)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::NAME, $this->name);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::COUNTRY)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::COUNTRY, $this->country);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::LANGUAGE)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::VARIANT)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::VARIANT, $this->variant);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::IS_DEFAULT)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::IS_ACTIVE)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\LanguagePeer::INTERFACE_LANGUAGE)) $criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::INTERFACE_LANGUAGE, $this->interface_language);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\Language (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFallback($this->fallback);

		$copyObj->setName($this->name);

		$copyObj->setCountry($this->country);

		$copyObj->setLanguage($this->language);

		$copyObj->setVariant($this->variant);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setInterfaceLanguage($this->interface_language);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getLanguagesRelatedByFallback() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLanguageRelatedByFallback($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLanguageTexts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLanguageText($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLanguageUris() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLanguageUri($relObj->copy($deepCopy));
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
	 * @return     net\keeko\cms\core\entities\Language Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\LanguagePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\LanguagePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Language object.
	 *
	 * @param      net\keeko\cms\core\entities\Language $v
	 * @return     net\keeko\cms\core\entities\Language The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setLanguageRelatedByFallback(\net\keeko\cms\core\entities\Language $v = null)
	{
		if ($v === null) {
			$this->setFallback(NULL);
		} else {
			$this->setFallback($v->getId());
		}

		$this->aLanguageRelatedByFallback = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Language object, it will not be re-added.
		if ($v !== null) {
			$v->addLanguageRelatedByFallback($this);
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
	public function getLanguageRelatedByFallback(\PropelPDO $con = null)
	{
		if ($this->aLanguageRelatedByFallback === null && ($this->fallback !== null)) {
			$this->aLanguageRelatedByFallback = \net\keeko\cms\core\entities\peer\LanguagePeer::retrieveByPK($this->fallback, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageRelatedByFallback->addLanguagesRelatedByFallback($this);
			 */
		}
		return $this->aLanguageRelatedByFallback;
	}

	/**
	 * Clears out the collLanguagesRelatedByFallback collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLanguagesRelatedByFallback()
	 */
	public function clearLanguagesRelatedByFallback()
	{
		$this->collLanguagesRelatedByFallback = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLanguagesRelatedByFallback collection (array).
	 *
	 * By default this just sets the collLanguagesRelatedByFallback collection to an empty array (like clearcollLanguagesRelatedByFallback());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLanguagesRelatedByFallback()
	{
		$this->collLanguagesRelatedByFallback = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Language objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Language has previously been saved, it will retrieve
	 * related LanguagesRelatedByFallback from storage. If this net\keeko\cms\core\entities\Language is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Language[]
	 * @throws     PropelException
	 */
	public function getLanguagesRelatedByFallback($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanguagesRelatedByFallback === null) {
			if ($this->isNew()) {
			   $this->collLanguagesRelatedByFallback = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK, $this->id);

				\net\keeko\cms\core\entities\peer\LanguagePeer::addSelectColumns($criteria);
				$this->collLanguagesRelatedByFallback = \net\keeko\cms\core\entities\peer\LanguagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK, $this->id);

				\net\keeko\cms\core\entities\peer\LanguagePeer::addSelectColumns($criteria);
				if (!isset($this->lastLanguageRelatedByFallbackCriteria) || !$this->lastLanguageRelatedByFallbackCriteria->equals($criteria)) {
					$this->collLanguagesRelatedByFallback = \net\keeko\cms\core\entities\peer\LanguagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanguageRelatedByFallbackCriteria = $criteria;
		return $this->collLanguagesRelatedByFallback;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Language objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Language objects.
	 * @throws     PropelException
	 */
	public function countLanguagesRelatedByFallback(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanguagesRelatedByFallback === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK, $this->id);

				$count = \net\keeko\cms\core\entities\peer\LanguagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguagePeer::FALLBACK, $this->id);

				if (!isset($this->lastLanguageRelatedByFallbackCriteria) || !$this->lastLanguageRelatedByFallbackCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\LanguagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLanguagesRelatedByFallback);
				}
			} else {
				$count = count($this->collLanguagesRelatedByFallback);
			}
		}
		$this->lastLanguageRelatedByFallbackCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\Language object to this object
	 * through the net\keeko\cms\core\entities\Language foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Language $l net\keeko\cms\core\entities\Language
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanguageRelatedByFallback(\net\keeko\cms\core\entities\Language $l)
	{
		if ($this->collLanguagesRelatedByFallback === null) {
			$this->initLanguagesRelatedByFallback();
		}
	
		if (!in_array($l, $this->collLanguagesRelatedByFallback, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLanguagesRelatedByFallback, $l);
			$l->setLanguageRelatedByFallback($this);
		}
	}

	/**
	 * Clears out the collLanguageTexts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLanguageTexts()
	 */
	public function clearLanguageTexts()
	{
		$this->collLanguageTexts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLanguageTexts collection (array).
	 *
	 * By default this just sets the collLanguageTexts collection to an empty array (like clearcollLanguageTexts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLanguageTexts()
	{
		$this->collLanguageTexts = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\LanguageText objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Language has previously been saved, it will retrieve
	 * related LanguageTexts from storage. If this net\keeko\cms\core\entities\Language is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\LanguageText[]
	 * @throws     PropelException
	 */
	public function getLanguageTexts($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanguageTexts === null) {
			if ($this->isNew()) {
			   $this->collLanguageTexts = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\LanguageTextPeer::addSelectColumns($criteria);
				$this->collLanguageTexts = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\LanguageTextPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanguageTextCriteria) || !$this->lastLanguageTextCriteria->equals($criteria)) {
					$this->collLanguageTexts = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanguageTextCriteria = $criteria;
		return $this->collLanguageTexts;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\LanguageText objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\LanguageText objects.
	 * @throws     PropelException
	 */
	public function countLanguageTexts(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanguageTexts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageTextPeer::LANGUAGE_ID, $this->id);

				if (!isset($this->lastLanguageTextCriteria) || !$this->lastLanguageTextCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\LanguageTextPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLanguageTexts);
				}
			} else {
				$count = count($this->collLanguageTexts);
			}
		}
		$this->lastLanguageTextCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\LanguageText object to this object
	 * through the net\keeko\cms\core\entities\LanguageText foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\LanguageText $l net\keeko\cms\core\entities\LanguageText
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanguageText(\net\keeko\cms\core\entities\LanguageText $l)
	{
		if ($this->collLanguageTexts === null) {
			$this->initLanguageTexts();
		}
	
		if (!in_array($l, $this->collLanguageTexts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLanguageTexts, $l);
			$l->setLanguage($this);
		}
	}

	/**
	 * Clears out the collLanguageUris collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLanguageUris()
	 */
	public function clearLanguageUris()
	{
		$this->collLanguageUris = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLanguageUris collection (array).
	 *
	 * By default this just sets the collLanguageUris collection to an empty array (like clearcollLanguageUris());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLanguageUris()
	{
		$this->collLanguageUris = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\LanguageUri objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Language has previously been saved, it will retrieve
	 * related LanguageUris from storage. If this net\keeko\cms\core\entities\Language is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\LanguageUri[]
	 * @throws     PropelException
	 */
	public function getLanguageUris($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanguageUris === null) {
			if ($this->isNew()) {
			   $this->collLanguageUris = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\LanguageUriPeer::addSelectColumns($criteria);
				$this->collLanguageUris = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

				\net\keeko\cms\core\entities\peer\LanguageUriPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanguageUriCriteria) || !$this->lastLanguageUriCriteria->equals($criteria)) {
					$this->collLanguageUris = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanguageUriCriteria = $criteria;
		return $this->collLanguageUris;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\LanguageUri objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\LanguageUri objects.
	 * @throws     PropelException
	 */
	public function countLanguageUris(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLanguageUris === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

				if (!isset($this->lastLanguageUriCriteria) || !$this->lastLanguageUriCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLanguageUris);
				}
			} else {
				$count = count($this->collLanguageUris);
			}
		}
		$this->lastLanguageUriCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\LanguageUri object to this object
	 * through the net\keeko\cms\core\entities\LanguageUri foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\LanguageUri $l net\keeko\cms\core\entities\LanguageUri
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanguageUri(\net\keeko\cms\core\entities\LanguageUri $l)
	{
		if ($this->collLanguageUris === null) {
			$this->initLanguageUris();
		}
	
		if (!in_array($l, $this->collLanguageUris, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLanguageUris, $l);
			$l->setLanguage($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related LanguageUris from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
	 */
	public function getLanguageUrisJoinApp($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\LanguagePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanguageUris === null) {
			if ($this->isNew()) {
				$this->collLanguageUris = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

				$this->collLanguageUris = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\LanguageUriPeer::LANGUAGE_ID, $this->id);

			if (!isset($this->lastLanguageUriCriteria) || !$this->lastLanguageUriCriteria->equals($criteria)) {
				$this->collLanguageUris = \net\keeko\cms\core\entities\peer\LanguageUriPeer::doSelectJoinApp($criteria, $con, $join_behavior);
			}
		}
		$this->lastLanguageUriCriteria = $criteria;

		return $this->collLanguageUris;
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
			if ($this->collLanguagesRelatedByFallback) {
				foreach ((array) $this->collLanguagesRelatedByFallback as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLanguageTexts) {
				foreach ((array) $this->collLanguageTexts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLanguageUris) {
				foreach ((array) $this->collLanguageUris as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collLanguagesRelatedByFallback = null;
		$this->collLanguageTexts = null;
		$this->collLanguageUris = null;
			$this->aLanguageRelatedByFallback = null;
	}

} // net\keeko\cms\core\entities\base\BaseLanguage
