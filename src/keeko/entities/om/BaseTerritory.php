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
use keeko\entities\Territory;
use keeko\entities\TerritoryPeer;
use keeko\entities\TerritoryQuery;

/**
 * Base class that represents a row from the 'keeko_territory' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseTerritory extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\TerritoryPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TerritoryPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the iso_nr field.
     * @var        int
     */
    protected $iso_nr;

    /**
     * The value for the parent_iso_nr field.
     * @var        int
     */
    protected $parent_iso_nr;

    /**
     * The value for the name_en field.
     * @var        string
     */
    protected $name_en;

    /**
     * @var        PropelObjectCollection|Country[] Collection to store aggregation of Country objects.
     */
    protected $collCountrys;
    protected $collCountrysPartial;

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
    protected $countrysScheduledForDeletion = null;

    /**
     * Get the [iso_nr] column value.
     *
     * @return int
     */
    public function getIsoNr()
    {
        return $this->iso_nr;
    }

    /**
     * Get the [parent_iso_nr] column value.
     *
     * @return int
     */
    public function getParentIsoNr()
    {
        return $this->parent_iso_nr;
    }

    /**
     * Get the [name_en] column value.
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * Set the value of [iso_nr] column.
     *
     * @param int $v new value
     * @return Territory The current object (for fluent API support)
     */
    public function setIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iso_nr !== $v) {
            $this->iso_nr = $v;
            $this->modifiedColumns[] = TerritoryPeer::ISO_NR;
        }


        return $this;
    } // setIsoNr()

    /**
     * Set the value of [parent_iso_nr] column.
     *
     * @param int $v new value
     * @return Territory The current object (for fluent API support)
     */
    public function setParentIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_iso_nr !== $v) {
            $this->parent_iso_nr = $v;
            $this->modifiedColumns[] = TerritoryPeer::PARENT_ISO_NR;
        }


        return $this;
    } // setParentIsoNr()

    /**
     * Set the value of [name_en] column.
     *
     * @param string $v new value
     * @return Territory The current object (for fluent API support)
     */
    public function setNameEn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name_en !== $v) {
            $this->name_en = $v;
            $this->modifiedColumns[] = TerritoryPeer::NAME_EN;
        }


        return $this;
    } // setNameEn()

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

            $this->iso_nr = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->parent_iso_nr = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->name_en = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = TerritoryPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Territory object", $e);
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
            $con = Propel::getConnection(TerritoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TerritoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCountrys = null;

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
            $con = Propel::getConnection(TerritoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TerritoryQuery::create()
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
            $con = Propel::getConnection(TerritoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TerritoryPeer::addInstanceToPool($this);
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

            if ($this->countrysScheduledForDeletion !== null) {
                if (!$this->countrysScheduledForDeletion->isEmpty()) {
                    CountryQuery::create()
                        ->filterByPrimaryKeys($this->countrysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->countrysScheduledForDeletion = null;
                }
            }

            if ($this->collCountrys !== null) {
                foreach ($this->collCountrys as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TerritoryPeer::ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`ISO_NR`';
        }
        if ($this->isColumnModified(TerritoryPeer::PARENT_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`PARENT_ISO_NR`';
        }
        if ($this->isColumnModified(TerritoryPeer::NAME_EN)) {
            $modifiedColumns[':p' . $index++]  = '`NAME_EN`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_territory` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ISO_NR`':
                        $stmt->bindValue($identifier, $this->iso_nr, PDO::PARAM_INT);
                        break;
                    case '`PARENT_ISO_NR`':
                        $stmt->bindValue($identifier, $this->parent_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`NAME_EN`':
                        $stmt->bindValue($identifier, $this->name_en, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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


            if (($retval = TerritoryPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collCountrys !== null) {
                    foreach ($this->collCountrys as $referrerFK) {
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
        $pos = TerritoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIsoNr();
                break;
            case 1:
                return $this->getParentIsoNr();
                break;
            case 2:
                return $this->getNameEn();
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
        if (isset($alreadyDumpedObjects['Territory'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Territory'][$this->getPrimaryKey()] = true;
        $keys = TerritoryPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIsoNr(),
            $keys[1] => $this->getParentIsoNr(),
            $keys[2] => $this->getNameEn(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collCountrys) {
                $result['Countrys'] = $this->collCountrys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TerritoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIsoNr($value);
                break;
            case 1:
                $this->setParentIsoNr($value);
                break;
            case 2:
                $this->setNameEn($value);
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
        $keys = TerritoryPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIsoNr($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setParentIsoNr($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNameEn($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TerritoryPeer::DATABASE_NAME);

        if ($this->isColumnModified(TerritoryPeer::ISO_NR)) $criteria->add(TerritoryPeer::ISO_NR, $this->iso_nr);
        if ($this->isColumnModified(TerritoryPeer::PARENT_ISO_NR)) $criteria->add(TerritoryPeer::PARENT_ISO_NR, $this->parent_iso_nr);
        if ($this->isColumnModified(TerritoryPeer::NAME_EN)) $criteria->add(TerritoryPeer::NAME_EN, $this->name_en);

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
        $criteria = new Criteria(TerritoryPeer::DATABASE_NAME);
        $criteria->add(TerritoryPeer::ISO_NR, $this->iso_nr);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIsoNr();
    }

    /**
     * Generic method to set the primary key (iso_nr column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIsoNr($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIsoNr();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Territory (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setParentIsoNr($this->getParentIsoNr());
        $copyObj->setNameEn($this->getNameEn());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getCountrys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountry($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIsoNr(NULL); // this is a auto-increment column, so set to default value
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
     * @return Territory Clone of current object.
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
     * @return TerritoryPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TerritoryPeer();
        }

        return self::$peer;
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
        if ('Country' == $relationName) {
            $this->initCountrys();
        }
    }

    /**
     * Clears out the collCountrys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCountrys()
     */
    public function clearCountrys()
    {
        $this->collCountrys = null; // important to set this to null since that means it is uninitialized
        $this->collCountrysPartial = null;
    }

    /**
     * reset is the collCountrys collection loaded partially
     *
     * @return void
     */
    public function resetPartialCountrys($v = true)
    {
        $this->collCountrysPartial = $v;
    }

    /**
     * Initializes the collCountrys collection.
     *
     * By default this just sets the collCountrys collection to an empty array (like clearcollCountrys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountrys($overrideExisting = true)
    {
        if (null !== $this->collCountrys && !$overrideExisting) {
            return;
        }
        $this->collCountrys = new PropelObjectCollection();
        $this->collCountrys->setModel('Country');
    }

    /**
     * Gets an array of Country objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Territory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Country[] List of Country objects
     * @throws PropelException
     */
    public function getCountrys($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountrysPartial && !$this->isNew();
        if (null === $this->collCountrys || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCountrys) {
                // return empty collection
                $this->initCountrys();
            } else {
                $collCountrys = CountryQuery::create(null, $criteria)
                    ->filterByTerritory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountrysPartial && count($collCountrys)) {
                      $this->initCountrys(false);

                      foreach($collCountrys as $obj) {
                        if (false == $this->collCountrys->contains($obj)) {
                          $this->collCountrys->append($obj);
                        }
                      }

                      $this->collCountrysPartial = true;
                    }

                    return $collCountrys;
                }

                if($partial && $this->collCountrys) {
                    foreach($this->collCountrys as $obj) {
                        if($obj->isNew()) {
                            $collCountrys[] = $obj;
                        }
                    }
                }

                $this->collCountrys = $collCountrys;
                $this->collCountrysPartial = false;
            }
        }

        return $this->collCountrys;
    }

    /**
     * Sets a collection of Country objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $countrys A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCountrys(PropelCollection $countrys, PropelPDO $con = null)
    {
        $this->countrysScheduledForDeletion = $this->getCountrys(new Criteria(), $con)->diff($countrys);

        foreach ($this->countrysScheduledForDeletion as $countryRemoved) {
            $countryRemoved->setTerritory(null);
        }

        $this->collCountrys = null;
        foreach ($countrys as $country) {
            $this->addCountry($country);
        }

        $this->collCountrys = $countrys;
        $this->collCountrysPartial = false;
    }

    /**
     * Returns the number of related Country objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Country objects.
     * @throws PropelException
     */
    public function countCountrys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountrysPartial && !$this->isNew();
        if (null === $this->collCountrys || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountrys) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCountrys());
                }
                $query = CountryQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTerritory($this)
                    ->count($con);
            }
        } else {
            return count($this->collCountrys);
        }
    }

    /**
     * Method called to associate a Country object to this object
     * through the Country foreign key attribute.
     *
     * @param    Country $l Country
     * @return Territory The current object (for fluent API support)
     */
    public function addCountry(Country $l)
    {
        if ($this->collCountrys === null) {
            $this->initCountrys();
            $this->collCountrysPartial = true;
        }
        if (!in_array($l, $this->collCountrys->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCountry($l);
        }

        return $this;
    }

    /**
     * @param	Country $country The country object to add.
     */
    protected function doAddCountry($country)
    {
        $this->collCountrys[]= $country;
        $country->setTerritory($this);
    }

    /**
     * @param	Country $country The country object to remove.
     */
    public function removeCountry($country)
    {
        if ($this->getCountrys()->contains($country)) {
            $this->collCountrys->remove($this->collCountrys->search($country));
            if (null === $this->countrysScheduledForDeletion) {
                $this->countrysScheduledForDeletion = clone $this->collCountrys;
                $this->countrysScheduledForDeletion->clear();
            }
            $this->countrysScheduledForDeletion[]= $country;
            $country->setTerritory(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territory is new, it will return
     * an empty collection; or if this Territory has previously
     * been saved, it will retrieve related Countrys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territory.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Country[] List of Country objects
     */
    public function getCountrysJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getCountrys($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->iso_nr = null;
        $this->parent_iso_nr = null;
        $this->name_en = null;
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
            if ($this->collCountrys) {
                foreach ($this->collCountrys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collCountrys instanceof PropelCollection) {
            $this->collCountrys->clearIterator();
        }
        $this->collCountrys = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TerritoryPeer::DEFAULT_STRING_FORMAT);
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
