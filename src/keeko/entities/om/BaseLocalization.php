<?php

namespace keeko\entities\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use keeko\entities\AppUri;
use keeko\entities\AppUriQuery;
use keeko\entities\Country;
use keeko\entities\CountryQuery;
use keeko\entities\Language;
use keeko\entities\LanguageQuery;
use keeko\entities\Localization;
use keeko\entities\LocalizationPeer;
use keeko\entities\LocalizationQuery;

/**
 * Base class that represents a row from the 'keeko_localization' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseLocalization extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\LocalizationPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LocalizationPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

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
     * The value for the language_id field.
     * @var        int
     */
    protected $language_id;

    /**
     * The value for the country_iso_nr field.
     * @var        int
     */
    protected $country_iso_nr;

    /**
     * The value for the is_default field.
     * @var        boolean
     */
    protected $is_default;

    /**
     * @var        Localization
     */
    protected $aLocalizationRelatedByParentId;

    /**
     * @var        Language
     */
    protected $aLanguage;

    /**
     * @var        Country
     */
    protected $aCountry;

    /**
     * @var        PropelObjectCollection|Localization[] Collection to store aggregation of Localization objects.
     */
    protected $collLocalizationsRelatedById;
    protected $collLocalizationsRelatedByIdPartial;

    /**
     * @var        PropelObjectCollection|AppUri[] Collection to store aggregation of AppUri objects.
     */
    protected $collAppUris;
    protected $collAppUrisPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $localizationsRelatedByIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $appUrisScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [parent_id] column value.
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the [language_id] column value.
     *
     * @return int
     */
    public function getLanguageId()
    {
        return $this->language_id;
    }

    /**
     * Get the [country_iso_nr] column value.
     *
     * @return int
     */
    public function getCountryIsoNr()
    {
        return $this->country_iso_nr;
    }

    /**
     * Get the [is_default] column value.
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Localization The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LocalizationPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [parent_id] column.
     *
     * @param int $v new value
     * @return Localization The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[] = LocalizationPeer::PARENT_ID;
        }

        if ($this->aLocalizationRelatedByParentId !== null && $this->aLocalizationRelatedByParentId->getId() !== $v) {
            $this->aLocalizationRelatedByParentId = null;
        }


        return $this;
    } // setParentId()

    /**
     * Set the value of [language_id] column.
     *
     * @param int $v new value
     * @return Localization The current object (for fluent API support)
     */
    public function setLanguageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->language_id !== $v) {
            $this->language_id = $v;
            $this->modifiedColumns[] = LocalizationPeer::LANGUAGE_ID;
        }

        if ($this->aLanguage !== null && $this->aLanguage->getId() !== $v) {
            $this->aLanguage = null;
        }


        return $this;
    } // setLanguageId()

    /**
     * Set the value of [country_iso_nr] column.
     *
     * @param int $v new value
     * @return Localization The current object (for fluent API support)
     */
    public function setCountryIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_iso_nr !== $v) {
            $this->country_iso_nr = $v;
            $this->modifiedColumns[] = LocalizationPeer::COUNTRY_ISO_NR;
        }

        if ($this->aCountry !== null && $this->aCountry->getIsoNr() !== $v) {
            $this->aCountry = null;
        }


        return $this;
    } // setCountryIsoNr()

    /**
     * Sets the value of the [is_default] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Localization The current object (for fluent API support)
     */
    public function setIsDefault($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[] = LocalizationPeer::IS_DEFAULT;
        }


        return $this;
    } // setIsDefault()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
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
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->language_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->country_iso_nr = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->is_default = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = LocalizationPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Localization object", $e);
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
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aLocalizationRelatedByParentId !== null && $this->parent_id !== $this->aLocalizationRelatedByParentId->getId()) {
            $this->aLocalizationRelatedByParentId = null;
        }
        if ($this->aLanguage !== null && $this->language_id !== $this->aLanguage->getId()) {
            $this->aLanguage = null;
        }
        if ($this->aCountry !== null && $this->country_iso_nr !== $this->aCountry->getIsoNr()) {
            $this->aCountry = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LocalizationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LocalizationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLocalizationRelatedByParentId = null;
            $this->aLanguage = null;
            $this->aCountry = null;
            $this->collLocalizationsRelatedById = null;

            $this->collAppUris = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LocalizationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LocalizationQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LocalizationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                LocalizationPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLocalizationRelatedByParentId !== null) {
                if ($this->aLocalizationRelatedByParentId->isModified() || $this->aLocalizationRelatedByParentId->isNew()) {
                    $affectedRows += $this->aLocalizationRelatedByParentId->save($con);
                }
                $this->setLocalizationRelatedByParentId($this->aLocalizationRelatedByParentId);
            }

            if ($this->aLanguage !== null) {
                if ($this->aLanguage->isModified() || $this->aLanguage->isNew()) {
                    $affectedRows += $this->aLanguage->save($con);
                }
                $this->setLanguage($this->aLanguage);
            }

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->localizationsRelatedByIdScheduledForDeletion !== null) {
                if (!$this->localizationsRelatedByIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->localizationsRelatedByIdScheduledForDeletion as $localizationRelatedById) {
                        // need to save related object because we set the relation to null
                        $localizationRelatedById->save($con);
                    }
                    $this->localizationsRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collLocalizationsRelatedById !== null) {
                foreach ($this->collLocalizationsRelatedById as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->appUrisScheduledForDeletion !== null) {
                if (!$this->appUrisScheduledForDeletion->isEmpty()) {
                    AppUriQuery::create()
                        ->filterByPrimaryKeys($this->appUrisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->appUrisScheduledForDeletion = null;
                }
            }

            if ($this->collAppUris !== null) {
                foreach ($this->collAppUris as $referrerFK) {
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
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = LocalizationPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LocalizationPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LocalizationPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(LocalizationPeer::PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PARENT_ID`';
        }
        if ($this->isColumnModified(LocalizationPeer::LANGUAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`LANGUAGE_ID`';
        }
        if ($this->isColumnModified(LocalizationPeer::COUNTRY_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY_ISO_NR`';
        }
        if ($this->isColumnModified(LocalizationPeer::IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`IS_DEFAULT`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_localization` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`PARENT_ID`':
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                    case '`LANGUAGE_ID`':
                        $stmt->bindValue($identifier, $this->language_id, PDO::PARAM_INT);
                        break;
                    case '`COUNTRY_ISO_NR`':
                        $stmt->bindValue($identifier, $this->country_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`IS_DEFAULT`':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
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
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
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
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
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

            if ($this->aLocalizationRelatedByParentId !== null) {
                if (!$this->aLocalizationRelatedByParentId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLocalizationRelatedByParentId->getValidationFailures());
                }
            }

            if ($this->aLanguage !== null) {
                if (!$this->aLanguage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLanguage->getValidationFailures());
                }
            }

            if ($this->aCountry !== null) {
                if (!$this->aCountry->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
                }
            }


            if (($retval = LocalizationPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLocalizationsRelatedById !== null) {
                    foreach ($this->collLocalizationsRelatedById as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAppUris !== null) {
                    foreach ($this->collAppUris as $referrerFK) {
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
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LocalizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getParentId();
                break;
            case 2:
                return $this->getLanguageId();
                break;
            case 3:
                return $this->getCountryIsoNr();
                break;
            case 4:
                return $this->getIsDefault();
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
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Localization'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Localization'][$this->getPrimaryKey()] = true;
        $keys = LocalizationPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getParentId(),
            $keys[2] => $this->getLanguageId(),
            $keys[3] => $this->getCountryIsoNr(),
            $keys[4] => $this->getIsDefault(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aLocalizationRelatedByParentId) {
                $result['LocalizationRelatedByParentId'] = $this->aLocalizationRelatedByParentId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLanguage) {
                $result['Language'] = $this->aLanguage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCountry) {
                $result['Country'] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLocalizationsRelatedById) {
                $result['LocalizationsRelatedById'] = $this->collLocalizationsRelatedById->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAppUris) {
                $result['AppUris'] = $this->collAppUris->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LocalizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setParentId($value);
                break;
            case 2:
                $this->setLanguageId($value);
                break;
            case 3:
                $this->setCountryIsoNr($value);
                break;
            case 4:
                $this->setIsDefault($value);
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
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = LocalizationPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLanguageId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCountryIsoNr($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setIsDefault($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LocalizationPeer::DATABASE_NAME);

        if ($this->isColumnModified(LocalizationPeer::ID)) $criteria->add(LocalizationPeer::ID, $this->id);
        if ($this->isColumnModified(LocalizationPeer::PARENT_ID)) $criteria->add(LocalizationPeer::PARENT_ID, $this->parent_id);
        if ($this->isColumnModified(LocalizationPeer::LANGUAGE_ID)) $criteria->add(LocalizationPeer::LANGUAGE_ID, $this->language_id);
        if ($this->isColumnModified(LocalizationPeer::COUNTRY_ISO_NR)) $criteria->add(LocalizationPeer::COUNTRY_ISO_NR, $this->country_iso_nr);
        if ($this->isColumnModified(LocalizationPeer::IS_DEFAULT)) $criteria->add(LocalizationPeer::IS_DEFAULT, $this->is_default);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(LocalizationPeer::DATABASE_NAME);
        $criteria->add(LocalizationPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Localization (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setParentId($this->getParentId());
        $copyObj->setLanguageId($this->getLanguageId());
        $copyObj->setCountryIsoNr($this->getCountryIsoNr());
        $copyObj->setIsDefault($this->getIsDefault());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLocalizationsRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocalizationRelatedById($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAppUris() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAppUri($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Localization Clone of current object.
     * @throws PropelException
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
     * @return LocalizationPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LocalizationPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Localization object.
     *
     * @param             Localization $v
     * @return Localization The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLocalizationRelatedByParentId(Localization $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getId());
        }

        $this->aLocalizationRelatedByParentId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Localization object, it will not be re-added.
        if ($v !== null) {
            $v->addLocalizationRelatedById($this);
        }


        return $this;
    }


    /**
     * Get the associated Localization object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Localization The associated Localization object.
     * @throws PropelException
     */
    public function getLocalizationRelatedByParentId(PropelPDO $con = null)
    {
        if ($this->aLocalizationRelatedByParentId === null && ($this->parent_id !== null)) {
            $this->aLocalizationRelatedByParentId = LocalizationQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocalizationRelatedByParentId->addLocalizationsRelatedById($this);
             */
        }

        return $this->aLocalizationRelatedByParentId;
    }

    /**
     * Declares an association between this object and a Language object.
     *
     * @param             Language $v
     * @return Localization The current object (for fluent API support)
     * @throws PropelException
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
            $v->addLocalization($this);
        }


        return $this;
    }


    /**
     * Get the associated Language object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Language The associated Language object.
     * @throws PropelException
     */
    public function getLanguage(PropelPDO $con = null)
    {
        if ($this->aLanguage === null && ($this->language_id !== null)) {
            $this->aLanguage = LanguageQuery::create()->findPk($this->language_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguage->addLocalizations($this);
             */
        }

        return $this->aLanguage;
    }

    /**
     * Declares an association between this object and a Country object.
     *
     * @param             Country $v
     * @return Localization The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountry(Country $v = null)
    {
        if ($v === null) {
            $this->setCountryIsoNr(NULL);
        } else {
            $this->setCountryIsoNr($v->getIsoNr());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Country object, it will not be re-added.
        if ($v !== null) {
            $v->addLocalization($this);
        }


        return $this;
    }


    /**
     * Get the associated Country object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Country The associated Country object.
     * @throws PropelException
     */
    public function getCountry(PropelPDO $con = null)
    {
        if ($this->aCountry === null && ($this->country_iso_nr !== null)) {
            $this->aCountry = CountryQuery::create()->findPk($this->country_iso_nr, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addLocalizations($this);
             */
        }

        return $this->aCountry;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('LocalizationRelatedById' == $relationName) {
            $this->initLocalizationsRelatedById();
        }
        if ('AppUri' == $relationName) {
            $this->initAppUris();
        }
    }

    /**
     * Clears out the collLocalizationsRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLocalizationsRelatedById()
     */
    public function clearLocalizationsRelatedById()
    {
        $this->collLocalizationsRelatedById = null; // important to set this to null since that means it is uninitialized
        $this->collLocalizationsRelatedByIdPartial = null;
    }

    /**
     * reset is the collLocalizationsRelatedById collection loaded partially
     *
     * @return void
     */
    public function resetPartialLocalizationsRelatedById($v = true)
    {
        $this->collLocalizationsRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collLocalizationsRelatedById collection.
     *
     * By default this just sets the collLocalizationsRelatedById collection to an empty array (like clearcollLocalizationsRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLocalizationsRelatedById($overrideExisting = true)
    {
        if (null !== $this->collLocalizationsRelatedById && !$overrideExisting) {
            return;
        }
        $this->collLocalizationsRelatedById = new PropelObjectCollection();
        $this->collLocalizationsRelatedById->setModel('Localization');
    }

    /**
     * Gets an array of Localization objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Localization is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Localization[] List of Localization objects
     * @throws PropelException
     */
    public function getLocalizationsRelatedById($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLocalizationsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collLocalizationsRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLocalizationsRelatedById) {
                // return empty collection
                $this->initLocalizationsRelatedById();
            } else {
                $collLocalizationsRelatedById = LocalizationQuery::create(null, $criteria)
                    ->filterByLocalizationRelatedByParentId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLocalizationsRelatedByIdPartial && count($collLocalizationsRelatedById)) {
                      $this->initLocalizationsRelatedById(false);

                      foreach($collLocalizationsRelatedById as $obj) {
                        if (false == $this->collLocalizationsRelatedById->contains($obj)) {
                          $this->collLocalizationsRelatedById->append($obj);
                        }
                      }

                      $this->collLocalizationsRelatedByIdPartial = true;
                    }

                    return $collLocalizationsRelatedById;
                }

                if($partial && $this->collLocalizationsRelatedById) {
                    foreach($this->collLocalizationsRelatedById as $obj) {
                        if($obj->isNew()) {
                            $collLocalizationsRelatedById[] = $obj;
                        }
                    }
                }

                $this->collLocalizationsRelatedById = $collLocalizationsRelatedById;
                $this->collLocalizationsRelatedByIdPartial = false;
            }
        }

        return $this->collLocalizationsRelatedById;
    }

    /**
     * Sets a collection of LocalizationRelatedById objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $localizationsRelatedById A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setLocalizationsRelatedById(PropelCollection $localizationsRelatedById, PropelPDO $con = null)
    {
        $this->localizationsRelatedByIdScheduledForDeletion = $this->getLocalizationsRelatedById(new Criteria(), $con)->diff($localizationsRelatedById);

        foreach ($this->localizationsRelatedByIdScheduledForDeletion as $localizationRelatedByIdRemoved) {
            $localizationRelatedByIdRemoved->setLocalizationRelatedByParentId(null);
        }

        $this->collLocalizationsRelatedById = null;
        foreach ($localizationsRelatedById as $localizationRelatedById) {
            $this->addLocalizationRelatedById($localizationRelatedById);
        }

        $this->collLocalizationsRelatedById = $localizationsRelatedById;
        $this->collLocalizationsRelatedByIdPartial = false;
    }

    /**
     * Returns the number of related Localization objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Localization objects.
     * @throws PropelException
     */
    public function countLocalizationsRelatedById(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLocalizationsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collLocalizationsRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLocalizationsRelatedById) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getLocalizationsRelatedById());
                }
                $query = LocalizationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLocalizationRelatedByParentId($this)
                    ->count($con);
            }
        } else {
            return count($this->collLocalizationsRelatedById);
        }
    }

    /**
     * Method called to associate a Localization object to this object
     * through the Localization foreign key attribute.
     *
     * @param    Localization $l Localization
     * @return Localization The current object (for fluent API support)
     */
    public function addLocalizationRelatedById(Localization $l)
    {
        if ($this->collLocalizationsRelatedById === null) {
            $this->initLocalizationsRelatedById();
            $this->collLocalizationsRelatedByIdPartial = true;
        }
        if (!in_array($l, $this->collLocalizationsRelatedById->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLocalizationRelatedById($l);
        }

        return $this;
    }

    /**
     * @param	LocalizationRelatedById $localizationRelatedById The localizationRelatedById object to add.
     */
    protected function doAddLocalizationRelatedById($localizationRelatedById)
    {
        $this->collLocalizationsRelatedById[]= $localizationRelatedById;
        $localizationRelatedById->setLocalizationRelatedByParentId($this);
    }

    /**
     * @param	LocalizationRelatedById $localizationRelatedById The localizationRelatedById object to remove.
     */
    public function removeLocalizationRelatedById($localizationRelatedById)
    {
        if ($this->getLocalizationsRelatedById()->contains($localizationRelatedById)) {
            $this->collLocalizationsRelatedById->remove($this->collLocalizationsRelatedById->search($localizationRelatedById));
            if (null === $this->localizationsRelatedByIdScheduledForDeletion) {
                $this->localizationsRelatedByIdScheduledForDeletion = clone $this->collLocalizationsRelatedById;
                $this->localizationsRelatedByIdScheduledForDeletion->clear();
            }
            $this->localizationsRelatedByIdScheduledForDeletion[]= $localizationRelatedById;
            $localizationRelatedById->setLocalizationRelatedByParentId(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Localization is new, it will return
     * an empty collection; or if this Localization has previously
     * been saved, it will retrieve related LocalizationsRelatedById from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Localization.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Localization[] List of Localization objects
     */
    public function getLocalizationsRelatedByIdJoinLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LocalizationQuery::create(null, $criteria);
        $query->joinWith('Language', $join_behavior);

        return $this->getLocalizationsRelatedById($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Localization is new, it will return
     * an empty collection; or if this Localization has previously
     * been saved, it will retrieve related LocalizationsRelatedById from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Localization.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Localization[] List of Localization objects
     */
    public function getLocalizationsRelatedByIdJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LocalizationQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getLocalizationsRelatedById($query, $con);
    }

    /**
     * Clears out the collAppUris collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAppUris()
     */
    public function clearAppUris()
    {
        $this->collAppUris = null; // important to set this to null since that means it is uninitialized
        $this->collAppUrisPartial = null;
    }

    /**
     * reset is the collAppUris collection loaded partially
     *
     * @return void
     */
    public function resetPartialAppUris($v = true)
    {
        $this->collAppUrisPartial = $v;
    }

    /**
     * Initializes the collAppUris collection.
     *
     * By default this just sets the collAppUris collection to an empty array (like clearcollAppUris());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAppUris($overrideExisting = true)
    {
        if (null !== $this->collAppUris && !$overrideExisting) {
            return;
        }
        $this->collAppUris = new PropelObjectCollection();
        $this->collAppUris->setModel('AppUri');
    }

    /**
     * Gets an array of AppUri objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Localization is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AppUri[] List of AppUri objects
     * @throws PropelException
     */
    public function getAppUris($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAppUrisPartial && !$this->isNew();
        if (null === $this->collAppUris || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAppUris) {
                // return empty collection
                $this->initAppUris();
            } else {
                $collAppUris = AppUriQuery::create(null, $criteria)
                    ->filterByLocalization($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAppUrisPartial && count($collAppUris)) {
                      $this->initAppUris(false);

                      foreach($collAppUris as $obj) {
                        if (false == $this->collAppUris->contains($obj)) {
                          $this->collAppUris->append($obj);
                        }
                      }

                      $this->collAppUrisPartial = true;
                    }

                    return $collAppUris;
                }

                if($partial && $this->collAppUris) {
                    foreach($this->collAppUris as $obj) {
                        if($obj->isNew()) {
                            $collAppUris[] = $obj;
                        }
                    }
                }

                $this->collAppUris = $collAppUris;
                $this->collAppUrisPartial = false;
            }
        }

        return $this->collAppUris;
    }

    /**
     * Sets a collection of AppUri objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $appUris A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAppUris(PropelCollection $appUris, PropelPDO $con = null)
    {
        $this->appUrisScheduledForDeletion = $this->getAppUris(new Criteria(), $con)->diff($appUris);

        foreach ($this->appUrisScheduledForDeletion as $appUriRemoved) {
            $appUriRemoved->setLocalization(null);
        }

        $this->collAppUris = null;
        foreach ($appUris as $appUri) {
            $this->addAppUri($appUri);
        }

        $this->collAppUris = $appUris;
        $this->collAppUrisPartial = false;
    }

    /**
     * Returns the number of related AppUri objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AppUri objects.
     * @throws PropelException
     */
    public function countAppUris(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAppUrisPartial && !$this->isNew();
        if (null === $this->collAppUris || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAppUris) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAppUris());
                }
                $query = AppUriQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLocalization($this)
                    ->count($con);
            }
        } else {
            return count($this->collAppUris);
        }
    }

    /**
     * Method called to associate a AppUri object to this object
     * through the AppUri foreign key attribute.
     *
     * @param    AppUri $l AppUri
     * @return Localization The current object (for fluent API support)
     */
    public function addAppUri(AppUri $l)
    {
        if ($this->collAppUris === null) {
            $this->initAppUris();
            $this->collAppUrisPartial = true;
        }
        if (!in_array($l, $this->collAppUris->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAppUri($l);
        }

        return $this;
    }

    /**
     * @param	AppUri $appUri The appUri object to add.
     */
    protected function doAddAppUri($appUri)
    {
        $this->collAppUris[]= $appUri;
        $appUri->setLocalization($this);
    }

    /**
     * @param	AppUri $appUri The appUri object to remove.
     */
    public function removeAppUri($appUri)
    {
        if ($this->getAppUris()->contains($appUri)) {
            $this->collAppUris->remove($this->collAppUris->search($appUri));
            if (null === $this->appUrisScheduledForDeletion) {
                $this->appUrisScheduledForDeletion = clone $this->collAppUris;
                $this->appUrisScheduledForDeletion->clear();
            }
            $this->appUrisScheduledForDeletion[]= $appUri;
            $appUri->setLocalization(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Localization is new, it will return
     * an empty collection; or if this Localization has previously
     * been saved, it will retrieve related AppUris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Localization.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AppUri[] List of AppUri objects
     */
    public function getAppUrisJoinApp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AppUriQuery::create(null, $criteria);
        $query->joinWith('App', $join_behavior);

        return $this->getAppUris($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->parent_id = null;
        $this->language_id = null;
        $this->country_iso_nr = null;
        $this->is_default = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collLocalizationsRelatedById) {
                foreach ($this->collLocalizationsRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAppUris) {
                foreach ($this->collAppUris as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collLocalizationsRelatedById instanceof PropelCollection) {
            $this->collLocalizationsRelatedById->clearIterator();
        }
        $this->collLocalizationsRelatedById = null;
        if ($this->collAppUris instanceof PropelCollection) {
            $this->collAppUris->clearIterator();
        }
        $this->collAppUris = null;
        $this->aLocalizationRelatedByParentId = null;
        $this->aLanguage = null;
        $this->aCountry = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LocalizationPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
