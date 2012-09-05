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
use keeko\entities\Language;
use keeko\entities\LanguagePeer;
use keeko\entities\LanguageQuery;
use keeko\entities\LanguageScope;
use keeko\entities\LanguageScopeQuery;
use keeko\entities\LanguageType;
use keeko\entities\LanguageTypeQuery;
use keeko\entities\Localization;
use keeko\entities\LocalizationQuery;

/**
 * Base class that represents a row from the 'keeko_language' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseLanguage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\LanguagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LanguagePeer
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
     * The value for the alpha_2 field.
     * @var        string
     */
    protected $alpha_2;

    /**
     * The value for the alpha_3t field.
     * @var        string
     */
    protected $alpha_3t;

    /**
     * The value for the alpha_3b field.
     * @var        string
     */
    protected $alpha_3b;

    /**
     * The value for the alpha_3 field.
     * @var        string
     */
    protected $alpha_3;

    /**
     * The value for the local_name field.
     * @var        string
     */
    protected $local_name;

    /**
     * The value for the en_name field.
     * @var        string
     */
    protected $en_name;

    /**
     * The value for the collate field.
     * @var        string
     */
    protected $collate;

    /**
     * The value for the scope_id field.
     * @var        int
     */
    protected $scope_id;

    /**
     * The value for the type_id field.
     * @var        int
     */
    protected $type_id;

    /**
     * @var        LanguageScope
     */
    protected $aLanguageScope;

    /**
     * @var        LanguageType
     */
    protected $aLanguageType;

    /**
     * @var        PropelObjectCollection|Localization[] Collection to store aggregation of Localization objects.
     */
    protected $collLocalizations;
    protected $collLocalizationsPartial;

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
    protected $localizationsScheduledForDeletion = null;

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
     * Get the [alpha_2] column value.
     *
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha_2;
    }

    /**
     * Get the [alpha_3t] column value.
     *
     * @return string
     */
    public function getAlpha3T()
    {
        return $this->alpha_3t;
    }

    /**
     * Get the [alpha_3b] column value.
     *
     * @return string
     */
    public function getAlpha3B()
    {
        return $this->alpha_3b;
    }

    /**
     * Get the [alpha_3] column value.
     *
     * @return string
     */
    public function getAlpha3()
    {
        return $this->alpha_3;
    }

    /**
     * Get the [local_name] column value.
     *
     * @return string
     */
    public function getLocalName()
    {
        return $this->local_name;
    }

    /**
     * Get the [en_name] column value.
     *
     * @return string
     */
    public function getEnName()
    {
        return $this->en_name;
    }

    /**
     * Get the [collate] column value.
     *
     * @return string
     */
    public function getCollate()
    {
        return $this->collate;
    }

    /**
     * Get the [scope_id] column value.
     *
     * @return int
     */
    public function getScopeId()
    {
        return $this->scope_id;
    }

    /**
     * Get the [type_id] column value.
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LanguagePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [alpha_2] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setAlpha2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_2 !== $v) {
            $this->alpha_2 = $v;
            $this->modifiedColumns[] = LanguagePeer::ALPHA_2;
        }


        return $this;
    } // setAlpha2()

    /**
     * Set the value of [alpha_3t] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setAlpha3T($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_3t !== $v) {
            $this->alpha_3t = $v;
            $this->modifiedColumns[] = LanguagePeer::ALPHA_3T;
        }


        return $this;
    } // setAlpha3T()

    /**
     * Set the value of [alpha_3b] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setAlpha3B($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_3b !== $v) {
            $this->alpha_3b = $v;
            $this->modifiedColumns[] = LanguagePeer::ALPHA_3B;
        }


        return $this;
    } // setAlpha3B()

    /**
     * Set the value of [alpha_3] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setAlpha3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_3 !== $v) {
            $this->alpha_3 = $v;
            $this->modifiedColumns[] = LanguagePeer::ALPHA_3;
        }


        return $this;
    } // setAlpha3()

    /**
     * Set the value of [local_name] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setLocalName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->local_name !== $v) {
            $this->local_name = $v;
            $this->modifiedColumns[] = LanguagePeer::LOCAL_NAME;
        }


        return $this;
    } // setLocalName()

    /**
     * Set the value of [en_name] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setEnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->en_name !== $v) {
            $this->en_name = $v;
            $this->modifiedColumns[] = LanguagePeer::EN_NAME;
        }


        return $this;
    } // setEnName()

    /**
     * Set the value of [collate] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setCollate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->collate !== $v) {
            $this->collate = $v;
            $this->modifiedColumns[] = LanguagePeer::COLLATE;
        }


        return $this;
    } // setCollate()

    /**
     * Set the value of [scope_id] column.
     *
     * @param int $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setScopeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->scope_id !== $v) {
            $this->scope_id = $v;
            $this->modifiedColumns[] = LanguagePeer::SCOPE_ID;
        }

        if ($this->aLanguageScope !== null && $this->aLanguageScope->getId() !== $v) {
            $this->aLanguageScope = null;
        }


        return $this;
    } // setScopeId()

    /**
     * Set the value of [type_id] column.
     *
     * @param int $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_id !== $v) {
            $this->type_id = $v;
            $this->modifiedColumns[] = LanguagePeer::TYPE_ID;
        }

        if ($this->aLanguageType !== null && $this->aLanguageType->getId() !== $v) {
            $this->aLanguageType = null;
        }


        return $this;
    } // setTypeId()

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
            $this->alpha_2 = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->alpha_3t = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->alpha_3b = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->alpha_3 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->local_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->en_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->collate = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->scope_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->type_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = LanguagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Language object", $e);
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

        if ($this->aLanguageScope !== null && $this->scope_id !== $this->aLanguageScope->getId()) {
            $this->aLanguageScope = null;
        }
        if ($this->aLanguageType !== null && $this->type_id !== $this->aLanguageType->getId()) {
            $this->aLanguageType = null;
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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LanguagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLanguageScope = null;
            $this->aLanguageType = null;
            $this->collLocalizations = null;

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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LanguageQuery::create()
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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LanguagePeer::addInstanceToPool($this);
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

            if ($this->aLanguageScope !== null) {
                if ($this->aLanguageScope->isModified() || $this->aLanguageScope->isNew()) {
                    $affectedRows += $this->aLanguageScope->save($con);
                }
                $this->setLanguageScope($this->aLanguageScope);
            }

            if ($this->aLanguageType !== null) {
                if ($this->aLanguageType->isModified() || $this->aLanguageType->isNew()) {
                    $affectedRows += $this->aLanguageType->save($con);
                }
                $this->setLanguageType($this->aLanguageType);
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

            if ($this->localizationsScheduledForDeletion !== null) {
                if (!$this->localizationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->localizationsScheduledForDeletion as $localization) {
                        // need to save related object because we set the relation to null
                        $localization->save($con);
                    }
                    $this->localizationsScheduledForDeletion = null;
                }
            }

            if ($this->collLocalizations !== null) {
                foreach ($this->collLocalizations as $referrerFK) {
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

        $this->modifiedColumns[] = LanguagePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LanguagePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LanguagePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(LanguagePeer::ALPHA_2)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_2`';
        }
        if ($this->isColumnModified(LanguagePeer::ALPHA_3T)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_3T`';
        }
        if ($this->isColumnModified(LanguagePeer::ALPHA_3B)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_3B`';
        }
        if ($this->isColumnModified(LanguagePeer::ALPHA_3)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_3`';
        }
        if ($this->isColumnModified(LanguagePeer::LOCAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`LOCAL_NAME`';
        }
        if ($this->isColumnModified(LanguagePeer::EN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`EN_NAME`';
        }
        if ($this->isColumnModified(LanguagePeer::COLLATE)) {
            $modifiedColumns[':p' . $index++]  = '`COLLATE`';
        }
        if ($this->isColumnModified(LanguagePeer::SCOPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`SCOPE_ID`';
        }
        if ($this->isColumnModified(LanguagePeer::TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`TYPE_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_language` (%s) VALUES (%s)',
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
                    case '`ALPHA_2`':
                        $stmt->bindValue($identifier, $this->alpha_2, PDO::PARAM_STR);
                        break;
                    case '`ALPHA_3T`':
                        $stmt->bindValue($identifier, $this->alpha_3t, PDO::PARAM_STR);
                        break;
                    case '`ALPHA_3B`':
                        $stmt->bindValue($identifier, $this->alpha_3b, PDO::PARAM_STR);
                        break;
                    case '`ALPHA_3`':
                        $stmt->bindValue($identifier, $this->alpha_3, PDO::PARAM_STR);
                        break;
                    case '`LOCAL_NAME`':
                        $stmt->bindValue($identifier, $this->local_name, PDO::PARAM_STR);
                        break;
                    case '`EN_NAME`':
                        $stmt->bindValue($identifier, $this->en_name, PDO::PARAM_STR);
                        break;
                    case '`COLLATE`':
                        $stmt->bindValue($identifier, $this->collate, PDO::PARAM_STR);
                        break;
                    case '`SCOPE_ID`':
                        $stmt->bindValue($identifier, $this->scope_id, PDO::PARAM_INT);
                        break;
                    case '`TYPE_ID`':
                        $stmt->bindValue($identifier, $this->type_id, PDO::PARAM_INT);
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

            if ($this->aLanguageScope !== null) {
                if (!$this->aLanguageScope->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLanguageScope->getValidationFailures());
                }
            }

            if ($this->aLanguageType !== null) {
                if (!$this->aLanguageType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLanguageType->getValidationFailures());
                }
            }


            if (($retval = LanguagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLocalizations !== null) {
                    foreach ($this->collLocalizations as $referrerFK) {
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
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAlpha2();
                break;
            case 2:
                return $this->getAlpha3T();
                break;
            case 3:
                return $this->getAlpha3B();
                break;
            case 4:
                return $this->getAlpha3();
                break;
            case 5:
                return $this->getLocalName();
                break;
            case 6:
                return $this->getEnName();
                break;
            case 7:
                return $this->getCollate();
                break;
            case 8:
                return $this->getScopeId();
                break;
            case 9:
                return $this->getTypeId();
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
        if (isset($alreadyDumpedObjects['Language'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Language'][$this->getPrimaryKey()] = true;
        $keys = LanguagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAlpha2(),
            $keys[2] => $this->getAlpha3T(),
            $keys[3] => $this->getAlpha3B(),
            $keys[4] => $this->getAlpha3(),
            $keys[5] => $this->getLocalName(),
            $keys[6] => $this->getEnName(),
            $keys[7] => $this->getCollate(),
            $keys[8] => $this->getScopeId(),
            $keys[9] => $this->getTypeId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aLanguageScope) {
                $result['LanguageScope'] = $this->aLanguageScope->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLanguageType) {
                $result['LanguageType'] = $this->aLanguageType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLocalizations) {
                $result['Localizations'] = $this->collLocalizations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAlpha2($value);
                break;
            case 2:
                $this->setAlpha3T($value);
                break;
            case 3:
                $this->setAlpha3B($value);
                break;
            case 4:
                $this->setAlpha3($value);
                break;
            case 5:
                $this->setLocalName($value);
                break;
            case 6:
                $this->setEnName($value);
                break;
            case 7:
                $this->setCollate($value);
                break;
            case 8:
                $this->setScopeId($value);
                break;
            case 9:
                $this->setTypeId($value);
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
        $keys = LanguagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAlpha2($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAlpha3T($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAlpha3B($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAlpha3($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setLocalName($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEnName($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCollate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setScopeId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setTypeId($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);

        if ($this->isColumnModified(LanguagePeer::ID)) $criteria->add(LanguagePeer::ID, $this->id);
        if ($this->isColumnModified(LanguagePeer::ALPHA_2)) $criteria->add(LanguagePeer::ALPHA_2, $this->alpha_2);
        if ($this->isColumnModified(LanguagePeer::ALPHA_3T)) $criteria->add(LanguagePeer::ALPHA_3T, $this->alpha_3t);
        if ($this->isColumnModified(LanguagePeer::ALPHA_3B)) $criteria->add(LanguagePeer::ALPHA_3B, $this->alpha_3b);
        if ($this->isColumnModified(LanguagePeer::ALPHA_3)) $criteria->add(LanguagePeer::ALPHA_3, $this->alpha_3);
        if ($this->isColumnModified(LanguagePeer::LOCAL_NAME)) $criteria->add(LanguagePeer::LOCAL_NAME, $this->local_name);
        if ($this->isColumnModified(LanguagePeer::EN_NAME)) $criteria->add(LanguagePeer::EN_NAME, $this->en_name);
        if ($this->isColumnModified(LanguagePeer::COLLATE)) $criteria->add(LanguagePeer::COLLATE, $this->collate);
        if ($this->isColumnModified(LanguagePeer::SCOPE_ID)) $criteria->add(LanguagePeer::SCOPE_ID, $this->scope_id);
        if ($this->isColumnModified(LanguagePeer::TYPE_ID)) $criteria->add(LanguagePeer::TYPE_ID, $this->type_id);

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
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);
        $criteria->add(LanguagePeer::ID, $this->id);

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
     * @param object $copyObj An object of Language (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAlpha2($this->getAlpha2());
        $copyObj->setAlpha3T($this->getAlpha3T());
        $copyObj->setAlpha3B($this->getAlpha3B());
        $copyObj->setAlpha3($this->getAlpha3());
        $copyObj->setLocalName($this->getLocalName());
        $copyObj->setEnName($this->getEnName());
        $copyObj->setCollate($this->getCollate());
        $copyObj->setScopeId($this->getScopeId());
        $copyObj->setTypeId($this->getTypeId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getLocalizations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocalization($relObj->copy($deepCopy));
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
     * @return Language Clone of current object.
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
     * @return LanguagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LanguagePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a LanguageScope object.
     *
     * @param             LanguageScope $v
     * @return Language The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLanguageScope(LanguageScope $v = null)
    {
        if ($v === null) {
            $this->setScopeId(NULL);
        } else {
            $this->setScopeId($v->getId());
        }

        $this->aLanguageScope = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LanguageScope object, it will not be re-added.
        if ($v !== null) {
            $v->addLanguage($this);
        }


        return $this;
    }


    /**
     * Get the associated LanguageScope object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return LanguageScope The associated LanguageScope object.
     * @throws PropelException
     */
    public function getLanguageScope(PropelPDO $con = null)
    {
        if ($this->aLanguageScope === null && ($this->scope_id !== null)) {
            $this->aLanguageScope = LanguageScopeQuery::create()->findPk($this->scope_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguageScope->addLanguages($this);
             */
        }

        return $this->aLanguageScope;
    }

    /**
     * Declares an association between this object and a LanguageType object.
     *
     * @param             LanguageType $v
     * @return Language The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLanguageType(LanguageType $v = null)
    {
        if ($v === null) {
            $this->setTypeId(NULL);
        } else {
            $this->setTypeId($v->getId());
        }

        $this->aLanguageType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the LanguageType object, it will not be re-added.
        if ($v !== null) {
            $v->addLanguage($this);
        }


        return $this;
    }


    /**
     * Get the associated LanguageType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return LanguageType The associated LanguageType object.
     * @throws PropelException
     */
    public function getLanguageType(PropelPDO $con = null)
    {
        if ($this->aLanguageType === null && ($this->type_id !== null)) {
            $this->aLanguageType = LanguageTypeQuery::create()->findPk($this->type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguageType->addLanguages($this);
             */
        }

        return $this->aLanguageType;
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
        if ('Localization' == $relationName) {
            $this->initLocalizations();
        }
    }

    /**
     * Clears out the collLocalizations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLocalizations()
     */
    public function clearLocalizations()
    {
        $this->collLocalizations = null; // important to set this to null since that means it is uninitialized
        $this->collLocalizationsPartial = null;
    }

    /**
     * reset is the collLocalizations collection loaded partially
     *
     * @return void
     */
    public function resetPartialLocalizations($v = true)
    {
        $this->collLocalizationsPartial = $v;
    }

    /**
     * Initializes the collLocalizations collection.
     *
     * By default this just sets the collLocalizations collection to an empty array (like clearcollLocalizations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLocalizations($overrideExisting = true)
    {
        if (null !== $this->collLocalizations && !$overrideExisting) {
            return;
        }
        $this->collLocalizations = new PropelObjectCollection();
        $this->collLocalizations->setModel('Localization');
    }

    /**
     * Gets an array of Localization objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Localization[] List of Localization objects
     * @throws PropelException
     */
    public function getLocalizations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLocalizationsPartial && !$this->isNew();
        if (null === $this->collLocalizations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLocalizations) {
                // return empty collection
                $this->initLocalizations();
            } else {
                $collLocalizations = LocalizationQuery::create(null, $criteria)
                    ->filterByLanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLocalizationsPartial && count($collLocalizations)) {
                      $this->initLocalizations(false);

                      foreach($collLocalizations as $obj) {
                        if (false == $this->collLocalizations->contains($obj)) {
                          $this->collLocalizations->append($obj);
                        }
                      }

                      $this->collLocalizationsPartial = true;
                    }

                    return $collLocalizations;
                }

                if($partial && $this->collLocalizations) {
                    foreach($this->collLocalizations as $obj) {
                        if($obj->isNew()) {
                            $collLocalizations[] = $obj;
                        }
                    }
                }

                $this->collLocalizations = $collLocalizations;
                $this->collLocalizationsPartial = false;
            }
        }

        return $this->collLocalizations;
    }

    /**
     * Sets a collection of Localization objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $localizations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setLocalizations(PropelCollection $localizations, PropelPDO $con = null)
    {
        $this->localizationsScheduledForDeletion = $this->getLocalizations(new Criteria(), $con)->diff($localizations);

        foreach ($this->localizationsScheduledForDeletion as $localizationRemoved) {
            $localizationRemoved->setLanguage(null);
        }

        $this->collLocalizations = null;
        foreach ($localizations as $localization) {
            $this->addLocalization($localization);
        }

        $this->collLocalizations = $localizations;
        $this->collLocalizationsPartial = false;
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
    public function countLocalizations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLocalizationsPartial && !$this->isNew();
        if (null === $this->collLocalizations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLocalizations) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getLocalizations());
                }
                $query = LocalizationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLanguage($this)
                    ->count($con);
            }
        } else {
            return count($this->collLocalizations);
        }
    }

    /**
     * Method called to associate a Localization object to this object
     * through the Localization foreign key attribute.
     *
     * @param    Localization $l Localization
     * @return Language The current object (for fluent API support)
     */
    public function addLocalization(Localization $l)
    {
        if ($this->collLocalizations === null) {
            $this->initLocalizations();
            $this->collLocalizationsPartial = true;
        }
        if (!in_array($l, $this->collLocalizations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLocalization($l);
        }

        return $this;
    }

    /**
     * @param	Localization $localization The localization object to add.
     */
    protected function doAddLocalization($localization)
    {
        $this->collLocalizations[]= $localization;
        $localization->setLanguage($this);
    }

    /**
     * @param	Localization $localization The localization object to remove.
     */
    public function removeLocalization($localization)
    {
        if ($this->getLocalizations()->contains($localization)) {
            $this->collLocalizations->remove($this->collLocalizations->search($localization));
            if (null === $this->localizationsScheduledForDeletion) {
                $this->localizationsScheduledForDeletion = clone $this->collLocalizations;
                $this->localizationsScheduledForDeletion->clear();
            }
            $this->localizationsScheduledForDeletion[]= $localization;
            $localization->setLanguage(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related Localizations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Localization[] List of Localization objects
     */
    public function getLocalizationsJoinLocalizationRelatedByParentId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LocalizationQuery::create(null, $criteria);
        $query->joinWith('LocalizationRelatedByParentId', $join_behavior);

        return $this->getLocalizations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related Localizations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Localization[] List of Localization objects
     */
    public function getLocalizationsJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LocalizationQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getLocalizations($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->alpha_2 = null;
        $this->alpha_3t = null;
        $this->alpha_3b = null;
        $this->alpha_3 = null;
        $this->local_name = null;
        $this->en_name = null;
        $this->collate = null;
        $this->scope_id = null;
        $this->type_id = null;
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
            if ($this->collLocalizations) {
                foreach ($this->collLocalizations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collLocalizations instanceof PropelCollection) {
            $this->collLocalizations->clearIterator();
        }
        $this->collLocalizations = null;
        $this->aLanguageScope = null;
        $this->aLanguageType = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LanguagePeer::DEFAULT_STRING_FORMAT);
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
