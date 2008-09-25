<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::LayoutPeer;
use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::GridPeer;
use net::keeko::cms::core::entities::LayoutGridPeer;



/**
 * Base class that represents a row from the 'layout' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseLayout extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LayoutPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the page_id field.
	 * @var        int
	 */
	protected $page_id;

	/**
	 * @var        Page
	 */
	protected $aPage;

	/**
	 * @var        array Grid[] Collection to store aggregation of Grid objects.
	 */
	protected $collGrids;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collGrids.
	 */
	private $lastGridCriteria = null;

	/**
	 * @var        array LayoutGrid[] Collection to store aggregation of LayoutGrid objects.
	 */
	protected $collLayoutGrids;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collLayoutGrids.
	 */
	private $lastLayoutGridCriteria = null;

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
	 * Initializes internal state of BaseLayout object.
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
	 * Get the [page_id] column value.
	 * 
	 * @return     int
	 */
	public function getPageId()
	{
		return $this->page_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Layout The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LayoutPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [page_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Layout The current object (for fluent API support)
	 */
	public function setPageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->page_id !== $v) {
			$this->page_id = $v;
			$this->modifiedColumns[] = LayoutPeer::PAGE_ID;
		}

		if ($this->aPage !== null && $this->aPage->getId() !== $v) {
			$this->aPage = null;
		}

		return $this;
	} // setPageId()

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
			$this->page_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 2; // 2 = LayoutPeer::NUM_COLUMNS - LayoutPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating Layout object", $e);
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

		if ($this->aPage !== null && $this->page_id !== $this->aPage->getId()) {
			$this->aPage = null;
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
			$con = ::Propel::getConnection(LayoutPeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = LayoutPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPage = null;
			$this->collGrids = null;
			$this->lastGridCriteria = null;

			$this->collLayoutGrids = null;
			$this->lastLayoutGridCriteria = null;

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
			$con = ::Propel::getConnection(LayoutPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			LayoutPeer::doDelete($this, $con);
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
			$con = ::Propel::getConnection(LayoutPeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			LayoutPeer::addInstanceToPool($this);
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

			if ($this->aPage !== null) {
				if ($this->aPage->isModified() || $this->aPage->isNew()) {
					$affectedRows += $this->aPage->save($con);
				}
				$this->setPage($this->aPage);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LayoutPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += LayoutPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGrids !== null) {
				foreach ($this->collGrids as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLayoutGrids !== null) {
				foreach ($this->collLayoutGrids as $referrerFK) {
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

			if ($this->aPage !== null) {
				if (!$this->aPage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPage->getValidationFailures());
				}
			}


			if (($retval = LayoutPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGrids !== null) {
					foreach ($this->collGrids as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLayoutGrids !== null) {
					foreach ($this->collLayoutGrids as $referrerFK) {
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
		$pos = LayoutPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				return $this->getPageId();
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
		$keys = LayoutPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPageId(),
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
		$pos = LayoutPeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setPageId($value);
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
		$keys = LayoutPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPageId($arr[$keys[1]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(LayoutPeer::DATABASE_NAME);

		if ($this->isColumnModified(LayoutPeer::ID)) $criteria->add(LayoutPeer::ID, $this->id);
		if ($this->isColumnModified(LayoutPeer::PAGE_ID)) $criteria->add(LayoutPeer::PAGE_ID, $this->page_id);

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
		$criteria = new ::Criteria(LayoutPeer::DATABASE_NAME);

		$criteria->add(LayoutPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Layout (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPageId($this->page_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getGrids() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGrid($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLayoutGrids() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLayoutGrid($relObj->copy($deepCopy));
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
	 * @return     Layout Clone of current object.
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
	 * @return     LayoutPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LayoutPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Page object.
	 *
	 * @param      Page $v
	 * @return     Layout The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setPage(Page $v = null)
	{
		if ($v === null) {
			$this->setPageId(NULL);
		} else {
			$this->setPageId($v->getId());
		}

		$this->aPage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Page object, it will not be re-added.
		if ($v !== null) {
			$v->addLayout($this);
		}

		return $this;
	}


	/**
	 * Get the associated Page object
	 *
	 * @param      ::PropelPDO Optional Connection object.
	 * @return     Page The associated Page object.
	 * @throws     ::PropelException
	 */
	public function getPage(::PropelPDO $con = null)
	{
		if ($this->aPage === null && ($this->page_id !== null)) {
			$this->aPage = PagePeer::retrieveByPK($this->page_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPage->addLayouts($this);
			 */
		}
		return $this->aPage;
	}

	/**
	 * Temporary storage of collGrids to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addGrids() method.
	 * @see        addGrids()
	 */
	public function initGrids()
	{
		if ($this->collGrids === null) {
			$this->collGrids = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Layout has previously been saved, it will retrieve
	 * related Grids from storage. If this Layout is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getGrids($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrids === null) {
			if ($this->isNew()) {
			   $this->collGrids = array();
			} else {

				$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

				GridPeer::addSelectColumns($criteria);
				$this->collGrids = GridPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

				GridPeer::addSelectColumns($criteria);
				if (!isset($this->lastGridCriteria) || !$this->lastGridCriteria->equals($criteria)) {
					$this->collGrids = GridPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGridCriteria = $criteria;
		return $this->collGrids;
	}

	/**
	 * Returns the number of related Grids.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countGrids(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collGrids === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

				$count = GridPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

				if (!isset($this->lastGridCriteria) || !$this->lastGridCriteria->equals($criteria)) {
					$count = GridPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGrids);
				}
			} else {
				$count = count($this->collGrids);
			}
		}
		$this->lastGridCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Grid object to this object
	 * through the Grid foreign key attribute.
	 *
	 * @param      Grid $l Grid
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addGrid(Grid $l)
	{
		if ($this->collGrids === null) {
			$this->collGrids = array();
		}
		if (!in_array($l, $this->collGrids, true)) { // only add it if the **same** object is not already associated
			array_push($this->collGrids, $l);
			$l->setLayout($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Layout is new, it will return
	 * an empty collection; or if this Layout has previously
	 * been saved, it will retrieve related Grids from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Layout.
	 */
	public function getGridsJoinGridRelatedByGridId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrids === null) {
			if ($this->isNew()) {
				$this->collGrids = array();
			} else {

				$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

				$this->collGrids = GridPeer::doSelectJoinGridRelatedByGridId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GridPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastGridCriteria) || !$this->lastGridCriteria->equals($criteria)) {
				$this->collGrids = GridPeer::doSelectJoinGridRelatedByGridId($criteria, $con);
			}
		}
		$this->lastGridCriteria = $criteria;

		return $this->collGrids;
	}

	/**
	 * Temporary storage of collLayoutGrids to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addLayoutGrids() method.
	 * @see        addLayoutGrids()
	 */
	public function initLayoutGrids()
	{
		if ($this->collLayoutGrids === null) {
			$this->collLayoutGrids = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Layout has previously been saved, it will retrieve
	 * related LayoutGrids from storage. If this Layout is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getLayoutGrids($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLayoutGrids === null) {
			if ($this->isNew()) {
			   $this->collLayoutGrids = array();
			} else {

				$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

				LayoutGridPeer::addSelectColumns($criteria);
				$this->collLayoutGrids = LayoutGridPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

				LayoutGridPeer::addSelectColumns($criteria);
				if (!isset($this->lastLayoutGridCriteria) || !$this->lastLayoutGridCriteria->equals($criteria)) {
					$this->collLayoutGrids = LayoutGridPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLayoutGridCriteria = $criteria;
		return $this->collLayoutGrids;
	}

	/**
	 * Returns the number of related LayoutGrids.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countLayoutGrids(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collLayoutGrids === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

				$count = LayoutGridPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

				if (!isset($this->lastLayoutGridCriteria) || !$this->lastLayoutGridCriteria->equals($criteria)) {
					$count = LayoutGridPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLayoutGrids);
				}
			} else {
				$count = count($this->collLayoutGrids);
			}
		}
		$this->lastLayoutGridCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a LayoutGrid object to this object
	 * through the LayoutGrid foreign key attribute.
	 *
	 * @param      LayoutGrid $l LayoutGrid
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addLayoutGrid(LayoutGrid $l)
	{
		if ($this->collLayoutGrids === null) {
			$this->collLayoutGrids = array();
		}
		if (!in_array($l, $this->collLayoutGrids, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLayoutGrids, $l);
			$l->setLayout($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Layout is new, it will return
	 * an empty collection; or if this Layout has previously
	 * been saved, it will retrieve related LayoutGrids from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Layout.
	 */
	public function getLayoutGridsJoinGrid($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLayoutGrids === null) {
			if ($this->isNew()) {
				$this->collLayoutGrids = array();
			} else {

				$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

				$this->collLayoutGrids = LayoutGridPeer::doSelectJoinGrid($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LayoutGridPeer::LAYOUT_ID, $this->getId());

			if (!isset($this->lastLayoutGridCriteria) || !$this->lastLayoutGridCriteria->equals($criteria)) {
				$this->collLayoutGrids = LayoutGridPeer::doSelectJoinGrid($criteria, $con);
			}
		}
		$this->lastLayoutGridCriteria = $criteria;

		return $this->collLayoutGrids;
	}

} // BaseLayout
