<?php
namespace net::keeko::cms::core::entities::om;

use net::keeko::cms::core::entities::PagePeer;
use net::keeko::cms::core::entities::LanguageTextPeer;
use net::keeko::cms::core::entities::LayoutPeer;
use net::keeko::cms::core::entities::MenuItemPeer;
use net::keeko::cms::core::entities::PagePermissionPeer;
use net::keeko::cms::core::entities::PageCssPeer;
use net::keeko::cms::core::entities::PageJsPeer;



/**
 * Base class that represents a row from the 'page' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BasePage extends ::BaseObject  implements ::Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PagePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;

	/**
	 * The value for the keywords_id field.
	 * @var        int
	 */
	protected $keywords_id;

	/**
	 * The value for the description_id field.
	 * @var        int
	 */
	protected $description_id;

	/**
	 * The value for the title_id field.
	 * @var        int
	 */
	protected $title_id;

	/**
	 * The value for the is_user field.
	 * @var        boolean
	 */
	protected $is_user;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageTextRelatedByTitleId;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageTextRelatedByDescriptionId;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageTextRelatedByKeywordsId;

	/**
	 * @var        Page
	 */
	protected $aPageRelatedByParentId;

	/**
	 * @var        array Page[] Collection to store aggregation of Page objects.
	 */
	protected $collPagesRelatedByParentId;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagesRelatedByParentId.
	 */
	private $lastPageRelatedByParentIdCriteria = null;

	/**
	 * @var        array Layout[] Collection to store aggregation of Layout objects.
	 */
	protected $collLayouts;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collLayouts.
	 */
	private $lastLayoutCriteria = null;

	/**
	 * @var        array MenuItem[] Collection to store aggregation of MenuItem objects.
	 */
	protected $collMenuItems;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collMenuItems.
	 */
	private $lastMenuItemCriteria = null;

	/**
	 * @var        array PagePermission[] Collection to store aggregation of PagePermission objects.
	 */
	protected $collPagePermissions;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPagePermissions.
	 */
	private $lastPagePermissionCriteria = null;

	/**
	 * @var        array PageCss[] Collection to store aggregation of PageCss objects.
	 */
	protected $collPageCsss;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPageCsss.
	 */
	private $lastPageCssCriteria = null;

	/**
	 * @var        array PageJs[] Collection to store aggregation of PageJs objects.
	 */
	protected $collPageJss;

	/**
	 * @var        ::Criteria The criteria used to select the current contents of collPageJss.
	 */
	private $lastPageJsCriteria = null;

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
	 * Initializes internal state of BasePage object.
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
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{
		return $this->parent_id;
	}

	/**
	 * Get the [keywords_id] column value.
	 * 
	 * @return     int
	 */
	public function getKeywordsId()
	{
		return $this->keywords_id;
	}

	/**
	 * Get the [description_id] column value.
	 * 
	 * @return     int
	 */
	public function getDescriptionId()
	{
		return $this->description_id;
	}

	/**
	 * Get the [title_id] column value.
	 * 
	 * @return     int
	 */
	public function getTitleId()
	{
		return $this->title_id;
	}

	/**
	 * Get the [is_user] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsUser()
	{
		return $this->is_user;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PagePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = PagePeer::PARENT_ID;
		}

		if ($this->aPageRelatedByParentId !== null && $this->aPageRelatedByParentId->getId() !== $v) {
			$this->aPageRelatedByParentId = null;
		}

		return $this;
	} // setParentId()

	/**
	 * Set the value of [keywords_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setKeywordsId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->keywords_id !== $v) {
			$this->keywords_id = $v;
			$this->modifiedColumns[] = PagePeer::KEYWORDS_ID;
		}

		if ($this->aLanguageTextRelatedByKeywordsId !== null && $this->aLanguageTextRelatedByKeywordsId->getId() !== $v) {
			$this->aLanguageTextRelatedByKeywordsId = null;
		}

		return $this;
	} // setKeywordsId()

	/**
	 * Set the value of [description_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setDescriptionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->description_id !== $v) {
			$this->description_id = $v;
			$this->modifiedColumns[] = PagePeer::DESCRIPTION_ID;
		}

		if ($this->aLanguageTextRelatedByDescriptionId !== null && $this->aLanguageTextRelatedByDescriptionId->getId() !== $v) {
			$this->aLanguageTextRelatedByDescriptionId = null;
		}

		return $this;
	} // setDescriptionId()

	/**
	 * Set the value of [title_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setTitleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->title_id !== $v) {
			$this->title_id = $v;
			$this->modifiedColumns[] = PagePeer::TITLE_ID;
		}

		if ($this->aLanguageTextRelatedByTitleId !== null && $this->aLanguageTextRelatedByTitleId->getId() !== $v) {
			$this->aLanguageTextRelatedByTitleId = null;
		}

		return $this;
	} // setTitleId()

	/**
	 * Set the value of [is_user] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Page The current object (for fluent API support)
	 */
	public function setIsUser($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_user !== $v) {
			$this->is_user = $v;
			$this->modifiedColumns[] = PagePeer::IS_USER;
		}

		return $this;
	} // setIsUser()

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
			$this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->keywords_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->description_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->title_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->is_user = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = PagePeer::NUM_COLUMNS - PagePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new ::PropelException("Error populating Page object", $e);
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

		if ($this->aPageRelatedByParentId !== null && $this->parent_id !== $this->aPageRelatedByParentId->getId()) {
			$this->aPageRelatedByParentId = null;
		}
	
		if ($this->aLanguageTextRelatedByKeywordsId !== null && $this->keywords_id !== $this->aLanguageTextRelatedByKeywordsId->getId()) {
			$this->aLanguageTextRelatedByKeywordsId = null;
		}
	
		if ($this->aLanguageTextRelatedByDescriptionId !== null && $this->description_id !== $this->aLanguageTextRelatedByDescriptionId->getId()) {
			$this->aLanguageTextRelatedByDescriptionId = null;
		}
	
		if ($this->aLanguageTextRelatedByTitleId !== null && $this->title_id !== $this->aLanguageTextRelatedByTitleId->getId()) {
			$this->aLanguageTextRelatedByTitleId = null;
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
			$con = ::Propel::getConnection(PagePeer::DATABASE_NAME);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if (!$row) {
			throw new ::PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aLanguageTextRelatedByTitleId = null;
			$this->aLanguageTextRelatedByDescriptionId = null;
			$this->aLanguageTextRelatedByKeywordsId = null;
			$this->aPageRelatedByParentId = null;
			$this->collPagesRelatedByParentId = null;
			$this->lastPageRelatedByParentIdCriteria = null;

			$this->collLayouts = null;
			$this->lastLayoutCriteria = null;

			$this->collMenuItems = null;
			$this->lastMenuItemCriteria = null;

			$this->collPagePermissions = null;
			$this->lastPagePermissionCriteria = null;

			$this->collPageCsss = null;
			$this->lastPageCssCriteria = null;

			$this->collPageJss = null;
			$this->lastPageJsCriteria = null;

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
			$con = ::Propel::getConnection(PagePeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			PagePeer::doDelete($this, $con);
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
			$con = ::Propel::getConnection(PagePeer::DATABASE_NAME);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
			PagePeer::addInstanceToPool($this);
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

			if ($this->aLanguageTextRelatedByTitleId !== null) {
				if ($this->aLanguageTextRelatedByTitleId->isModified() || $this->aLanguageTextRelatedByTitleId->isNew()) {
					$affectedRows += $this->aLanguageTextRelatedByTitleId->save($con);
				}
				$this->setLanguageTextRelatedByTitleId($this->aLanguageTextRelatedByTitleId);
			}

			if ($this->aLanguageTextRelatedByDescriptionId !== null) {
				if ($this->aLanguageTextRelatedByDescriptionId->isModified() || $this->aLanguageTextRelatedByDescriptionId->isNew()) {
					$affectedRows += $this->aLanguageTextRelatedByDescriptionId->save($con);
				}
				$this->setLanguageTextRelatedByDescriptionId($this->aLanguageTextRelatedByDescriptionId);
			}

			if ($this->aLanguageTextRelatedByKeywordsId !== null) {
				if ($this->aLanguageTextRelatedByKeywordsId->isModified() || $this->aLanguageTextRelatedByKeywordsId->isNew()) {
					$affectedRows += $this->aLanguageTextRelatedByKeywordsId->save($con);
				}
				$this->setLanguageTextRelatedByKeywordsId($this->aLanguageTextRelatedByKeywordsId);
			}

			if ($this->aPageRelatedByParentId !== null) {
				if ($this->aPageRelatedByParentId->isModified() || $this->aPageRelatedByParentId->isNew()) {
					$affectedRows += $this->aPageRelatedByParentId->save($con);
				}
				$this->setPageRelatedByParentId($this->aPageRelatedByParentId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PagePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // ::BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PagePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPagesRelatedByParentId !== null) {
				foreach ($this->collPagesRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLayouts !== null) {
				foreach ($this->collLayouts as $referrerFK) {
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

			if ($this->collPagePermissions !== null) {
				foreach ($this->collPagePermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPageCsss !== null) {
				foreach ($this->collPageCsss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPageJss !== null) {
				foreach ($this->collPageJss as $referrerFK) {
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

			if ($this->aLanguageTextRelatedByTitleId !== null) {
				if (!$this->aLanguageTextRelatedByTitleId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageTextRelatedByTitleId->getValidationFailures());
				}
			}

			if ($this->aLanguageTextRelatedByDescriptionId !== null) {
				if (!$this->aLanguageTextRelatedByDescriptionId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageTextRelatedByDescriptionId->getValidationFailures());
				}
			}

			if ($this->aLanguageTextRelatedByKeywordsId !== null) {
				if (!$this->aLanguageTextRelatedByKeywordsId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageTextRelatedByKeywordsId->getValidationFailures());
				}
			}

			if ($this->aPageRelatedByParentId !== null) {
				if (!$this->aPageRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPageRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = PagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPagesRelatedByParentId !== null) {
					foreach ($this->collPagesRelatedByParentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLayouts !== null) {
					foreach ($this->collLayouts as $referrerFK) {
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

				if ($this->collPagePermissions !== null) {
					foreach ($this->collPagePermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPageCsss !== null) {
					foreach ($this->collPageCsss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPageJss !== null) {
					foreach ($this->collPageJss as $referrerFK) {
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
		$pos = PagePeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				return $this->getParentId();
				break;
			case 2:
				return $this->getKeywordsId();
				break;
			case 3:
				return $this->getDescriptionId();
				break;
			case 4:
				return $this->getTitleId();
				break;
			case 5:
				return $this->getIsUser();
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
		$keys = PagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getKeywordsId(),
			$keys[3] => $this->getDescriptionId(),
			$keys[4] => $this->getTitleId(),
			$keys[5] => $this->getIsUser(),
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
		$pos = PagePeer::translateFieldName($name, $type, ::BasePeer::TYPE_NUM);
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
				$this->setParentId($value);
				break;
			case 2:
				$this->setKeywordsId($value);
				break;
			case 3:
				$this->setDescriptionId($value);
				break;
			case 4:
				$this->setTitleId($value);
				break;
			case 5:
				$this->setIsUser($value);
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
		$keys = PagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKeywordsId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescriptionId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitleId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsUser($arr[$keys[5]]);
	}

	/**
	 * Build a ::Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     ::Criteria The ::Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new ::Criteria(PagePeer::DATABASE_NAME);

		if ($this->isColumnModified(PagePeer::ID)) $criteria->add(PagePeer::ID, $this->id);
		if ($this->isColumnModified(PagePeer::PARENT_ID)) $criteria->add(PagePeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(PagePeer::KEYWORDS_ID)) $criteria->add(PagePeer::KEYWORDS_ID, $this->keywords_id);
		if ($this->isColumnModified(PagePeer::DESCRIPTION_ID)) $criteria->add(PagePeer::DESCRIPTION_ID, $this->description_id);
		if ($this->isColumnModified(PagePeer::TITLE_ID)) $criteria->add(PagePeer::TITLE_ID, $this->title_id);
		if ($this->isColumnModified(PagePeer::IS_USER)) $criteria->add(PagePeer::IS_USER, $this->is_user);

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
		$criteria = new ::Criteria(PagePeer::DATABASE_NAME);

		$criteria->add(PagePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Page (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     ::PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParentId($this->parent_id);

		$copyObj->setKeywordsId($this->keywords_id);

		$copyObj->setDescriptionId($this->description_id);

		$copyObj->setTitleId($this->title_id);

		$copyObj->setIsUser($this->is_user);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPagesRelatedByParentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageRelatedByParentId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLayouts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLayout($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMenuItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMenuItem($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPagePermissions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPagePermission($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPageCsss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageCss($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPageJss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPageJs($relObj->copy($deepCopy));
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
	 * @return     Page Clone of current object.
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
	 * @return     PagePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PagePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a LanguageText object.
	 *
	 * @param      LanguageText $v
	 * @return     Page The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setLanguageTextRelatedByTitleId(LanguageText $v = null)
	{
		if ($v === null) {
			$this->setTitleId(NULL);
		} else {
			$this->setTitleId($v->getId());
		}

		$this->aLanguageTextRelatedByTitleId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addPageRelatedByTitleId($this);
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
	public function getLanguageTextRelatedByTitleId(::PropelPDO $con = null)
	{
		if ($this->aLanguageTextRelatedByTitleId === null && ($this->title_id !== null)) {
			$this->aLanguageTextRelatedByTitleId = LanguageTextPeer::retrieveByPK($this->title_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageTextRelatedByTitleId->addPagesRelatedByTitleId($this);
			 */
		}
		return $this->aLanguageTextRelatedByTitleId;
	}

	/**
	 * Declares an association between this object and a LanguageText object.
	 *
	 * @param      LanguageText $v
	 * @return     Page The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setLanguageTextRelatedByDescriptionId(LanguageText $v = null)
	{
		if ($v === null) {
			$this->setDescriptionId(NULL);
		} else {
			$this->setDescriptionId($v->getId());
		}

		$this->aLanguageTextRelatedByDescriptionId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addPageRelatedByDescriptionId($this);
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
	public function getLanguageTextRelatedByDescriptionId(::PropelPDO $con = null)
	{
		if ($this->aLanguageTextRelatedByDescriptionId === null && ($this->description_id !== null)) {
			$this->aLanguageTextRelatedByDescriptionId = LanguageTextPeer::retrieveByPK($this->description_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageTextRelatedByDescriptionId->addPagesRelatedByDescriptionId($this);
			 */
		}
		return $this->aLanguageTextRelatedByDescriptionId;
	}

	/**
	 * Declares an association between this object and a LanguageText object.
	 *
	 * @param      LanguageText $v
	 * @return     Page The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setLanguageTextRelatedByKeywordsId(LanguageText $v = null)
	{
		if ($v === null) {
			$this->setKeywordsId(NULL);
		} else {
			$this->setKeywordsId($v->getId());
		}

		$this->aLanguageTextRelatedByKeywordsId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addPageRelatedByKeywordsId($this);
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
	public function getLanguageTextRelatedByKeywordsId(::PropelPDO $con = null)
	{
		if ($this->aLanguageTextRelatedByKeywordsId === null && ($this->keywords_id !== null)) {
			$this->aLanguageTextRelatedByKeywordsId = LanguageTextPeer::retrieveByPK($this->keywords_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageTextRelatedByKeywordsId->addPagesRelatedByKeywordsId($this);
			 */
		}
		return $this->aLanguageTextRelatedByKeywordsId;
	}

	/**
	 * Declares an association between this object and a Page object.
	 *
	 * @param      Page $v
	 * @return     Page The current object (for fluent API support)
	 * @throws     ::PropelException
	 */
	public function setPageRelatedByParentId(Page $v = null)
	{
		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}

		$this->aPageRelatedByParentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Page object, it will not be re-added.
		if ($v !== null) {
			$v->addPageRelatedByParentId($this);
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
	public function getPageRelatedByParentId(::PropelPDO $con = null)
	{
		if ($this->aPageRelatedByParentId === null && ($this->parent_id !== null)) {
			$this->aPageRelatedByParentId = PagePeer::retrieveByPK($this->parent_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPageRelatedByParentId->addPagesRelatedByParentId($this);
			 */
		}
		return $this->aPageRelatedByParentId;
	}

	/**
	 * Temporary storage of collPagesRelatedByParentId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPagesRelatedByParentId() method.
	 * @see        addPagesRelatedByParentId()
	 */
	public function initPagesRelatedByParentId()
	{
		if ($this->collPagesRelatedByParentId === null) {
			$this->collPagesRelatedByParentId = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related PagesRelatedByParentId from storage. If this Page is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPagesRelatedByParentId($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collPagesRelatedByParentId = array();
			} else {

				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				$this->collPagesRelatedByParentId = PagePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				PagePeer::addSelectColumns($criteria);
				if (!isset($this->lastPageRelatedByParentIdCriteria) || !$this->lastPageRelatedByParentIdCriteria->equals($criteria)) {
					$this->collPagesRelatedByParentId = PagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageRelatedByParentIdCriteria = $criteria;
		return $this->collPagesRelatedByParentId;
	}

	/**
	 * Returns the number of related PagesRelatedByParentId.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPagesRelatedByParentId(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPagesRelatedByParentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				$count = PagePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				if (!isset($this->lastPageRelatedByParentIdCriteria) || !$this->lastPageRelatedByParentIdCriteria->equals($criteria)) {
					$count = PagePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPagesRelatedByParentId);
				}
			} else {
				$count = count($this->collPagesRelatedByParentId);
			}
		}
		$this->lastPageRelatedByParentIdCriteria = $criteria;
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
	public function addPageRelatedByParentId(Page $l)
	{
		if ($this->collPagesRelatedByParentId === null) {
			$this->collPagesRelatedByParentId = array();
		}
		if (!in_array($l, $this->collPagesRelatedByParentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPagesRelatedByParentId, $l);
			$l->setPageRelatedByParentId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related PagesRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
	 */
	public function getPagesRelatedByParentIdJoinLanguageTextRelatedByTitleId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByParentId = array();
			} else {

				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByTitleId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::PARENT_ID, $this->getId());

			if (!isset($this->lastPageRelatedByParentIdCriteria) || !$this->lastPageRelatedByParentIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByTitleId($criteria, $con);
			}
		}
		$this->lastPageRelatedByParentIdCriteria = $criteria;

		return $this->collPagesRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related PagesRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
	 */
	public function getPagesRelatedByParentIdJoinLanguageTextRelatedByDescriptionId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByParentId = array();
			} else {

				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByDescriptionId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::PARENT_ID, $this->getId());

			if (!isset($this->lastPageRelatedByParentIdCriteria) || !$this->lastPageRelatedByParentIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByDescriptionId($criteria, $con);
			}
		}
		$this->lastPageRelatedByParentIdCriteria = $criteria;

		return $this->collPagesRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related PagesRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
	 */
	public function getPagesRelatedByParentIdJoinLanguageTextRelatedByKeywordsId($criteria = null, $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPagesRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collPagesRelatedByParentId = array();
			} else {

				$criteria->add(PagePeer::PARENT_ID, $this->getId());

				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByKeywordsId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePeer::PARENT_ID, $this->getId());

			if (!isset($this->lastPageRelatedByParentIdCriteria) || !$this->lastPageRelatedByParentIdCriteria->equals($criteria)) {
				$this->collPagesRelatedByParentId = PagePeer::doSelectJoinLanguageTextRelatedByKeywordsId($criteria, $con);
			}
		}
		$this->lastPageRelatedByParentIdCriteria = $criteria;

		return $this->collPagesRelatedByParentId;
	}

	/**
	 * Temporary storage of collLayouts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addLayouts() method.
	 * @see        addLayouts()
	 */
	public function initLayouts()
	{
		if ($this->collLayouts === null) {
			$this->collLayouts = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related Layouts from storage. If this Page is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getLayouts($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLayouts === null) {
			if ($this->isNew()) {
			   $this->collLayouts = array();
			} else {

				$criteria->add(LayoutPeer::PAGE_ID, $this->getId());

				LayoutPeer::addSelectColumns($criteria);
				$this->collLayouts = LayoutPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LayoutPeer::PAGE_ID, $this->getId());

				LayoutPeer::addSelectColumns($criteria);
				if (!isset($this->lastLayoutCriteria) || !$this->lastLayoutCriteria->equals($criteria)) {
					$this->collLayouts = LayoutPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLayoutCriteria = $criteria;
		return $this->collLayouts;
	}

	/**
	 * Returns the number of related Layouts.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countLayouts(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collLayouts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(LayoutPeer::PAGE_ID, $this->getId());

				$count = LayoutPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(LayoutPeer::PAGE_ID, $this->getId());

				if (!isset($this->lastLayoutCriteria) || !$this->lastLayoutCriteria->equals($criteria)) {
					$count = LayoutPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collLayouts);
				}
			} else {
				$count = count($this->collLayouts);
			}
		}
		$this->lastLayoutCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Layout object to this object
	 * through the Layout foreign key attribute.
	 *
	 * @param      Layout $l Layout
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addLayout(Layout $l)
	{
		if ($this->collLayouts === null) {
			$this->collLayouts = array();
		}
		if (!in_array($l, $this->collLayouts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collLayouts, $l);
			$l->setPage($this);
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
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related MenuItems from storage. If this Page is new, it will return
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				MenuItemPeer::addSelectColumns($criteria);
				$this->collMenuItems = MenuItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$count = MenuItemPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

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
			$l->setPage($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
	 */
	public function getMenuItemsJoinLanguageText($criteria = null, $con = null)
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinLanguageText($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinLanguageText($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinMenu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

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
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinMenuItemRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

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
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinModule($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

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
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related MenuItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
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

				$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

				$this->collMenuItems = MenuItemPeer::doSelectJoinAction($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MenuItemPeer::PAGE_ID, $this->getId());

			if (!isset($this->lastMenuItemCriteria) || !$this->lastMenuItemCriteria->equals($criteria)) {
				$this->collMenuItems = MenuItemPeer::doSelectJoinAction($criteria, $con);
			}
		}
		$this->lastMenuItemCriteria = $criteria;

		return $this->collMenuItems;
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
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related PagePermissions from storage. If this Page is new, it will return
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

				$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

				PagePermissionPeer::addSelectColumns($criteria);
				$this->collPagePermissions = PagePermissionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

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

				$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

				$count = PagePermissionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

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
			$l->setPage($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Page is new, it will return
	 * an empty collection; or if this Page has previously
	 * been saved, it will retrieve related PagePermissions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Page.
	 */
	public function getPagePermissionsJoinRole($criteria = null, $con = null)
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

				$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

				$this->collPagePermissions = PagePermissionPeer::doSelectJoinRole($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PagePermissionPeer::PAGE_ID, $this->getId());

			if (!isset($this->lastPagePermissionCriteria) || !$this->lastPagePermissionCriteria->equals($criteria)) {
				$this->collPagePermissions = PagePermissionPeer::doSelectJoinRole($criteria, $con);
			}
		}
		$this->lastPagePermissionCriteria = $criteria;

		return $this->collPagePermissions;
	}

	/**
	 * Temporary storage of collPageCsss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPageCsss() method.
	 * @see        addPageCsss()
	 */
	public function initPageCsss()
	{
		if ($this->collPageCsss === null) {
			$this->collPageCsss = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related PageCsss from storage. If this Page is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPageCsss($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPageCsss === null) {
			if ($this->isNew()) {
			   $this->collPageCsss = array();
			} else {

				$criteria->add(PageCssPeer::PAGE_ID, $this->getId());

				PageCssPeer::addSelectColumns($criteria);
				$this->collPageCsss = PageCssPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PageCssPeer::PAGE_ID, $this->getId());

				PageCssPeer::addSelectColumns($criteria);
				if (!isset($this->lastPageCssCriteria) || !$this->lastPageCssCriteria->equals($criteria)) {
					$this->collPageCsss = PageCssPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageCssCriteria = $criteria;
		return $this->collPageCsss;
	}

	/**
	 * Returns the number of related PageCsss.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPageCsss(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPageCsss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PageCssPeer::PAGE_ID, $this->getId());

				$count = PageCssPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PageCssPeer::PAGE_ID, $this->getId());

				if (!isset($this->lastPageCssCriteria) || !$this->lastPageCssCriteria->equals($criteria)) {
					$count = PageCssPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPageCsss);
				}
			} else {
				$count = count($this->collPageCsss);
			}
		}
		$this->lastPageCssCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PageCss object to this object
	 * through the PageCss foreign key attribute.
	 *
	 * @param      PageCss $l PageCss
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPageCss(PageCss $l)
	{
		if ($this->collPageCsss === null) {
			$this->collPageCsss = array();
		}
		if (!in_array($l, $this->collPageCsss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPageCsss, $l);
			$l->setPage($this);
		}
	}

	/**
	 * Temporary storage of collPageJss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 *
	 * @return     void
	 * @deprecated - This method will be removed in 2.0 since arrays
	 *				are automatically initialized in the addPageJss() method.
	 * @see        addPageJss()
	 */
	public function initPageJss()
	{
		if ($this->collPageJss === null) {
			$this->collPageJss = array();
		}
	}

	/**
	 * Gets an array of  objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical ::Criteria, it returns the collection.
	 * Otherwise if this Page has previously been saved, it will retrieve
	 * related PageJss from storage. If this Page is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      ::PropelPDO $con
	 * @param      ::Criteria $criteria
	 * @return     array []
	 * @throws     ::PropelException
	 */
	public function getPageJss($criteria = null, ::PropelPDO $con = null)
	{
		
		if ($criteria === null) {
			$criteria = new ::Criteria();
		}
		elseif ($criteria instanceof ::Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPageJss === null) {
			if ($this->isNew()) {
			   $this->collPageJss = array();
			} else {

				$criteria->add(PageJsPeer::PAGE_ID, $this->getId());

				PageJsPeer::addSelectColumns($criteria);
				$this->collPageJss = PageJsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PageJsPeer::PAGE_ID, $this->getId());

				PageJsPeer::addSelectColumns($criteria);
				if (!isset($this->lastPageJsCriteria) || !$this->lastPageJsCriteria->equals($criteria)) {
					$this->collPageJss = PageJsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPageJsCriteria = $criteria;
		return $this->collPageJss;
	}

	/**
	 * Returns the number of related PageJss.
	 *
	 * @param      ::Criteria $criteria
	 * @param      boolean $distinct
	 * @param      ::PropelPDO $con
	 * @throws     ::PropelException
	 */
	public function countPageJss(::Criteria $criteria = null, $distinct = false, ::PropelPDO $con = null)
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

		if ($this->collPageJss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PageJsPeer::PAGE_ID, $this->getId());

				$count = PageJsPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PageJsPeer::PAGE_ID, $this->getId());

				if (!isset($this->lastPageJsCriteria) || !$this->lastPageJsCriteria->equals($criteria)) {
					$count = PageJsPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPageJss);
				}
			} else {
				$count = count($this->collPageJss);
			}
		}
		$this->lastPageJsCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PageJs object to this object
	 * through the PageJs foreign key attribute.
	 *
	 * @param      PageJs $l PageJs
	 * @return     void
	 * @throws     ::PropelException
	 */
	public function addPageJs(PageJs $l)
	{
		if ($this->collPageJss === null) {
			$this->collPageJss = array();
		}
		if (!in_array($l, $this->collPageJss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPageJss, $l);
			$l->setPage($this);
		}
	}

} // BasePage
