<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'grid' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseGrid extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\GridPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the block_id field.
	 * @var        int
	 */
	protected $block_id;

	/**
	 * The value for the page_id field.
	 * @var        int
	 */
	protected $page_id;

	/**
	 * The value for the grid_id field.
	 * @var        int
	 */
	protected $grid_id;

	/**
	 * The value for the classnames field.
	 * @var        string
	 */
	protected $classnames;

	/**
	 * @var        Grid
	 */
	protected $aGridRelatedByGridId;

	/**
	 * @var        Page
	 */
	protected $aPage;

	/**
	 * @var        Block
	 */
	protected $aBlock;

	/**
	 * @var        array net\keeko\cms\core\entities\Grid[] Collection to store aggregation of net\keeko\cms\core\entities\Grid objects.
	 */
	protected $collGridsRelatedByGridId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collGridsRelatedByGridId.
	 */
	private $lastGridRelatedByGridIdCriteria = null;

	/**
	 * @var        array net\keeko\cms\core\entities\Unit[] Collection to store aggregation of net\keeko\cms\core\entities\Unit objects.
	 */
	protected $collUnits;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUnits.
	 */
	private $lastUnitCriteria = null;

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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseGrid object.
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
	 * Get the [block_id] column value.
	 * 
	 * @return     int
	 */
	public function getBlockId()
	{
		return $this->block_id;
	}

	/**
	 * Get the [page_id] column value.
	 * 
	 * @return     int
	 */
	public function getPageId()
	{
		return $this->page_id;
	}

	/**
	 * Get the [grid_id] column value.
	 * 
	 * @return     int
	 */
	public function getGridId()
	{
		return $this->grid_id;
	}

	/**
	 * Get the [classnames] column value.
	 * 
	 * @return     string
	 */
	public function getClassnames()
	{
		return $this->classnames;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [block_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 */
	public function setBlockId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->block_id !== $v) {
			$this->block_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::BLOCK_ID;
		}

		if ($this->aBlock !== null && $this->aBlock->getId() !== $v) {
			$this->aBlock = null;
		}

		return $this;
	} // setBlockId()

	/**
	 * Set the value of [page_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 */
	public function setPageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->page_id !== $v) {
			$this->page_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::PAGE_ID;
		}

		if ($this->aPage !== null && $this->aPage->getId() !== $v) {
			$this->aPage = null;
		}

		return $this;
	} // setPageId()

	/**
	 * Set the value of [grid_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 */
	public function setGridId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->grid_id !== $v) {
			$this->grid_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::GRID_ID;
		}

		if ($this->aGridRelatedByGridId !== null && $this->aGridRelatedByGridId->getId() !== $v) {
			$this->aGridRelatedByGridId = null;
		}

		return $this;
	} // setGridId()

	/**
	 * Set the value of [classnames] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 */
	public function setClassnames($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->classnames !== $v) {
			$this->classnames = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::CLASSNAMES;
		}

		return $this;
	} // setClassnames()

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
			$this->block_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->page_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->grid_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->classnames = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = \net\keeko\cms\core\entities\peer\GridPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\GridPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating Grid object", $e);
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

		if ($this->aBlock !== null && $this->block_id !== $this->aBlock->getId()) {
			$this->aBlock = null;
		}
		if ($this->aPage !== null && $this->page_id !== $this->aPage->getId()) {
			$this->aPage = null;
		}
		if ($this->aGridRelatedByGridId !== null && $this->grid_id !== $this->aGridRelatedByGridId->getId()) {
			$this->aGridRelatedByGridId = null;
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\GridPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aGridRelatedByGridId = null;
			$this->aPage = null;
			$this->aBlock = null;
			$this->collGridsRelatedByGridId = null;
			$this->lastGridRelatedByGridIdCriteria = null;

			$this->collUnits = null;
			$this->lastUnitCriteria = null;

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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\GridPeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\GridPeer::addInstanceToPool($this);
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

			if ($this->aGridRelatedByGridId !== null) {
				if ($this->aGridRelatedByGridId->isModified() || $this->aGridRelatedByGridId->isNew()) {
					$affectedRows += $this->aGridRelatedByGridId->save($con);
				}
				$this->setGridRelatedByGridId($this->aGridRelatedByGridId);
			}

			if ($this->aPage !== null) {
				if ($this->aPage->isModified() || $this->aPage->isNew()) {
					$affectedRows += $this->aPage->save($con);
				}
				$this->setPage($this->aPage);
			}

			if ($this->aBlock !== null) {
				if ($this->aBlock->isModified() || $this->aBlock->isNew()) {
					$affectedRows += $this->aBlock->save($con);
				}
				$this->setBlock($this->aBlock);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\GridPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\GridPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\GridPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGridsRelatedByGridId !== null) {
				foreach ($this->collGridsRelatedByGridId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUnits !== null) {
				foreach ($this->collUnits as $referrerFK) {
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

			if ($this->aGridRelatedByGridId !== null) {
				if (!$this->aGridRelatedByGridId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGridRelatedByGridId->getValidationFailures());
				}
			}

			if ($this->aPage !== null) {
				if (!$this->aPage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPage->getValidationFailures());
				}
			}

			if ($this->aBlock !== null) {
				if (!$this->aBlock->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBlock->getValidationFailures());
				}
			}


			if (($retval = \net\keeko\cms\core\entities\peer\GridPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGridsRelatedByGridId !== null) {
					foreach ($this->collGridsRelatedByGridId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUnits !== null) {
					foreach ($this->collUnits as $referrerFK) {
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
		$pos = \net\keeko\cms\core\entities\peer\GridPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				return $this->getBlockId();
				break;
			case 2:
				return $this->getPageId();
				break;
			case 3:
				return $this->getGridId();
				break;
			case 4:
				return $this->getClassnames();
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
		$keys = \net\keeko\cms\core\entities\peer\GridPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getBlockId(),
			$keys[2] => $this->getPageId(),
			$keys[3] => $this->getGridId(),
			$keys[4] => $this->getClassnames(),
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
		$pos = \net\keeko\cms\core\entities\peer\GridPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				$this->setBlockId($value);
				break;
			case 2:
				$this->setPageId($value);
				break;
			case 3:
				$this->setGridId($value);
				break;
			case 4:
				$this->setClassnames($value);
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
		$keys = \net\keeko\cms\core\entities\peer\GridPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBlockId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPageId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGridId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setClassnames($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\GridPeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\GridPeer::BLOCK_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::BLOCK_ID, $this->block_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\GridPeer::PAGE_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::PAGE_ID, $this->page_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->grid_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\GridPeer::CLASSNAMES)) $criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::CLASSNAMES, $this->classnames);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\Grid (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBlockId($this->block_id);

		$copyObj->setPageId($this->page_id);

		$copyObj->setGridId($this->grid_id);

		$copyObj->setClassnames($this->classnames);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getGridsRelatedByGridId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGridRelatedByGridId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUnits() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUnit($relObj->copy($deepCopy));
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
	 * @return     net\keeko\cms\core\entities\Grid Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\GridPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\GridPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Grid object.
	 *
	 * @param      net\keeko\cms\core\entities\Grid $v
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setGridRelatedByGridId(\net\keeko\cms\core\entities\Grid $v = null)
	{
		if ($v === null) {
			$this->setGridId(NULL);
		} else {
			$this->setGridId($v->getId());
		}

		$this->aGridRelatedByGridId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Grid object, it will not be re-added.
		if ($v !== null) {
			$v->addGridRelatedByGridId($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Grid object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Grid The associated net\keeko\cms\core\entities\Grid object.
	 * @throws     PropelException
	 */
	public function getGridRelatedByGridId(\PropelPDO $con = null)
	{
		if ($this->aGridRelatedByGridId === null && ($this->grid_id !== null)) {
			$this->aGridRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::retrieveByPK($this->grid_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aGridRelatedByGridId->addGridsRelatedByGridId($this);
			 */
		}
		return $this->aGridRelatedByGridId;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Page object.
	 *
	 * @param      net\keeko\cms\core\entities\Page $v
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPage(\net\keeko\cms\core\entities\Page $v = null)
	{
		if ($v === null) {
			$this->setPageId(NULL);
		} else {
			$this->setPageId($v->getId());
		}

		$this->aPage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Page object, it will not be re-added.
		if ($v !== null) {
			$v->addGrid($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Page object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Page The associated net\keeko\cms\core\entities\Page object.
	 * @throws     PropelException
	 */
	public function getPage(\PropelPDO $con = null)
	{
		if ($this->aPage === null && ($this->page_id !== null)) {
			$this->aPage = \net\keeko\cms\core\entities\peer\PagePeer::retrieveByPK($this->page_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPage->addGrids($this);
			 */
		}
		return $this->aPage;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Block object.
	 *
	 * @param      net\keeko\cms\core\entities\Block $v
	 * @return     net\keeko\cms\core\entities\Grid The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBlock(\net\keeko\cms\core\entities\Block $v = null)
	{
		if ($v === null) {
			$this->setBlockId(NULL);
		} else {
			$this->setBlockId($v->getId());
		}

		$this->aBlock = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Block object, it will not be re-added.
		if ($v !== null) {
			$v->addGrid($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Block object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Block The associated net\keeko\cms\core\entities\Block object.
	 * @throws     PropelException
	 */
	public function getBlock(\PropelPDO $con = null)
	{
		if ($this->aBlock === null && ($this->block_id !== null)) {
			$this->aBlock = \net\keeko\cms\core\entities\peer\BlockPeer::retrieveByPK($this->block_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aBlock->addGrids($this);
			 */
		}
		return $this->aBlock;
	}

	/**
	 * Clears out the collGridsRelatedByGridId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGridsRelatedByGridId()
	 */
	public function clearGridsRelatedByGridId()
	{
		$this->collGridsRelatedByGridId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGridsRelatedByGridId collection (array).
	 *
	 * By default this just sets the collGridsRelatedByGridId collection to an empty array (like clearcollGridsRelatedByGridId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initGridsRelatedByGridId()
	{
		$this->collGridsRelatedByGridId = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Grid objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Grid has previously been saved, it will retrieve
	 * related GridsRelatedByGridId from storage. If this net\keeko\cms\core\entities\Grid is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Grid[]
	 * @throws     PropelException
	 */
	public function getGridsRelatedByGridId($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGridsRelatedByGridId === null) {
			if ($this->isNew()) {
			   $this->collGridsRelatedByGridId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				\net\keeko\cms\core\entities\peer\GridPeer::addSelectColumns($criteria);
				$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				\net\keeko\cms\core\entities\peer\GridPeer::addSelectColumns($criteria);
				if (!isset($this->lastGridRelatedByGridIdCriteria) || !$this->lastGridRelatedByGridIdCriteria->equals($criteria)) {
					$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGridRelatedByGridIdCriteria = $criteria;
		return $this->collGridsRelatedByGridId;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Grid objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Grid objects.
	 * @throws     PropelException
	 */
	public function countGridsRelatedByGridId(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collGridsRelatedByGridId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\GridPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				if (!isset($this->lastGridRelatedByGridIdCriteria) || !$this->lastGridRelatedByGridIdCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\GridPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGridsRelatedByGridId);
				}
			} else {
				$count = count($this->collGridsRelatedByGridId);
			}
		}
		$this->lastGridRelatedByGridIdCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\Grid object to this object
	 * through the net\keeko\cms\core\entities\Grid foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Grid $l net\keeko\cms\core\entities\Grid
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGridRelatedByGridId(\net\keeko\cms\core\entities\Grid $l)
	{
		if ($this->collGridsRelatedByGridId === null) {
			$this->initGridsRelatedByGridId();
		}
	
		if (!in_array($l, $this->collGridsRelatedByGridId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collGridsRelatedByGridId, $l);
			$l->setGridRelatedByGridId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Grid is new, it will return
	 * an empty collection; or if this Grid has previously
	 * been saved, it will retrieve related GridsRelatedByGridId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Grid.
	 */
	public function getGridsRelatedByGridIdJoinPage($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGridsRelatedByGridId === null) {
			if ($this->isNew()) {
				$this->collGridsRelatedByGridId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

			if (!isset($this->lastGridRelatedByGridIdCriteria) || !$this->lastGridRelatedByGridIdCriteria->equals($criteria)) {
				$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		}
		$this->lastGridRelatedByGridIdCriteria = $criteria;

		return $this->collGridsRelatedByGridId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Grid is new, it will return
	 * an empty collection; or if this Grid has previously
	 * been saved, it will retrieve related GridsRelatedByGridId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Grid.
	 */
	public function getGridsRelatedByGridIdJoinBlock($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGridsRelatedByGridId === null) {
			if ($this->isNew()) {
				$this->collGridsRelatedByGridId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

				$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelectJoinBlock($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\GridPeer::GRID_ID, $this->id);

			if (!isset($this->lastGridRelatedByGridIdCriteria) || !$this->lastGridRelatedByGridIdCriteria->equals($criteria)) {
				$this->collGridsRelatedByGridId = \net\keeko\cms\core\entities\peer\GridPeer::doSelectJoinBlock($criteria, $con, $join_behavior);
			}
		}
		$this->lastGridRelatedByGridIdCriteria = $criteria;

		return $this->collGridsRelatedByGridId;
	}

	/**
	 * Clears out the collUnits collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUnits()
	 */
	public function clearUnits()
	{
		$this->collUnits = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUnits collection (array).
	 *
	 * By default this just sets the collUnits collection to an empty array (like clearcollUnits());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUnits()
	{
		$this->collUnits = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\Unit objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\Grid has previously been saved, it will retrieve
	 * related Units from storage. If this net\keeko\cms\core\entities\Grid is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\Unit[]
	 * @throws     PropelException
	 */
	public function getUnits($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUnits === null) {
			if ($this->isNew()) {
			   $this->collUnits = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UnitPeer::GRID_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UnitPeer::addSelectColumns($criteria);
				$this->collUnits = \net\keeko\cms\core\entities\peer\UnitPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UnitPeer::GRID_ID, $this->id);

				\net\keeko\cms\core\entities\peer\UnitPeer::addSelectColumns($criteria);
				if (!isset($this->lastUnitCriteria) || !$this->lastUnitCriteria->equals($criteria)) {
					$this->collUnits = \net\keeko\cms\core\entities\peer\UnitPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUnitCriteria = $criteria;
		return $this->collUnits;
	}

	/**
	 * Returns the number of related net\keeko\cms\core\entities\Unit objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related net\keeko\cms\core\entities\Unit objects.
	 * @throws     PropelException
	 */
	public function countUnits(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\GridPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUnits === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\UnitPeer::GRID_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\UnitPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\UnitPeer::GRID_ID, $this->id);

				if (!isset($this->lastUnitCriteria) || !$this->lastUnitCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\UnitPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUnits);
				}
			} else {
				$count = count($this->collUnits);
			}
		}
		$this->lastUnitCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a net\keeko\cms\core\entities\Unit object to this object
	 * through the net\keeko\cms\core\entities\Unit foreign key attribute.
	 *
	 * @param      net\keeko\cms\core\entities\Unit $l net\keeko\cms\core\entities\Unit
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUnit(\net\keeko\cms\core\entities\Unit $l)
	{
		if ($this->collUnits === null) {
			$this->initUnits();
		}
	
		if (!in_array($l, $this->collUnits, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUnits, $l);
			$l->setGrid($this);
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
			if ($this->collGridsRelatedByGridId) {
				foreach ((array) $this->collGridsRelatedByGridId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUnits) {
				foreach ((array) $this->collUnits as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collGridsRelatedByGridId = null;
		$this->collUnits = null;
			$this->aGridRelatedByGridId = null;
			$this->aPage = null;
			$this->aBlock = null;
	}

} // net\keeko\cms\core\entities\base\BaseGrid
