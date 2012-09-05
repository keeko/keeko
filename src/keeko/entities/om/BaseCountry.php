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
use keeko\entities\CountryPeer;
use keeko\entities\CountryQuery;
use keeko\entities\Currency;
use keeko\entities\CurrencyQuery;
use keeko\entities\Localization;
use keeko\entities\LocalizationQuery;
use keeko\entities\Subdivision;
use keeko\entities\SubdivisionQuery;
use keeko\entities\Territory;
use keeko\entities\TerritoryQuery;
use keeko\entities\User;
use keeko\entities\UserQuery;

/**
 * Base class that represents a row from the 'keeko_country' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseCountry extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\CountryPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        CountryPeer
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
     * The value for the alpha_2 field.
     * @var        string
     */
    protected $alpha_2;

    /**
     * The value for the alpha_3 field.
     * @var        string
     */
    protected $alpha_3;

    /**
     * The value for the ioc field.
     * @var        string
     */
    protected $ioc;

    /**
     * The value for the capital field.
     * @var        string
     */
    protected $capital;

    /**
     * The value for the tld field.
     * @var        string
     */
    protected $tld;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the territory_iso_nr field.
     * @var        int
     */
    protected $territory_iso_nr;

    /**
     * The value for the currency_iso_nr field.
     * @var        int
     */
    protected $currency_iso_nr;

    /**
     * The value for the official_local_name field.
     * @var        string
     */
    protected $official_local_name;

    /**
     * The value for the official_en_name field.
     * @var        string
     */
    protected $official_en_name;

    /**
     * The value for the short_local_name field.
     * @var        string
     */
    protected $short_local_name;

    /**
     * The value for the short_en_name field.
     * @var        string
     */
    protected $short_en_name;

    /**
     * The value for the bbox_sw_lat field.
     * @var        double
     */
    protected $bbox_sw_lat;

    /**
     * The value for the bbox_sw_lng field.
     * @var        double
     */
    protected $bbox_sw_lng;

    /**
     * The value for the bbox_ne_lat field.
     * @var        double
     */
    protected $bbox_ne_lat;

    /**
     * The value for the bbox_ne_lng field.
     * @var        double
     */
    protected $bbox_ne_lng;

    /**
     * @var        Territory
     */
    protected $aTerritory;

    /**
     * @var        Currency
     */
    protected $aCurrency;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * @var        PropelObjectCollection|Localization[] Collection to store aggregation of Localization objects.
     */
    protected $collLocalizations;
    protected $collLocalizationsPartial;

    /**
     * @var        PropelObjectCollection|Subdivision[] Collection to store aggregation of Subdivision objects.
     */
    protected $collSubdivisions;
    protected $collSubdivisionsPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $localizationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $subdivisionsScheduledForDeletion = null;

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
     * Get the [alpha_2] column value.
     *
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha_2;
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
     * Get the [ioc] column value.
     *
     * @return string
     */
    public function getIoc()
    {
        return $this->ioc;
    }

    /**
     * Get the [capital] column value.
     *
     * @return string
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Get the [tld] column value.
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [territory_iso_nr] column value.
     *
     * @return int
     */
    public function getTerritoryIsoNr()
    {
        return $this->territory_iso_nr;
    }

    /**
     * Get the [currency_iso_nr] column value.
     *
     * @return int
     */
    public function getCurrencyIsoNr()
    {
        return $this->currency_iso_nr;
    }

    /**
     * Get the [official_local_name] column value.
     *
     * @return string
     */
    public function getOfficialLocalName()
    {
        return $this->official_local_name;
    }

    /**
     * Get the [official_en_name] column value.
     *
     * @return string
     */
    public function getOfficialEnName()
    {
        return $this->official_en_name;
    }

    /**
     * Get the [short_local_name] column value.
     *
     * @return string
     */
    public function getShortLocalName()
    {
        return $this->short_local_name;
    }

    /**
     * Get the [short_en_name] column value.
     *
     * @return string
     */
    public function getShortEnName()
    {
        return $this->short_en_name;
    }

    /**
     * Get the [bbox_sw_lat] column value.
     *
     * @return double
     */
    public function getBboxSwLat()
    {
        return $this->bbox_sw_lat;
    }

    /**
     * Get the [bbox_sw_lng] column value.
     *
     * @return double
     */
    public function getBboxSwLng()
    {
        return $this->bbox_sw_lng;
    }

    /**
     * Get the [bbox_ne_lat] column value.
     *
     * @return double
     */
    public function getBboxNeLat()
    {
        return $this->bbox_ne_lat;
    }

    /**
     * Get the [bbox_ne_lng] column value.
     *
     * @return double
     */
    public function getBboxNeLng()
    {
        return $this->bbox_ne_lng;
    }

    /**
     * Set the value of [iso_nr] column.
     *
     * @param int $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iso_nr !== $v) {
            $this->iso_nr = $v;
            $this->modifiedColumns[] = CountryPeer::ISO_NR;
        }


        return $this;
    } // setIsoNr()

    /**
     * Set the value of [alpha_2] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setAlpha2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_2 !== $v) {
            $this->alpha_2 = $v;
            $this->modifiedColumns[] = CountryPeer::ALPHA_2;
        }


        return $this;
    } // setAlpha2()

    /**
     * Set the value of [alpha_3] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setAlpha3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alpha_3 !== $v) {
            $this->alpha_3 = $v;
            $this->modifiedColumns[] = CountryPeer::ALPHA_3;
        }


        return $this;
    } // setAlpha3()

    /**
     * Set the value of [ioc] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setIoc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ioc !== $v) {
            $this->ioc = $v;
            $this->modifiedColumns[] = CountryPeer::IOC;
        }


        return $this;
    } // setIoc()

    /**
     * Set the value of [capital] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setCapital($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->capital !== $v) {
            $this->capital = $v;
            $this->modifiedColumns[] = CountryPeer::CAPITAL;
        }


        return $this;
    } // setCapital()

    /**
     * Set the value of [tld] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setTld($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tld !== $v) {
            $this->tld = $v;
            $this->modifiedColumns[] = CountryPeer::TLD;
        }


        return $this;
    } // setTld()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[] = CountryPeer::PHONE;
        }


        return $this;
    } // setPhone()

    /**
     * Set the value of [territory_iso_nr] column.
     *
     * @param int $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setTerritoryIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_iso_nr !== $v) {
            $this->territory_iso_nr = $v;
            $this->modifiedColumns[] = CountryPeer::TERRITORY_ISO_NR;
        }

        if ($this->aTerritory !== null && $this->aTerritory->getIsoNr() !== $v) {
            $this->aTerritory = null;
        }


        return $this;
    } // setTerritoryIsoNr()

    /**
     * Set the value of [currency_iso_nr] column.
     *
     * @param int $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setCurrencyIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->currency_iso_nr !== $v) {
            $this->currency_iso_nr = $v;
            $this->modifiedColumns[] = CountryPeer::CURRENCY_ISO_NR;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getIsoNr() !== $v) {
            $this->aCurrency = null;
        }


        return $this;
    } // setCurrencyIsoNr()

    /**
     * Set the value of [official_local_name] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setOfficialLocalName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->official_local_name !== $v) {
            $this->official_local_name = $v;
            $this->modifiedColumns[] = CountryPeer::OFFICIAL_LOCAL_NAME;
        }


        return $this;
    } // setOfficialLocalName()

    /**
     * Set the value of [official_en_name] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setOfficialEnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->official_en_name !== $v) {
            $this->official_en_name = $v;
            $this->modifiedColumns[] = CountryPeer::OFFICIAL_EN_NAME;
        }


        return $this;
    } // setOfficialEnName()

    /**
     * Set the value of [short_local_name] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setShortLocalName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->short_local_name !== $v) {
            $this->short_local_name = $v;
            $this->modifiedColumns[] = CountryPeer::SHORT_LOCAL_NAME;
        }


        return $this;
    } // setShortLocalName()

    /**
     * Set the value of [short_en_name] column.
     *
     * @param string $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setShortEnName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->short_en_name !== $v) {
            $this->short_en_name = $v;
            $this->modifiedColumns[] = CountryPeer::SHORT_EN_NAME;
        }


        return $this;
    } // setShortEnName()

    /**
     * Set the value of [bbox_sw_lat] column.
     *
     * @param double $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setBboxSwLat($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->bbox_sw_lat !== $v) {
            $this->bbox_sw_lat = $v;
            $this->modifiedColumns[] = CountryPeer::BBOX_SW_LAT;
        }


        return $this;
    } // setBboxSwLat()

    /**
     * Set the value of [bbox_sw_lng] column.
     *
     * @param double $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setBboxSwLng($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->bbox_sw_lng !== $v) {
            $this->bbox_sw_lng = $v;
            $this->modifiedColumns[] = CountryPeer::BBOX_SW_LNG;
        }


        return $this;
    } // setBboxSwLng()

    /**
     * Set the value of [bbox_ne_lat] column.
     *
     * @param double $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setBboxNeLat($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->bbox_ne_lat !== $v) {
            $this->bbox_ne_lat = $v;
            $this->modifiedColumns[] = CountryPeer::BBOX_NE_LAT;
        }


        return $this;
    } // setBboxNeLat()

    /**
     * Set the value of [bbox_ne_lng] column.
     *
     * @param double $v new value
     * @return Country The current object (for fluent API support)
     */
    public function setBboxNeLng($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->bbox_ne_lng !== $v) {
            $this->bbox_ne_lng = $v;
            $this->modifiedColumns[] = CountryPeer::BBOX_NE_LNG;
        }


        return $this;
    } // setBboxNeLng()

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
            $this->alpha_2 = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->alpha_3 = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->ioc = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->capital = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->tld = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->phone = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->territory_iso_nr = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->currency_iso_nr = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->official_local_name = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->official_en_name = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->short_local_name = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->short_en_name = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->bbox_sw_lat = ($row[$startcol + 13] !== null) ? (double) $row[$startcol + 13] : null;
            $this->bbox_sw_lng = ($row[$startcol + 14] !== null) ? (double) $row[$startcol + 14] : null;
            $this->bbox_ne_lat = ($row[$startcol + 15] !== null) ? (double) $row[$startcol + 15] : null;
            $this->bbox_ne_lng = ($row[$startcol + 16] !== null) ? (double) $row[$startcol + 16] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = CountryPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Country object", $e);
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

        if ($this->aTerritory !== null && $this->territory_iso_nr !== $this->aTerritory->getIsoNr()) {
            $this->aTerritory = null;
        }
        if ($this->aCurrency !== null && $this->currency_iso_nr !== $this->aCurrency->getIsoNr()) {
            $this->aCurrency = null;
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
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = CountryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTerritory = null;
            $this->aCurrency = null;
            $this->collUsers = null;

            $this->collLocalizations = null;

            $this->collSubdivisions = null;

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
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = CountryQuery::create()
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
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                CountryPeer::addInstanceToPool($this);
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

            if ($this->aTerritory !== null) {
                if ($this->aTerritory->isModified() || $this->aTerritory->isNew()) {
                    $affectedRows += $this->aTerritory->save($con);
                }
                $this->setTerritory($this->aTerritory);
            }

            if ($this->aCurrency !== null) {
                if ($this->aCurrency->isModified() || $this->aCurrency->isNew()) {
                    $affectedRows += $this->aCurrency->save($con);
                }
                $this->setCurrency($this->aCurrency);
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
                    UserQuery::create()
                        ->filterByPrimaryKeys($this->usersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->subdivisionsScheduledForDeletion !== null) {
                if (!$this->subdivisionsScheduledForDeletion->isEmpty()) {
                    SubdivisionQuery::create()
                        ->filterByPrimaryKeys($this->subdivisionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->subdivisionsScheduledForDeletion = null;
                }
            }

            if ($this->collSubdivisions !== null) {
                foreach ($this->collSubdivisions as $referrerFK) {
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
        if ($this->isColumnModified(CountryPeer::ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`ISO_NR`';
        }
        if ($this->isColumnModified(CountryPeer::ALPHA_2)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_2`';
        }
        if ($this->isColumnModified(CountryPeer::ALPHA_3)) {
            $modifiedColumns[':p' . $index++]  = '`ALPHA_3`';
        }
        if ($this->isColumnModified(CountryPeer::IOC)) {
            $modifiedColumns[':p' . $index++]  = '`IOC`';
        }
        if ($this->isColumnModified(CountryPeer::CAPITAL)) {
            $modifiedColumns[':p' . $index++]  = '`CAPITAL`';
        }
        if ($this->isColumnModified(CountryPeer::TLD)) {
            $modifiedColumns[':p' . $index++]  = '`TLD`';
        }
        if ($this->isColumnModified(CountryPeer::PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE`';
        }
        if ($this->isColumnModified(CountryPeer::TERRITORY_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`TERRITORY_ISO_NR`';
        }
        if ($this->isColumnModified(CountryPeer::CURRENCY_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`CURRENCY_ISO_NR`';
        }
        if ($this->isColumnModified(CountryPeer::OFFICIAL_LOCAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`OFFICIAL_LOCAL_NAME`';
        }
        if ($this->isColumnModified(CountryPeer::OFFICIAL_EN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`OFFICIAL_EN_NAME`';
        }
        if ($this->isColumnModified(CountryPeer::SHORT_LOCAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`SHORT_LOCAL_NAME`';
        }
        if ($this->isColumnModified(CountryPeer::SHORT_EN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`SHORT_EN_NAME`';
        }
        if ($this->isColumnModified(CountryPeer::BBOX_SW_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`BBOX_SW_LAT`';
        }
        if ($this->isColumnModified(CountryPeer::BBOX_SW_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`BBOX_SW_LNG`';
        }
        if ($this->isColumnModified(CountryPeer::BBOX_NE_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`BBOX_NE_LAT`';
        }
        if ($this->isColumnModified(CountryPeer::BBOX_NE_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`BBOX_NE_LNG`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_country` (%s) VALUES (%s)',
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
                    case '`ALPHA_2`':
                        $stmt->bindValue($identifier, $this->alpha_2, PDO::PARAM_STR);
                        break;
                    case '`ALPHA_3`':
                        $stmt->bindValue($identifier, $this->alpha_3, PDO::PARAM_STR);
                        break;
                    case '`IOC`':
                        $stmt->bindValue($identifier, $this->ioc, PDO::PARAM_STR);
                        break;
                    case '`CAPITAL`':
                        $stmt->bindValue($identifier, $this->capital, PDO::PARAM_STR);
                        break;
                    case '`TLD`':
                        $stmt->bindValue($identifier, $this->tld, PDO::PARAM_STR);
                        break;
                    case '`PHONE`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`TERRITORY_ISO_NR`':
                        $stmt->bindValue($identifier, $this->territory_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`CURRENCY_ISO_NR`':
                        $stmt->bindValue($identifier, $this->currency_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`OFFICIAL_LOCAL_NAME`':
                        $stmt->bindValue($identifier, $this->official_local_name, PDO::PARAM_STR);
                        break;
                    case '`OFFICIAL_EN_NAME`':
                        $stmt->bindValue($identifier, $this->official_en_name, PDO::PARAM_STR);
                        break;
                    case '`SHORT_LOCAL_NAME`':
                        $stmt->bindValue($identifier, $this->short_local_name, PDO::PARAM_STR);
                        break;
                    case '`SHORT_EN_NAME`':
                        $stmt->bindValue($identifier, $this->short_en_name, PDO::PARAM_STR);
                        break;
                    case '`BBOX_SW_LAT`':
                        $stmt->bindValue($identifier, $this->bbox_sw_lat, PDO::PARAM_STR);
                        break;
                    case '`BBOX_SW_LNG`':
                        $stmt->bindValue($identifier, $this->bbox_sw_lng, PDO::PARAM_STR);
                        break;
                    case '`BBOX_NE_LAT`':
                        $stmt->bindValue($identifier, $this->bbox_ne_lat, PDO::PARAM_STR);
                        break;
                    case '`BBOX_NE_LNG`':
                        $stmt->bindValue($identifier, $this->bbox_ne_lng, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTerritory !== null) {
                if (!$this->aTerritory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTerritory->getValidationFailures());
                }
            }

            if ($this->aCurrency !== null) {
                if (!$this->aCurrency->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCurrency->getValidationFailures());
                }
            }


            if (($retval = CountryPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collUsers !== null) {
                    foreach ($this->collUsers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLocalizations !== null) {
                    foreach ($this->collLocalizations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSubdivisions !== null) {
                    foreach ($this->collSubdivisions as $referrerFK) {
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
        $pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAlpha2();
                break;
            case 2:
                return $this->getAlpha3();
                break;
            case 3:
                return $this->getIoc();
                break;
            case 4:
                return $this->getCapital();
                break;
            case 5:
                return $this->getTld();
                break;
            case 6:
                return $this->getPhone();
                break;
            case 7:
                return $this->getTerritoryIsoNr();
                break;
            case 8:
                return $this->getCurrencyIsoNr();
                break;
            case 9:
                return $this->getOfficialLocalName();
                break;
            case 10:
                return $this->getOfficialEnName();
                break;
            case 11:
                return $this->getShortLocalName();
                break;
            case 12:
                return $this->getShortEnName();
                break;
            case 13:
                return $this->getBboxSwLat();
                break;
            case 14:
                return $this->getBboxSwLng();
                break;
            case 15:
                return $this->getBboxNeLat();
                break;
            case 16:
                return $this->getBboxNeLng();
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
        if (isset($alreadyDumpedObjects['Country'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Country'][$this->getPrimaryKey()] = true;
        $keys = CountryPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIsoNr(),
            $keys[1] => $this->getAlpha2(),
            $keys[2] => $this->getAlpha3(),
            $keys[3] => $this->getIoc(),
            $keys[4] => $this->getCapital(),
            $keys[5] => $this->getTld(),
            $keys[6] => $this->getPhone(),
            $keys[7] => $this->getTerritoryIsoNr(),
            $keys[8] => $this->getCurrencyIsoNr(),
            $keys[9] => $this->getOfficialLocalName(),
            $keys[10] => $this->getOfficialEnName(),
            $keys[11] => $this->getShortLocalName(),
            $keys[12] => $this->getShortEnName(),
            $keys[13] => $this->getBboxSwLat(),
            $keys[14] => $this->getBboxSwLng(),
            $keys[15] => $this->getBboxNeLat(),
            $keys[16] => $this->getBboxNeLng(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTerritory) {
                $result['Territory'] = $this->aTerritory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCurrency) {
                $result['Currency'] = $this->aCurrency->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUsers) {
                $result['Users'] = $this->collUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLocalizations) {
                $result['Localizations'] = $this->collLocalizations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSubdivisions) {
                $result['Subdivisions'] = $this->collSubdivisions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAlpha2($value);
                break;
            case 2:
                $this->setAlpha3($value);
                break;
            case 3:
                $this->setIoc($value);
                break;
            case 4:
                $this->setCapital($value);
                break;
            case 5:
                $this->setTld($value);
                break;
            case 6:
                $this->setPhone($value);
                break;
            case 7:
                $this->setTerritoryIsoNr($value);
                break;
            case 8:
                $this->setCurrencyIsoNr($value);
                break;
            case 9:
                $this->setOfficialLocalName($value);
                break;
            case 10:
                $this->setOfficialEnName($value);
                break;
            case 11:
                $this->setShortLocalName($value);
                break;
            case 12:
                $this->setShortEnName($value);
                break;
            case 13:
                $this->setBboxSwLat($value);
                break;
            case 14:
                $this->setBboxSwLng($value);
                break;
            case 15:
                $this->setBboxNeLat($value);
                break;
            case 16:
                $this->setBboxNeLng($value);
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
        $keys = CountryPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIsoNr($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAlpha2($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAlpha3($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setIoc($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCapital($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTld($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPhone($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setTerritoryIsoNr($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCurrencyIsoNr($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setOfficialLocalName($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setOfficialEnName($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setShortLocalName($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setShortEnName($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setBboxSwLat($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setBboxSwLng($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setBboxNeLat($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setBboxNeLng($arr[$keys[16]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CountryPeer::DATABASE_NAME);

        if ($this->isColumnModified(CountryPeer::ISO_NR)) $criteria->add(CountryPeer::ISO_NR, $this->iso_nr);
        if ($this->isColumnModified(CountryPeer::ALPHA_2)) $criteria->add(CountryPeer::ALPHA_2, $this->alpha_2);
        if ($this->isColumnModified(CountryPeer::ALPHA_3)) $criteria->add(CountryPeer::ALPHA_3, $this->alpha_3);
        if ($this->isColumnModified(CountryPeer::IOC)) $criteria->add(CountryPeer::IOC, $this->ioc);
        if ($this->isColumnModified(CountryPeer::CAPITAL)) $criteria->add(CountryPeer::CAPITAL, $this->capital);
        if ($this->isColumnModified(CountryPeer::TLD)) $criteria->add(CountryPeer::TLD, $this->tld);
        if ($this->isColumnModified(CountryPeer::PHONE)) $criteria->add(CountryPeer::PHONE, $this->phone);
        if ($this->isColumnModified(CountryPeer::TERRITORY_ISO_NR)) $criteria->add(CountryPeer::TERRITORY_ISO_NR, $this->territory_iso_nr);
        if ($this->isColumnModified(CountryPeer::CURRENCY_ISO_NR)) $criteria->add(CountryPeer::CURRENCY_ISO_NR, $this->currency_iso_nr);
        if ($this->isColumnModified(CountryPeer::OFFICIAL_LOCAL_NAME)) $criteria->add(CountryPeer::OFFICIAL_LOCAL_NAME, $this->official_local_name);
        if ($this->isColumnModified(CountryPeer::OFFICIAL_EN_NAME)) $criteria->add(CountryPeer::OFFICIAL_EN_NAME, $this->official_en_name);
        if ($this->isColumnModified(CountryPeer::SHORT_LOCAL_NAME)) $criteria->add(CountryPeer::SHORT_LOCAL_NAME, $this->short_local_name);
        if ($this->isColumnModified(CountryPeer::SHORT_EN_NAME)) $criteria->add(CountryPeer::SHORT_EN_NAME, $this->short_en_name);
        if ($this->isColumnModified(CountryPeer::BBOX_SW_LAT)) $criteria->add(CountryPeer::BBOX_SW_LAT, $this->bbox_sw_lat);
        if ($this->isColumnModified(CountryPeer::BBOX_SW_LNG)) $criteria->add(CountryPeer::BBOX_SW_LNG, $this->bbox_sw_lng);
        if ($this->isColumnModified(CountryPeer::BBOX_NE_LAT)) $criteria->add(CountryPeer::BBOX_NE_LAT, $this->bbox_ne_lat);
        if ($this->isColumnModified(CountryPeer::BBOX_NE_LNG)) $criteria->add(CountryPeer::BBOX_NE_LNG, $this->bbox_ne_lng);

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
        $criteria = new Criteria(CountryPeer::DATABASE_NAME);
        $criteria->add(CountryPeer::ISO_NR, $this->iso_nr);

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
     * @param object $copyObj An object of Country (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAlpha2($this->getAlpha2());
        $copyObj->setAlpha3($this->getAlpha3());
        $copyObj->setIoc($this->getIoc());
        $copyObj->setCapital($this->getCapital());
        $copyObj->setTld($this->getTld());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setTerritoryIsoNr($this->getTerritoryIsoNr());
        $copyObj->setCurrencyIsoNr($this->getCurrencyIsoNr());
        $copyObj->setOfficialLocalName($this->getOfficialLocalName());
        $copyObj->setOfficialEnName($this->getOfficialEnName());
        $copyObj->setShortLocalName($this->getShortLocalName());
        $copyObj->setShortEnName($this->getShortEnName());
        $copyObj->setBboxSwLat($this->getBboxSwLat());
        $copyObj->setBboxSwLng($this->getBboxSwLng());
        $copyObj->setBboxNeLat($this->getBboxNeLat());
        $copyObj->setBboxNeLng($this->getBboxNeLng());

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

            foreach ($this->getLocalizations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocalization($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSubdivisions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSubdivision($relObj->copy($deepCopy));
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
     * @return Country Clone of current object.
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
     * @return CountryPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new CountryPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Territory object.
     *
     * @param             Territory $v
     * @return Country The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTerritory(Territory $v = null)
    {
        if ($v === null) {
            $this->setTerritoryIsoNr(NULL);
        } else {
            $this->setTerritoryIsoNr($v->getIsoNr());
        }

        $this->aTerritory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Territory object, it will not be re-added.
        if ($v !== null) {
            $v->addCountry($this);
        }


        return $this;
    }


    /**
     * Get the associated Territory object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Territory The associated Territory object.
     * @throws PropelException
     */
    public function getTerritory(PropelPDO $con = null)
    {
        if ($this->aTerritory === null && ($this->territory_iso_nr !== null)) {
            $this->aTerritory = TerritoryQuery::create()->findPk($this->territory_iso_nr, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTerritory->addCountrys($this);
             */
        }

        return $this->aTerritory;
    }

    /**
     * Declares an association between this object and a Currency object.
     *
     * @param             Currency $v
     * @return Country The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCurrency(Currency $v = null)
    {
        if ($v === null) {
            $this->setCurrencyIsoNr(NULL);
        } else {
            $this->setCurrencyIsoNr($v->getIsoNr());
        }

        $this->aCurrency = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Currency object, it will not be re-added.
        if ($v !== null) {
            $v->addCountry($this);
        }


        return $this;
    }


    /**
     * Get the associated Currency object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Currency The associated Currency object.
     * @throws PropelException
     */
    public function getCurrency(PropelPDO $con = null)
    {
        if ($this->aCurrency === null && ($this->currency_iso_nr !== null)) {
            $this->aCurrency = CurrencyQuery::create()->findPk($this->currency_iso_nr, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrency->addCountrys($this);
             */
        }

        return $this->aCurrency;
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
        if ('Localization' == $relationName) {
            $this->initLocalizations();
        }
        if ('Subdivision' == $relationName) {
            $this->initSubdivisions();
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
     * If this Country is new, it will return
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
                    ->filterByCountry($this)
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
            $userRemoved->setCountry(null);
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
                    ->filterByCountry($this)
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
     * @return Country The current object (for fluent API support)
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
        $user->setCountry($this);
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
            $user->setCountry(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Country is new, it will return
     * an empty collection; or if this Country has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Country.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|User[] List of User objects
     */
    public function getUsersJoinSubdivision($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UserQuery::create(null, $criteria);
        $query->joinWith('Subdivision', $join_behavior);

        return $this->getUsers($query, $con);
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
     * If this Country is new, it will return
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
                    ->filterByCountry($this)
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
            $localizationRemoved->setCountry(null);
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
                    ->filterByCountry($this)
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
     * @return Country The current object (for fluent API support)
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
        $localization->setCountry($this);
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
            $localization->setCountry(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Country is new, it will return
     * an empty collection; or if this Country has previously
     * been saved, it will retrieve related Localizations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Country.
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
     * Otherwise if this Country is new, it will return
     * an empty collection; or if this Country has previously
     * been saved, it will retrieve related Localizations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Country.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Localization[] List of Localization objects
     */
    public function getLocalizationsJoinLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LocalizationQuery::create(null, $criteria);
        $query->joinWith('Language', $join_behavior);

        return $this->getLocalizations($query, $con);
    }

    /**
     * Clears out the collSubdivisions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSubdivisions()
     */
    public function clearSubdivisions()
    {
        $this->collSubdivisions = null; // important to set this to null since that means it is uninitialized
        $this->collSubdivisionsPartial = null;
    }

    /**
     * reset is the collSubdivisions collection loaded partially
     *
     * @return void
     */
    public function resetPartialSubdivisions($v = true)
    {
        $this->collSubdivisionsPartial = $v;
    }

    /**
     * Initializes the collSubdivisions collection.
     *
     * By default this just sets the collSubdivisions collection to an empty array (like clearcollSubdivisions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSubdivisions($overrideExisting = true)
    {
        if (null !== $this->collSubdivisions && !$overrideExisting) {
            return;
        }
        $this->collSubdivisions = new PropelObjectCollection();
        $this->collSubdivisions->setModel('Subdivision');
    }

    /**
     * Gets an array of Subdivision objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Country is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Subdivision[] List of Subdivision objects
     * @throws PropelException
     */
    public function getSubdivisions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSubdivisionsPartial && !$this->isNew();
        if (null === $this->collSubdivisions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSubdivisions) {
                // return empty collection
                $this->initSubdivisions();
            } else {
                $collSubdivisions = SubdivisionQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSubdivisionsPartial && count($collSubdivisions)) {
                      $this->initSubdivisions(false);

                      foreach($collSubdivisions as $obj) {
                        if (false == $this->collSubdivisions->contains($obj)) {
                          $this->collSubdivisions->append($obj);
                        }
                      }

                      $this->collSubdivisionsPartial = true;
                    }

                    return $collSubdivisions;
                }

                if($partial && $this->collSubdivisions) {
                    foreach($this->collSubdivisions as $obj) {
                        if($obj->isNew()) {
                            $collSubdivisions[] = $obj;
                        }
                    }
                }

                $this->collSubdivisions = $collSubdivisions;
                $this->collSubdivisionsPartial = false;
            }
        }

        return $this->collSubdivisions;
    }

    /**
     * Sets a collection of Subdivision objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $subdivisions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setSubdivisions(PropelCollection $subdivisions, PropelPDO $con = null)
    {
        $this->subdivisionsScheduledForDeletion = $this->getSubdivisions(new Criteria(), $con)->diff($subdivisions);

        foreach ($this->subdivisionsScheduledForDeletion as $subdivisionRemoved) {
            $subdivisionRemoved->setCountry(null);
        }

        $this->collSubdivisions = null;
        foreach ($subdivisions as $subdivision) {
            $this->addSubdivision($subdivision);
        }

        $this->collSubdivisions = $subdivisions;
        $this->collSubdivisionsPartial = false;
    }

    /**
     * Returns the number of related Subdivision objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Subdivision objects.
     * @throws PropelException
     */
    public function countSubdivisions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSubdivisionsPartial && !$this->isNew();
        if (null === $this->collSubdivisions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSubdivisions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getSubdivisions());
                }
                $query = SubdivisionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCountry($this)
                    ->count($con);
            }
        } else {
            return count($this->collSubdivisions);
        }
    }

    /**
     * Method called to associate a Subdivision object to this object
     * through the Subdivision foreign key attribute.
     *
     * @param    Subdivision $l Subdivision
     * @return Country The current object (for fluent API support)
     */
    public function addSubdivision(Subdivision $l)
    {
        if ($this->collSubdivisions === null) {
            $this->initSubdivisions();
            $this->collSubdivisionsPartial = true;
        }
        if (!in_array($l, $this->collSubdivisions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSubdivision($l);
        }

        return $this;
    }

    /**
     * @param	Subdivision $subdivision The subdivision object to add.
     */
    protected function doAddSubdivision($subdivision)
    {
        $this->collSubdivisions[]= $subdivision;
        $subdivision->setCountry($this);
    }

    /**
     * @param	Subdivision $subdivision The subdivision object to remove.
     */
    public function removeSubdivision($subdivision)
    {
        if ($this->getSubdivisions()->contains($subdivision)) {
            $this->collSubdivisions->remove($this->collSubdivisions->search($subdivision));
            if (null === $this->subdivisionsScheduledForDeletion) {
                $this->subdivisionsScheduledForDeletion = clone $this->collSubdivisions;
                $this->subdivisionsScheduledForDeletion->clear();
            }
            $this->subdivisionsScheduledForDeletion[]= $subdivision;
            $subdivision->setCountry(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Country is new, it will return
     * an empty collection; or if this Country has previously
     * been saved, it will retrieve related Subdivisions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Country.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Subdivision[] List of Subdivision objects
     */
    public function getSubdivisionsJoinSubdivisionType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SubdivisionQuery::create(null, $criteria);
        $query->joinWith('SubdivisionType', $join_behavior);

        return $this->getSubdivisions($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->iso_nr = null;
        $this->alpha_2 = null;
        $this->alpha_3 = null;
        $this->ioc = null;
        $this->capital = null;
        $this->tld = null;
        $this->phone = null;
        $this->territory_iso_nr = null;
        $this->currency_iso_nr = null;
        $this->official_local_name = null;
        $this->official_en_name = null;
        $this->short_local_name = null;
        $this->short_en_name = null;
        $this->bbox_sw_lat = null;
        $this->bbox_sw_lng = null;
        $this->bbox_ne_lat = null;
        $this->bbox_ne_lng = null;
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
            if ($this->collLocalizations) {
                foreach ($this->collLocalizations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSubdivisions) {
                foreach ($this->collSubdivisions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
        if ($this->collLocalizations instanceof PropelCollection) {
            $this->collLocalizations->clearIterator();
        }
        $this->collLocalizations = null;
        if ($this->collSubdivisions instanceof PropelCollection) {
            $this->collSubdivisions->clearIterator();
        }
        $this->collSubdivisions = null;
        $this->aTerritory = null;
        $this->aCurrency = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CountryPeer::DEFAULT_STRING_FORMAT);
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
