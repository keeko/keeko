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
use keeko\entities\Currency;
use keeko\entities\CurrencyPeer;
use keeko\entities\CurrencyQuery;

/**
 * Base class that represents a row from the 'keeko_currency' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseCurrency extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\CurrencyPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        CurrencyPeer
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
     * The value for the iso3 field.
     * @var        string
     */
    protected $iso3;

    /**
     * The value for the en_name field.
     * @var        string
     */
    protected $en_name;

    /**
     * The value for the symbol_left field.
     * @var        string
     */
    protected $symbol_left;

    /**
     * The value for the symbol_right field.
     * @var        string
     */
    protected $symbol_right;

    /**
     * The value for the decimal_digits field.
     * @var        int
     */
    protected $decimal_digits;

    /**
     * The value for the sub_divisor field.
     * @var        int
     */
    protected $sub_divisor;

    /**
     * The value for the sub_symbol_left field.
     * @var        string
     */
    protected $sub_symbol_left;

    /**
     * The value for the sub_symbol_right field.
     * @var        string
     */
    protected $sub_symbol_right;

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
     * Get the [iso3] column value.
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
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
     * Get the [symbol_left] column value.
     *
     * @return string
     */
    public function getSymbolLeft()
    {
        return $this->symbol_left;
    }

    /**
     * Get the [symbol_right] column value.
     *
     * @return string
     */
    public function getSymbolRight()
    {
        return $this->symbol_right;
    }

    /**
     * Get the [decimal_digits] column value.
     *
     * @return int
     */
    public function getDecimalDigits()
    {
        return $this->decimal_digits;
    }

    /**
     * Get the [sub_divisor] column value.
     *
     * @return int
     */
    public function getSubDivisor()
    {
        return $this->sub_divisor;
    }

    /**
     * Get the [sub_symbol_left] column value.
     *
     * @return string
     */
    public function getSubSymbolLeft()
    {
        return $this->sub_symbol_left;
    }

    /**
     * Get the [sub_symbol_right] column value.
     *
     * @return string
     */
    public function getSubSymbolRight()
    {
        return $this->sub_symbol_right;
    }

    /**
     * Set the value of [iso_nr] column.
     *
     * @param int $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iso_nr !== $v) {
            $this->iso_nr = $v;
            $this->modifiedColumns[] = CurrencyPeer::ISO_NR;
        }


        return $this;
    } // setIsoNr()

    /**
     * Set the value of [iso3] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setIso3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->iso3 !== $v) {
            $this->iso3 = $v;
            $this->modifiedColumns[] = CurrencyPeer::ISO3;
        }


        return $this;
    } // setIso3()

    /**
     * Set the value of [en_name] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setEnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->en_name !== $v) {
            $this->en_name = $v;
            $this->modifiedColumns[] = CurrencyPeer::EN_NAME;
        }


        return $this;
    } // setEnName()

    /**
     * Set the value of [symbol_left] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setSymbolLeft($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->symbol_left !== $v) {
            $this->symbol_left = $v;
            $this->modifiedColumns[] = CurrencyPeer::SYMBOL_LEFT;
        }


        return $this;
    } // setSymbolLeft()

    /**
     * Set the value of [symbol_right] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setSymbolRight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->symbol_right !== $v) {
            $this->symbol_right = $v;
            $this->modifiedColumns[] = CurrencyPeer::SYMBOL_RIGHT;
        }


        return $this;
    } // setSymbolRight()

    /**
     * Set the value of [decimal_digits] column.
     *
     * @param int $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setDecimalDigits($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->decimal_digits !== $v) {
            $this->decimal_digits = $v;
            $this->modifiedColumns[] = CurrencyPeer::DECIMAL_DIGITS;
        }


        return $this;
    } // setDecimalDigits()

    /**
     * Set the value of [sub_divisor] column.
     *
     * @param int $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setSubDivisor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sub_divisor !== $v) {
            $this->sub_divisor = $v;
            $this->modifiedColumns[] = CurrencyPeer::SUB_DIVISOR;
        }


        return $this;
    } // setSubDivisor()

    /**
     * Set the value of [sub_symbol_left] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setSubSymbolLeft($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sub_symbol_left !== $v) {
            $this->sub_symbol_left = $v;
            $this->modifiedColumns[] = CurrencyPeer::SUB_SYMBOL_LEFT;
        }


        return $this;
    } // setSubSymbolLeft()

    /**
     * Set the value of [sub_symbol_right] column.
     *
     * @param string $v new value
     * @return Currency The current object (for fluent API support)
     */
    public function setSubSymbolRight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sub_symbol_right !== $v) {
            $this->sub_symbol_right = $v;
            $this->modifiedColumns[] = CurrencyPeer::SUB_SYMBOL_RIGHT;
        }


        return $this;
    } // setSubSymbolRight()

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
            $this->iso3 = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->en_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->symbol_left = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->symbol_right = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->decimal_digits = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->sub_divisor = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->sub_symbol_left = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->sub_symbol_right = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = CurrencyPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Currency object", $e);
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
            $con = Propel::getConnection(CurrencyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = CurrencyPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(CurrencyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = CurrencyQuery::create()
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
            $con = Propel::getConnection(CurrencyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                CurrencyPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(CurrencyPeer::ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`ISO_NR`';
        }
        if ($this->isColumnModified(CurrencyPeer::ISO3)) {
            $modifiedColumns[':p' . $index++]  = '`ISO3`';
        }
        if ($this->isColumnModified(CurrencyPeer::EN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`EN_NAME`';
        }
        if ($this->isColumnModified(CurrencyPeer::SYMBOL_LEFT)) {
            $modifiedColumns[':p' . $index++]  = '`SYMBOL_LEFT`';
        }
        if ($this->isColumnModified(CurrencyPeer::SYMBOL_RIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`SYMBOL_RIGHT`';
        }
        if ($this->isColumnModified(CurrencyPeer::DECIMAL_DIGITS)) {
            $modifiedColumns[':p' . $index++]  = '`DECIMAL_DIGITS`';
        }
        if ($this->isColumnModified(CurrencyPeer::SUB_DIVISOR)) {
            $modifiedColumns[':p' . $index++]  = '`SUB_DIVISOR`';
        }
        if ($this->isColumnModified(CurrencyPeer::SUB_SYMBOL_LEFT)) {
            $modifiedColumns[':p' . $index++]  = '`SUB_SYMBOL_LEFT`';
        }
        if ($this->isColumnModified(CurrencyPeer::SUB_SYMBOL_RIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`SUB_SYMBOL_RIGHT`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_currency` (%s) VALUES (%s)',
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
                    case '`ISO3`':
                        $stmt->bindValue($identifier, $this->iso3, PDO::PARAM_STR);
                        break;
                    case '`EN_NAME`':
                        $stmt->bindValue($identifier, $this->en_name, PDO::PARAM_STR);
                        break;
                    case '`SYMBOL_LEFT`':
                        $stmt->bindValue($identifier, $this->symbol_left, PDO::PARAM_STR);
                        break;
                    case '`SYMBOL_RIGHT`':
                        $stmt->bindValue($identifier, $this->symbol_right, PDO::PARAM_STR);
                        break;
                    case '`DECIMAL_DIGITS`':
                        $stmt->bindValue($identifier, $this->decimal_digits, PDO::PARAM_INT);
                        break;
                    case '`SUB_DIVISOR`':
                        $stmt->bindValue($identifier, $this->sub_divisor, PDO::PARAM_INT);
                        break;
                    case '`SUB_SYMBOL_LEFT`':
                        $stmt->bindValue($identifier, $this->sub_symbol_left, PDO::PARAM_STR);
                        break;
                    case '`SUB_SYMBOL_RIGHT`':
                        $stmt->bindValue($identifier, $this->sub_symbol_right, PDO::PARAM_STR);
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


            if (($retval = CurrencyPeer::doValidate($this, $columns)) !== true) {
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
        $pos = CurrencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIso3();
                break;
            case 2:
                return $this->getEnName();
                break;
            case 3:
                return $this->getSymbolLeft();
                break;
            case 4:
                return $this->getSymbolRight();
                break;
            case 5:
                return $this->getDecimalDigits();
                break;
            case 6:
                return $this->getSubDivisor();
                break;
            case 7:
                return $this->getSubSymbolLeft();
                break;
            case 8:
                return $this->getSubSymbolRight();
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
        if (isset($alreadyDumpedObjects['Currency'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Currency'][$this->getPrimaryKey()] = true;
        $keys = CurrencyPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIsoNr(),
            $keys[1] => $this->getIso3(),
            $keys[2] => $this->getEnName(),
            $keys[3] => $this->getSymbolLeft(),
            $keys[4] => $this->getSymbolRight(),
            $keys[5] => $this->getDecimalDigits(),
            $keys[6] => $this->getSubDivisor(),
            $keys[7] => $this->getSubSymbolLeft(),
            $keys[8] => $this->getSubSymbolRight(),
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
        $pos = CurrencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIso3($value);
                break;
            case 2:
                $this->setEnName($value);
                break;
            case 3:
                $this->setSymbolLeft($value);
                break;
            case 4:
                $this->setSymbolRight($value);
                break;
            case 5:
                $this->setDecimalDigits($value);
                break;
            case 6:
                $this->setSubDivisor($value);
                break;
            case 7:
                $this->setSubSymbolLeft($value);
                break;
            case 8:
                $this->setSubSymbolRight($value);
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
        $keys = CurrencyPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIsoNr($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setIso3($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEnName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSymbolLeft($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSymbolRight($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDecimalDigits($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setSubDivisor($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSubSymbolLeft($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSubSymbolRight($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CurrencyPeer::DATABASE_NAME);

        if ($this->isColumnModified(CurrencyPeer::ISO_NR)) $criteria->add(CurrencyPeer::ISO_NR, $this->iso_nr);
        if ($this->isColumnModified(CurrencyPeer::ISO3)) $criteria->add(CurrencyPeer::ISO3, $this->iso3);
        if ($this->isColumnModified(CurrencyPeer::EN_NAME)) $criteria->add(CurrencyPeer::EN_NAME, $this->en_name);
        if ($this->isColumnModified(CurrencyPeer::SYMBOL_LEFT)) $criteria->add(CurrencyPeer::SYMBOL_LEFT, $this->symbol_left);
        if ($this->isColumnModified(CurrencyPeer::SYMBOL_RIGHT)) $criteria->add(CurrencyPeer::SYMBOL_RIGHT, $this->symbol_right);
        if ($this->isColumnModified(CurrencyPeer::DECIMAL_DIGITS)) $criteria->add(CurrencyPeer::DECIMAL_DIGITS, $this->decimal_digits);
        if ($this->isColumnModified(CurrencyPeer::SUB_DIVISOR)) $criteria->add(CurrencyPeer::SUB_DIVISOR, $this->sub_divisor);
        if ($this->isColumnModified(CurrencyPeer::SUB_SYMBOL_LEFT)) $criteria->add(CurrencyPeer::SUB_SYMBOL_LEFT, $this->sub_symbol_left);
        if ($this->isColumnModified(CurrencyPeer::SUB_SYMBOL_RIGHT)) $criteria->add(CurrencyPeer::SUB_SYMBOL_RIGHT, $this->sub_symbol_right);

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
        $criteria = new Criteria(CurrencyPeer::DATABASE_NAME);
        $criteria->add(CurrencyPeer::ISO_NR, $this->iso_nr);

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
     * @param object $copyObj An object of Currency (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIso3($this->getIso3());
        $copyObj->setEnName($this->getEnName());
        $copyObj->setSymbolLeft($this->getSymbolLeft());
        $copyObj->setSymbolRight($this->getSymbolRight());
        $copyObj->setDecimalDigits($this->getDecimalDigits());
        $copyObj->setSubDivisor($this->getSubDivisor());
        $copyObj->setSubSymbolLeft($this->getSubSymbolLeft());
        $copyObj->setSubSymbolRight($this->getSubSymbolRight());

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
     * @return Currency Clone of current object.
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
     * @return CurrencyPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new CurrencyPeer();
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
     * If this Currency is new, it will return
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
                    ->filterByCurrency($this)
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
            $countryRemoved->setCurrency(null);
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
                    ->filterByCurrency($this)
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
     * @return Currency The current object (for fluent API support)
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
        $country->setCurrency($this);
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
            $country->setCurrency(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currency is new, it will return
     * an empty collection; or if this Currency has previously
     * been saved, it will retrieve related Countrys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currency.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Country[] List of Country objects
     */
    public function getCountrysJoinTerritory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('Territory', $join_behavior);

        return $this->getCountrys($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->iso_nr = null;
        $this->iso3 = null;
        $this->en_name = null;
        $this->symbol_left = null;
        $this->symbol_right = null;
        $this->decimal_digits = null;
        $this->sub_divisor = null;
        $this->sub_symbol_left = null;
        $this->sub_symbol_right = null;
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
        return (string) $this->exportTo(CurrencyPeer::DEFAULT_STRING_FORMAT);
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
