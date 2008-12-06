<?php

namespace net\keeko\cms\core\entities\base;

/**
 * Base class that represents a row from the 'menu_item' table.
 *
 * 
 *
 * @package    net.keeko.cms.core.entities.om
 */
abstract class BaseMenuItem extends \BaseObject  implements \Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        \net\keeko\cms\core\entities\peer\MenuItemPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the parent_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $parent_id;

	/**
	 * The value for the menu_id field.
	 * @var        int
	 */
	protected $menu_id;

	/**
	 * The value for the text_id field.
	 * @var        int
	 */
	protected $text_id;

	/**
	 * The value for the page_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $page_id;

	/**
	 * The value for the module_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $module_id;

	/**
	 * The value for the action_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $action_id;

	/**
	 * The value for the event field.
	 * @var        int
	 */
	protected $event;

	/**
	 * The value for the image field.
	 * @var        string
	 */
	protected $image;

	/**
	 * The value for the sortorder field.
	 * @var        int
	 */
	protected $sortorder;

	/**
	 * The value for the extra field.
	 * @var        string
	 */
	protected $extra;

	/**
	 * @var        Page
	 */
	protected $aPage;

	/**
	 * @var        LanguageText
	 */
	protected $aLanguageText;

	/**
	 * @var        Menu
	 */
	protected $aMenu;

	/**
	 * @var        MenuItem
	 */
	protected $aMenuItemRelatedByParentId;

	/**
	 * @var        Module
	 */
	protected $aModule;

	/**
	 * @var        Action
	 */
	protected $aAction;

	/**
	 * @var        array net\keeko\cms\core\entities\MenuItem[] Collection to store aggregation of net\keeko\cms\core\entities\MenuItem objects.
	 */
	protected $collMenuItemsRelatedByParentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collMenuItemsRelatedByParentId.
	 */
	private $lastMenuItemRelatedByParentIdCriteria = null;

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
	 * Initializes internal state of net\keeko\cms\core\entities\base\BaseMenuItem object.
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
		$this->parent_id = 0;
		$this->page_id = 0;
		$this->module_id = 0;
		$this->action_id = 0;
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
	 * Get the [menu_id] column value.
	 * 
	 * @return     int
	 */
	public function getMenuId()
	{
		return $this->menu_id;
	}

	/**
	 * Get the [text_id] column value.
	 * 
	 * @return     int
	 */
	public function getTextId()
	{
		return $this->text_id;
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
	 * Get the [module_id] column value.
	 * 
	 * @return     int
	 */
	public function getModuleId()
	{
		return $this->module_id;
	}

	/**
	 * Get the [action_id] column value.
	 * 
	 * @return     int
	 */
	public function getActionId()
	{
		return $this->action_id;
	}

	/**
	 * Get the [event] column value.
	 * 
	 * @return     int
	 */
	public function getEvent()
	{
		return $this->event;
	}

	/**
	 * Get the [image] column value.
	 * 
	 * @return     string
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Get the [sortorder] column value.
	 * 
	 * @return     int
	 */
	public function getSortorder()
	{
		return $this->sortorder;
	}

	/**
	 * Get the [extra] column value.
	 * 
	 * @return     string
	 */
	public function getExtra()
	{
		return $this->extra;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v || $v === 0) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID;
		}

		if ($this->aMenuItemRelatedByParentId !== null && $this->aMenuItemRelatedByParentId->getId() !== $v) {
			$this->aMenuItemRelatedByParentId = null;
		}

		return $this;
	} // setParentId()

	/**
	 * Set the value of [menu_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setMenuId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->menu_id !== $v) {
			$this->menu_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::MENU_ID;
		}

		if ($this->aMenu !== null && $this->aMenu->getId() !== $v) {
			$this->aMenu = null;
		}

		return $this;
	} // setMenuId()

	/**
	 * Set the value of [text_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setTextId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->text_id !== $v) {
			$this->text_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID;
		}

		if ($this->aLanguageText !== null && $this->aLanguageText->getId() !== $v) {
			$this->aLanguageText = null;
		}

		return $this;
	} // setTextId()

	/**
	 * Set the value of [page_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setPageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->page_id !== $v || $v === 0) {
			$this->page_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::PAGE_ID;
		}

		if ($this->aPage !== null && $this->aPage->getId() !== $v) {
			$this->aPage = null;
		}

		return $this;
	} // setPageId()

	/**
	 * Set the value of [module_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setModuleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->module_id !== $v || $v === 0) {
			$this->module_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::MODULE_ID;
		}

		if ($this->aModule !== null && $this->aModule->getId() !== $v) {
			$this->aModule = null;
		}

		return $this;
	} // setModuleId()

	/**
	 * Set the value of [action_id] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setActionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->action_id !== $v || $v === 0) {
			$this->action_id = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID;
		}

		if ($this->aAction !== null && $this->aAction->getId() !== $v) {
			$this->aAction = null;
		}

		return $this;
	} // setActionId()

	/**
	 * Set the value of [event] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setEvent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event !== $v) {
			$this->event = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::EVENT;
		}

		return $this;
	} // setEvent()

	/**
	 * Set the value of [image] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image !== $v) {
			$this->image = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::IMAGE;
		}

		return $this;
	} // setImage()

	/**
	 * Set the value of [sortorder] column.
	 * 
	 * @param      int $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setSortorder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sortorder !== $v) {
			$this->sortorder = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::SORTORDER;
		}

		return $this;
	} // setSortorder()

	/**
	 * Set the value of [extra] column.
	 * 
	 * @param      string $v new value
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 */
	public function setExtra($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->extra !== $v) {
			$this->extra = $v;
			$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::EXTRA;
		}

		return $this;
	} // setExtra()

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
			if (array_diff($this->modifiedColumns, array(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID,\net\keeko\cms\core\entities\peer\MenuItemPeer::PAGE_ID,\net\keeko\cms\core\entities\peer\MenuItemPeer::MODULE_ID,\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID))) {
				return false;
			}

			if ($this->parent_id !== 0) {
				return false;
			}

			if ($this->page_id !== 0) {
				return false;
			}

			if ($this->module_id !== 0) {
				return false;
			}

			if ($this->action_id !== 0) {
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
			$this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->menu_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->text_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->page_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->module_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->action_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->event = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->image = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->sortorder = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->extra = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = \net\keeko\cms\core\entities\peer\MenuItemPeer::NUM_COLUMNS - \net\keeko\cms\core\entities\peer\MenuItemPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new \PropelException("Error populating MenuItem object", $e);
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

		if ($this->aMenuItemRelatedByParentId !== null && $this->parent_id !== $this->aMenuItemRelatedByParentId->getId()) {
			$this->aMenuItemRelatedByParentId = null;
		}
		if ($this->aMenu !== null && $this->menu_id !== $this->aMenu->getId()) {
			$this->aMenu = null;
		}
		if ($this->aLanguageText !== null && $this->text_id !== $this->aLanguageText->getId()) {
			$this->aLanguageText = null;
		}
		if ($this->aPage !== null && $this->page_id !== $this->aPage->getId()) {
			$this->aPage = null;
		}
		if ($this->aModule !== null && $this->module_id !== $this->aModule->getId()) {
			$this->aModule = null;
		}
		if ($this->aAction !== null && $this->action_id !== $this->aAction->getId()) {
			$this->aAction = null;
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME, \Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(\PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new \PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPage = null;
			$this->aLanguageText = null;
			$this->aMenu = null;
			$this->aMenuItemRelatedByParentId = null;
			$this->aModule = null;
			$this->aAction = null;
			$this->collMenuItemsRelatedByParentId = null;
			$this->lastMenuItemRelatedByParentIdCriteria = null;

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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			\net\keeko\cms\core\entities\peer\MenuItemPeer::doDelete($this, $con);
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
			$con = \Propel::getConnection(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME, \Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			\net\keeko\cms\core\entities\peer\MenuItemPeer::addInstanceToPool($this);
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

			if ($this->aPage !== null) {
				if ($this->aPage->isModified() || $this->aPage->isNew()) {
					$affectedRows += $this->aPage->save($con);
				}
				$this->setPage($this->aPage);
			}

			if ($this->aLanguageText !== null) {
				if ($this->aLanguageText->isModified() || $this->aLanguageText->isNew()) {
					$affectedRows += $this->aLanguageText->save($con);
				}
				$this->setLanguageText($this->aLanguageText);
			}

			if ($this->aMenu !== null) {
				if ($this->aMenu->isModified() || $this->aMenu->isNew()) {
					$affectedRows += $this->aMenu->save($con);
				}
				$this->setMenu($this->aMenu);
			}

			if ($this->aMenuItemRelatedByParentId !== null) {
				if ($this->aMenuItemRelatedByParentId->isModified() || $this->aMenuItemRelatedByParentId->isNew()) {
					$affectedRows += $this->aMenuItemRelatedByParentId->save($con);
				}
				$this->setMenuItemRelatedByParentId($this->aMenuItemRelatedByParentId);
			}

			if ($this->aModule !== null) {
				if ($this->aModule->isModified() || $this->aModule->isNew()) {
					$affectedRows += $this->aModule->save($con);
				}
				$this->setModule($this->aModule);
			}

			if ($this->aAction !== null) {
				if ($this->aAction->isModified() || $this->aAction->isNew()) {
					$affectedRows += $this->aAction->save($con);
				}
				$this->setAction($this->aAction);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = \net\keeko\cms\core\entities\peer\MenuItemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = \net\keeko\cms\core\entities\peer\MenuItemPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += \net\keeko\cms\core\entities\peer\MenuItemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collMenuItemsRelatedByParentId !== null) {
				foreach ($this->collMenuItemsRelatedByParentId as $referrerFK) {
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

			if ($this->aLanguageText !== null) {
				if (!$this->aLanguageText->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguageText->getValidationFailures());
				}
			}

			if ($this->aMenu !== null) {
				if (!$this->aMenu->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMenu->getValidationFailures());
				}
			}

			if ($this->aMenuItemRelatedByParentId !== null) {
				if (!$this->aMenuItemRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMenuItemRelatedByParentId->getValidationFailures());
				}
			}

			if ($this->aModule !== null) {
				if (!$this->aModule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModule->getValidationFailures());
				}
			}

			if ($this->aAction !== null) {
				if (!$this->aAction->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAction->getValidationFailures());
				}
			}


			if (($retval = \net\keeko\cms\core\entities\peer\MenuItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMenuItemsRelatedByParentId !== null) {
					foreach ($this->collMenuItemsRelatedByParentId as $referrerFK) {
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
		$pos = \net\keeko\cms\core\entities\peer\MenuItemPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				return $this->getParentId();
				break;
			case 2:
				return $this->getMenuId();
				break;
			case 3:
				return $this->getTextId();
				break;
			case 4:
				return $this->getPageId();
				break;
			case 5:
				return $this->getModuleId();
				break;
			case 6:
				return $this->getActionId();
				break;
			case 7:
				return $this->getEvent();
				break;
			case 8:
				return $this->getImage();
				break;
			case 9:
				return $this->getSortorder();
				break;
			case 10:
				return $this->getExtra();
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
		$keys = \net\keeko\cms\core\entities\peer\MenuItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getMenuId(),
			$keys[3] => $this->getTextId(),
			$keys[4] => $this->getPageId(),
			$keys[5] => $this->getModuleId(),
			$keys[6] => $this->getActionId(),
			$keys[7] => $this->getEvent(),
			$keys[8] => $this->getImage(),
			$keys[9] => $this->getSortorder(),
			$keys[10] => $this->getExtra(),
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
		$pos = \net\keeko\cms\core\entities\peer\MenuItemPeer::translateFieldName($name, $type, \BasePeer::TYPE_NUM);
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
				$this->setMenuId($value);
				break;
			case 3:
				$this->setTextId($value);
				break;
			case 4:
				$this->setPageId($value);
				break;
			case 5:
				$this->setModuleId($value);
				break;
			case 6:
				$this->setActionId($value);
				break;
			case 7:
				$this->setEvent($value);
				break;
			case 8:
				$this->setImage($value);
				break;
			case 9:
				$this->setSortorder($value);
				break;
			case 10:
				$this->setExtra($value);
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
		$keys = \net\keeko\cms\core\entities\peer\MenuItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMenuId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTextId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPageId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setModuleId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setActionId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEvent($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setImage($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSortorder($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setExtra($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ID, $this->id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::MENU_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::MENU_ID, $this->menu_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::TEXT_ID, $this->text_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::PAGE_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PAGE_ID, $this->page_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::MODULE_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::MODULE_ID, $this->module_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ACTION_ID, $this->action_id);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::EVENT)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::EVENT, $this->event);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::IMAGE)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::IMAGE, $this->image);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::SORTORDER)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::SORTORDER, $this->sortorder);
		if ($this->isColumnModified(\net\keeko\cms\core\entities\peer\MenuItemPeer::EXTRA)) $criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::EXTRA, $this->extra);

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
		$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);

		$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of net\keeko\cms\core\entities\MenuItem (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParentId($this->parent_id);

		$copyObj->setMenuId($this->menu_id);

		$copyObj->setTextId($this->text_id);

		$copyObj->setPageId($this->page_id);

		$copyObj->setModuleId($this->module_id);

		$copyObj->setActionId($this->action_id);

		$copyObj->setEvent($this->event);

		$copyObj->setImage($this->image);

		$copyObj->setSortorder($this->sortorder);

		$copyObj->setExtra($this->extra);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getMenuItemsRelatedByParentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMenuItemRelatedByParentId($relObj->copy($deepCopy));
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
	 * @return     net\keeko\cms\core\entities\MenuItem Clone of current object.
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
	 * @return     \net\keeko\cms\core\entities\peer\MenuItemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new \net\keeko\cms\core\entities\peer\MenuItemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Page object.
	 *
	 * @param      net\keeko\cms\core\entities\Page $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPage(net\keeko\cms\core\entities\Page $v = null)
	{
		if ($v === null) {
			$this->setPageId(0);
		} else {
			$this->setPageId($v->getId());
		}

		$this->aPage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Page object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItem($this);
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
			   $this->aPage->addMenuItems($this);
			 */
		}
		return $this->aPage;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\LanguageText object.
	 *
	 * @param      net\keeko\cms\core\entities\LanguageText $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setLanguageText(net\keeko\cms\core\entities\LanguageText $v = null)
	{
		if ($v === null) {
			$this->setTextId(NULL);
		} else {
			$this->setTextId($v->getId());
		}

		$this->aLanguageText = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\LanguageText object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItem($this);
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
		if ($this->aLanguageText === null && ($this->text_id !== null)) {
			$this->aLanguageText = \net\keeko\cms\core\entities\peer\LanguageTextPeer::retrieveByPK($this->text_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aLanguageText->addMenuItems($this);
			 */
		}
		return $this->aLanguageText;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Menu object.
	 *
	 * @param      net\keeko\cms\core\entities\Menu $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMenu(net\keeko\cms\core\entities\Menu $v = null)
	{
		if ($v === null) {
			$this->setMenuId(NULL);
		} else {
			$this->setMenuId($v->getId());
		}

		$this->aMenu = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Menu object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Menu object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Menu The associated net\keeko\cms\core\entities\Menu object.
	 * @throws     PropelException
	 */
	public function getMenu(\PropelPDO $con = null)
	{
		if ($this->aMenu === null && ($this->menu_id !== null)) {
			$this->aMenu = \net\keeko\cms\core\entities\peer\MenuPeer::retrieveByPK($this->menu_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMenu->addMenuItems($this);
			 */
		}
		return $this->aMenu;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\MenuItem object.
	 *
	 * @param      net\keeko\cms\core\entities\MenuItem $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMenuItemRelatedByParentId(net\keeko\cms\core\entities\MenuItem $v = null)
	{
		if ($v === null) {
			$this->setParentId(0);
		} else {
			$this->setParentId($v->getId());
		}

		$this->aMenuItemRelatedByParentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\MenuItem object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItemRelatedByParentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\MenuItem object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\MenuItem The associated net\keeko\cms\core\entities\MenuItem object.
	 * @throws     PropelException
	 */
	public function getMenuItemRelatedByParentId(\PropelPDO $con = null)
	{
		if ($this->aMenuItemRelatedByParentId === null && ($this->parent_id !== null)) {
			$this->aMenuItemRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::retrieveByPK($this->parent_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMenuItemRelatedByParentId->addMenuItemsRelatedByParentId($this);
			 */
		}
		return $this->aMenuItemRelatedByParentId;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Module object.
	 *
	 * @param      net\keeko\cms\core\entities\Module $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setModule(net\keeko\cms\core\entities\Module $v = null)
	{
		if ($v === null) {
			$this->setModuleId(0);
		} else {
			$this->setModuleId($v->getId());
		}

		$this->aModule = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Module object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItem($this);
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
			   $this->aModule->addMenuItems($this);
			 */
		}
		return $this->aModule;
	}

	/**
	 * Declares an association between this object and a net\keeko\cms\core\entities\Action object.
	 *
	 * @param      net\keeko\cms\core\entities\Action $v
	 * @return     net\keeko\cms\core\entities\MenuItem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAction(net\keeko\cms\core\entities\Action $v = null)
	{
		if ($v === null) {
			$this->setActionId(0);
		} else {
			$this->setActionId($v->getId());
		}

		$this->aAction = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the net\keeko\cms\core\entities\Action object, it will not be re-added.
		if ($v !== null) {
			$v->addMenuItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated net\keeko\cms\core\entities\Action object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     net\keeko\cms\core\entities\Action The associated net\keeko\cms\core\entities\Action object.
	 * @throws     PropelException
	 */
	public function getAction(\PropelPDO $con = null)
	{
		if ($this->aAction === null && ($this->action_id !== null)) {
			$this->aAction = \net\keeko\cms\core\entities\peer\ActionPeer::retrieveByPK($this->action_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAction->addMenuItems($this);
			 */
		}
		return $this->aAction;
	}

	/**
	 * Clears out the collMenuItemsRelatedByParentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMenuItemsRelatedByParentId()
	 */
	public function clearMenuItemsRelatedByParentId()
	{
		$this->collMenuItemsRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMenuItemsRelatedByParentId collection (array).
	 *
	 * By default this just sets the collMenuItemsRelatedByParentId collection to an empty array (like clearcollMenuItemsRelatedByParentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initMenuItemsRelatedByParentId()
	{
		$this->collMenuItemsRelatedByParentId = array();
	}

	/**
	 * Gets an array of net\keeko\cms\core\entities\MenuItem objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this net\keeko\cms\core\entities\MenuItem has previously been saved, it will retrieve
	 * related MenuItemsRelatedByParentId from storage. If this net\keeko\cms\core\entities\MenuItem is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array net\keeko\cms\core\entities\MenuItem[]
	 * @throws     PropelException
	 */
	public function getMenuItemsRelatedByParentId($criteria = null, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				\net\keeko\cms\core\entities\peer\MenuItemPeer::addSelectColumns($criteria);
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				\net\keeko\cms\core\entities\peer\MenuItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
					$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;
		return $this->collMenuItemsRelatedByParentId;
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
	public function countMenuItemsRelatedByParentId(\Criteria $criteria = null, $distinct = false, \PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$count = \net\keeko\cms\core\entities\peer\MenuItemPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
					$count = \net\keeko\cms\core\entities\peer\MenuItemPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collMenuItemsRelatedByParentId);
				}
			} else {
				$count = count($this->collMenuItemsRelatedByParentId);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;
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
	public function addMenuItemRelatedByParentId(net\keeko\cms\core\entities\MenuItem $l)
	{
		if ($this->collMenuItemsRelatedByParentId === null) {
			$this->initMenuItemsRelatedByParentId();
		}
	
		if (!in_array($l, $this->collMenuItemsRelatedByParentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collMenuItemsRelatedByParentId, $l);
			$l->setMenuItemRelatedByParentId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MenuItem is new, it will return
	 * an empty collection; or if this MenuItem has previously
	 * been saved, it will retrieve related MenuItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MenuItem.
	 */
	public function getMenuItemsRelatedByParentIdJoinPage($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinPage($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;

		return $this->collMenuItemsRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MenuItem is new, it will return
	 * an empty collection; or if this MenuItem has previously
	 * been saved, it will retrieve related MenuItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MenuItem.
	 */
	public function getMenuItemsRelatedByParentIdJoinLanguageText($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinLanguageText($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinLanguageText($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;

		return $this->collMenuItemsRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MenuItem is new, it will return
	 * an empty collection; or if this MenuItem has previously
	 * been saved, it will retrieve related MenuItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MenuItem.
	 */
	public function getMenuItemsRelatedByParentIdJoinMenu($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenu($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinMenu($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;

		return $this->collMenuItemsRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MenuItem is new, it will return
	 * an empty collection; or if this MenuItem has previously
	 * been saved, it will retrieve related MenuItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MenuItem.
	 */
	public function getMenuItemsRelatedByParentIdJoinModule($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinModule($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;

		return $this->collMenuItemsRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MenuItem is new, it will return
	 * an empty collection; or if this MenuItem has previously
	 * been saved, it will retrieve related MenuItemsRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MenuItem.
	 */
	public function getMenuItemsRelatedByParentIdJoinAction($criteria = null, $con = null, $join_behavior = \Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new \Criteria(\net\keeko\cms\core\entities\peer\MenuItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof \Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuItemsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collMenuItemsRelatedByParentId = array();
			} else {

				$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinAction($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(\net\keeko\cms\core\entities\peer\MenuItemPeer::PARENT_ID, $this->id);

			if (!isset($this->lastMenuItemRelatedByParentIdCriteria) || !$this->lastMenuItemRelatedByParentIdCriteria->equals($criteria)) {
				$this->collMenuItemsRelatedByParentId = \net\keeko\cms\core\entities\peer\MenuItemPeer::doSelectJoinAction($criteria, $con, $join_behavior);
			}
		}
		$this->lastMenuItemRelatedByParentIdCriteria = $criteria;

		return $this->collMenuItemsRelatedByParentId;
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
			if ($this->collMenuItemsRelatedByParentId) {
				foreach ((array) $this->collMenuItemsRelatedByParentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collMenuItemsRelatedByParentId = null;
			$this->aPage = null;
			$this->aLanguageText = null;
			$this->aMenu = null;
			$this->aMenuItemRelatedByParentId = null;
			$this->aModule = null;
			$this->aAction = null;
	}

} // net\keeko\cms\core\entities\base\BaseMenuItem
