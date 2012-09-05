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
use keeko\entities\Country;
use keeko\entities\CountryQuery;
use keeko\entities\Subdivision;
use keeko\entities\SubdivisionPeer;
use keeko\entities\SubdivisionQuery;
use keeko\entities\SubdivisionType;
use keeko\entities\SubdivisionTypeQuery;
use keeko\entities\User;
use keeko\entities\UserQuery;

/**
 * Base class that represents a row from the 'keeko_subdivision' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseSubdivision extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\SubdivisionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SubdivisionPeer
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
     * The value for the iso field.
     * @var        string
     */
    protected $iso;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

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
     * The value for the alt_names field.
     * @var        string
     */
    protected $alt_names;

    /**
     * The value for the parent_id field.
     * @var        int
     */
    protected $parent_id;

    /**
     * The value for the country_iso_nr field.
     * @var        int
     */
    protected $country_iso_nr;

    /**
     * The value for the subdivision_type_id field.
     * @var        int
     */
    protected $subdivision_type_id;

    /**
     * @var        Country
     */
    protected $aCountry;

    /**
     * @var        SubdivisionType
     */
    protected $aSubdivisionType;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

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
    protected $usersScheduledForDeletion = null;

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
     * Get the [iso] column value.
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the [alt_names] column value.
     *
     * @return string
     */
    public function getAltNames()
    {
        return $this->alt_names;
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
     * Get the [country_iso_nr] column value.
     *
     * @return int
     */
    public function getCountryIsoNr()
    {
        return $this->country_iso_nr;
    }

    /**
     * Get the [subdivision_type_id] column value.
     *
     * @return int
     */
    public function getSubdivisionTypeId()
    {
        return $this->subdivision_type_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = SubdivisionPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [iso] column.
     *
     * @param string $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setIso($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->iso !== $v) {
            $this->iso = $v;
            $this->modifiedColumns[] = SubdivisionPeer::ISO;
        }


        return $this;
    } // setIso()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = SubdivisionPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [local_name] column.
     *
     * @param string $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setLocalName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->local_name !== $v) {
            $this->local_name = $v;
            $this->modifiedColumns[] = SubdivisionPeer::LOCAL_NAME;
        }


        return $this;
    } // setLocalName()

    /**
     * Set the value of [en_name] column.
     *
     * @param string $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setEnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->en_name !== $v) {
            $this->en_name = $v;
            $this->modifiedColumns[] = SubdivisionPeer::EN_NAME;
        }


        return $this;
    } // setEnName()

    /**
     * Set the value of [alt_names] column.
     *
     * @param string $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setAltNames($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alt_names !== $v) {
            $this->alt_names = $v;
            $this->modifiedColumns[] = SubdivisionPeer::ALT_NAMES;
        }


        return $this;
    } // setAltNames()

    /**
     * Set the value of [parent_id] column.
     *
     * @param int $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[] = SubdivisionPeer::PARENT_ID;
        }


        return $this;
    } // setParentId()

    /**
     * Set the value of [country_iso_nr] column.
     *
     * @param int $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setCountryIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_iso_nr !== $v) {
            $this->country_iso_nr = $v;
            $this->modifiedColumns[] = SubdivisionPeer::COUNTRY_ISO_NR;
        }

        if ($this->aCountry !== null && $this->aCountry->getIsoNr() !== $v) {
            $this->aCountry = null;
        }


        return $this;
    } // setCountryIsoNr()

    /**
     * Set the value of [subdivision_type_id] column.
     *
     * @param int $v new value
     * @return Subdivision The current object (for fluent API support)
     */
    public function setSubdivisionTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->subdivision_type_id !== $v) {
            $this->subdivision_type_id = $v;
            $this->modifiedColumns[] = SubdivisionPeer::SUBDIVISION_TYPE_ID;
        }

        if ($this->aSubdivisionType !== null && $this->aSubdivisionType->getId() !== $v) {
            $this->aSubdivisionType = null;
        }


        return $this;
    } // setSubdivisionTypeId()

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
            $this->iso = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->local_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->en_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->alt_names = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->parent_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->country_iso_nr = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->subdivision_type_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SubdivisionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Subdivision object", $e);
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

        if ($this->aCountry !== null && $this->country_iso_nr !== $this->aCountry->getIsoNr()) {
            $this->aCountry = null;
        }
        if ($this->aSubdivisionType !== null && $this->subdivision_type_id !== $this->aSubdivisionType->getId()) {
            $this->aSubdivisionType = null;
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
            $con = Propel::getConnection(SubdivisionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SubdivisionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->aSubdivisionType = null;
            $this->collUsers = null;

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
            $con = Propel::getConnection(SubdivisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SubdivisionQuery::create()
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
            $con = Propel::getConnection(SubdivisionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SubdivisionPeer::addInstanceToPool($this);
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

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->aSubdivisionType !== null) {
                if ($this->aSubdivisionType->isModified() || $this->aSubdivisionType->isNew()) {
                    $affectedRows += $this->aSubdivisionType->save($con);
                }
                $this->setSubdivisionType($this->aSubdivisionType);
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

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersScheduledForDeletion as $user) {
                        // need to save related object because we set the relation to null
                        $user->save($con);
                    }
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
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

        $this->modifiedColumns[] = SubdivisionPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SubdivisionPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SubdivisionPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(SubdivisionPeer::ISO)) {
            $modifiedColumns[':p' . $index++]  = '`ISO`';
        }
        if ($this->isColumnModified(SubdivisionPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(SubdivisionPeer::LOCAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`LOCAL_NAME`';
        }
        if ($this->isColumnModified(SubdivisionPeer::EN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`EN_NAME`';
        }
        if ($this->isColumnModified(SubdivisionPeer::ALT_NAMES)) {
            $modifiedColumns[':p' . $index++]  = '`ALT_NAMES`';
        }
        if ($this->isColumnModified(SubdivisionPeer::PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PARENT_ID`';
        }
        if ($this->isColumnModified(SubdivisionPeer::COUNTRY_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY_ISO_NR`';
        }
        if ($this->isColumnModified(SubdivisionPeer::SUBDIVISION_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`SUBDIVISION_TYPE_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_subdivision` (%s) VALUES (%s)',
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
                    case '`ISO`':
                        $stmt->bindValue($identifier, $this->iso, PDO::PARAM_STR);
                        break;
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`LOCAL_NAME`':
                        $stmt->bindValue($identifier, $this->local_name, PDO::PARAM_STR);
                        break;
                    case '`EN_NAME`':
                        $stmt->bindValue($identifier, $this->en_name, PDO::PARAM_STR);
                        break;
                    case '`ALT_NAMES`':
                        $stmt->bindValue($identifier, $this->alt_names, PDO::PARAM_STR);
                        break;
                    case '`PARENT_ID`':
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                    case '`COUNTRY_ISO_NR`':
                        $stmt->bindValue($identifier, $this->country_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`SUBDIVISION_TYPE_ID`':
                        $stmt->bindValue($identifier, $this->subdivision_type_id, PDO::PARAM_INT);
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

            if ($this->aCountry !== null) {
                if (!$this->aCountry->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
                }
            }

            if ($this->aSubdivisionType !== null) {
                if (!$this->aSubdivisionType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSubdivisionType->getValidationFailures());
                }
            }


            if (($retval = SubdivisionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collUsers !== null) {
                    foreach ($this->collUsers as $referrerFK) {
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
        $pos = SubdivisionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIso();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getLocalName();
                break;
            case 4:
                return $this->getEnName();
                break;
            case 5:
                return $this->getAltNames();
                break;
            case 6:
                return $this->getParentId();
                break;
            case 7:
                return $this->getCountryIsoNr();
                break;
            case 8:
                return $this->getSubdivisionTypeId();
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
        if (isset($alreadyDumpedObjects['Subdivision'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Subdivision'][$this->getPrimaryKey()] = true;
        $keys = SubdivisionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIso(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getLocalName(),
            $keys[4] => $this->getEnName(),
            $keys[5] => $this->getAltNames(),
            $keys[6] => $this->getParentId(),
            $keys[7] => $this->getCountryIsoNr(),
            $keys[8] => $this->getSubdivisionTypeId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {
                $result['Country'] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSubdivisionType) {
                $result['SubdivisionType'] = $this->aSubdivisionType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUsers) {
                $result['Users'] = $this->collUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SubdivisionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIso($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setLocalName($value);
                break;
            case 4:
                $this->setEnName($value);
                break;
            case 5:
                $this->setAltNames($value);
                break;
            case 6:
                $this->setParentId($value);
                break;
            case 7:
                $this->setCountryIsoNr($value);
                break;
            case 8:
                $this->setSubdivisionTypeId($value);
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
        $keys = SubdivisionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setIso($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLocalName($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEnName($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAltNames($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setParentId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCountryIsoNr($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSubdivisionTypeId($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SubdivisionPeer::DATABASE_NAME);

        if ($this->isColumnModified(SubdivisionPeer::ID)) $criteria->add(SubdivisionPeer::ID, $this->id);
        if ($this->isColumnModified(SubdivisionPeer::ISO)) $criteria->add(SubdivisionPeer::ISO, $this->iso);
        if ($this->isColumnModified(SubdivisionPeer::NAME)) $criteria->add(SubdivisionPeer::NAME, $this->name);
        if ($this->isColumnModified(SubdivisionPeer::LOCAL_NAME)) $criteria->add(SubdivisionPeer::LOCAL_NAME, $this->local_name);
        if ($this->isColumnModified(SubdivisionPeer::EN_NAME)) $criteria->add(SubdivisionPeer::EN_NAME, $this->en_name);
        if ($this->isColumnModified(SubdivisionPeer::ALT_NAMES)) $criteria->add(SubdivisionPeer::ALT_NAMES, $this->alt_names);
        if ($this->isColumnModified(SubdivisionPeer::PARENT_ID)) $criteria->add(SubdivisionPeer::PARENT_ID, $this->parent_id);
        if ($this->isColumnModified(SubdivisionPeer::COUNTRY_ISO_NR)) $criteria->add(SubdivisionPeer::COUNTRY_ISO_NR, $this->country_iso_nr);
        if ($this->isColumnModified(SubdivisionPeer::SUBDIVISION_TYPE_ID)) $criteria->add(SubdivisionPeer::SUBDIVISION_TYPE_ID, $this->subdivision_type_id);

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
        $criteria = new Criteria(SubdivisionPeer::DATABASE_NAME);
        $criteria->add(SubdivisionPeer::ID, $this->id);

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
     * @param object $copyObj An object of Subdivision (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIso($this->getIso());
        $copyObj->setName($this->getName());
        $copyObj->setLocalName($this->getLocalName());
        $copyObj->setEnName($this->getEnName());
        $copyObj->setAltNames($this->getAltNames());
        $copyObj->setParentId($this->getParentId());
        $copyObj->setCountryIsoNr($this->getCountryIsoNr());
        $copyObj->setSubdivisionTypeId($this->getSubdivisionTypeId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
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
     * @return Subdivision Clone of current object.
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
     * @return SubdivisionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SubdivisionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Country object.
     *
     * @param             Country $v
     * @return Subdivision The current object (for fluent API support)
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
            $v->addSubdivision($this);
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
                $this->aCountry->addSubdivisions($this);
             */
        }

        return $this->aCountry;
    }

    /**
     * Declares an association between this object and a SubdivisionType object.
     *
     * @param             SubdivisionType $v
     * @return Subdivision The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSubdivisionType(SubdivisionType $v = null)
    {
        if ($v === null) {
            $this->setSubdivisionTypeId(NULL);
        } else {
            $this->setSubdivisionTypeId($v->getId());
        }

        $this->aSubdivisionType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SubdivisionType object, it will not be re-added.
        if ($v !== null) {
            $v->addSubdivision($this);
        }


        return $this;
    }


    /**
     * Get the associated SubdivisionType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return SubdivisionType The associated SubdivisionType object.
     * @throws PropelException
     */
    public function getSubdivisionType(PropelPDO $con = null)
    {
        if ($this->aSubdivisionType === null && ($this->subdivision_type_id !== null)) {
            $this->aSubdivisionType = SubdivisionTypeQuery::create()->findPk($this->subdivision_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSubdivisionType->addSubdivisions($this);
             */
        }

        return $this->aSubdivisionType;
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
        if ('User' == $relationName) {
            $this->initUsers();
        }
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to null since that means it is uninitialized
        $this->collUsersPartial = null;
    }

    /**
     * reset is the collUsers collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }
        $this->collUsers = new PropelObjectCollection();
        $this->collUsers->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Subdivision is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = UserQuery::create(null, $criteria)
                    ->filterBySubdivision($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                      $this->initUsers(false);

                      foreach($collUsers as $obj) {
                        if (false == $this->collUsers->contains($obj)) {
                          $this->collUsers->append($obj);
                        }
                      }

                      $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if($partial && $this->collUsers) {
                    foreach($this->collUsers as $obj) {
                        if($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of User objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $users A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setUsers(PropelCollection $users, PropelPDO $con = null)
    {
        $this->usersScheduledForDeletion = $this->getUsers(new Criteria(), $con)->diff($users);

        foreach ($this->usersScheduledForDeletion as $userRemoved) {
            $userRemoved->setSubdivision(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getUsers());
                }
                $query = UserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySubdivision($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsers);
        }
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return Subdivision The current object (for fluent API support)
     */
    public function addUser(User $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }
        if (!in_array($l, $this->collUsers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUser($l);
        }

        return $this;
    }

    /**
     * @param	User $user The user object to add.
     */
    protected function doAddUser($user)
    {
        $this->collUsers[]= $user;
        $user->setSubdivision($this);
    }

    /**
     * @param	User $user The user object to remove.
     */
    public function removeUser($user)
    {
        if ($this->getUsers()->contains($user)) {
            $this->collUsers->remove($this->collUsers->search($user));
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
            $user->setSubdivision(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Subdivision is new, it will return
     * an empty collection; or if this Subdivision has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Subdivision.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|User[] List of User objects
     */
    public function getUsersJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UserQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getUsers($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->iso = null;
        $this->name = null;
        $this->local_name = null;
        $this->en_name = null;
        $this->alt_names = null;
        $this->parent_id = null;
        $this->country_iso_nr = null;
        $this->subdivision_type_id = null;
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
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
        $this->aCountry = null;
        $this->aSubdivisionType = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SubdivisionPeer::DEFAULT_STRING_FORMAT);
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
