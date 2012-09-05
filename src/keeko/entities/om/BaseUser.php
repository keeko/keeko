<?php

namespace keeko\entities\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use keeko\entities\Country;
use keeko\entities\CountryQuery;
use keeko\entities\Group;
use keeko\entities\GroupQuery;
use keeko\entities\GroupUser;
use keeko\entities\GroupUserQuery;
use keeko\entities\Subdivision;
use keeko\entities\SubdivisionQuery;
use keeko\entities\User;
use keeko\entities\UserPeer;
use keeko\entities\UserQuery;

/**
 * Base class that represents a row from the 'keeko_user' table.
 *
 *
 *
 * @package    propel.generator.keeko.entities.om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'keeko\\entities\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
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
     * The value for the login_name field.
     * @var        string
     */
    protected $login_name;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the given_name field.
     * @var        string
     */
    protected $given_name;

    /**
     * The value for the family_name field.
     * @var        string
     */
    protected $family_name;

    /**
     * The value for the display_name field.
     * @var        string
     */
    protected $display_name;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the country_iso_nr field.
     * @var        int
     */
    protected $country_iso_nr;

    /**
     * The value for the subdivision_id field.
     * @var        int
     */
    protected $subdivision_id;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the address2 field.
     * @var        string
     */
    protected $address2;

    /**
     * The value for the birthday field.
     * @var        string
     */
    protected $birthday;

    /**
     * The value for the sex field.
     * @var        int
     */
    protected $sex;

    /**
     * The value for the club field.
     * @var        string
     */
    protected $club;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the postal_code field.
     * @var        string
     */
    protected $postal_code;

    /**
     * The value for the tan field.
     * @var        string
     */
    protected $tan;

    /**
     * The value for the password_recover_code field.
     * @var        string
     */
    protected $password_recover_code;

    /**
     * The value for the password_recover_time field.
     * @var        string
     */
    protected $password_recover_time;

    /**
     * The value for the location_status field.
     * @var        int
     */
    protected $location_status;

    /**
     * The value for the latitude field.
     * @var        double
     */
    protected $latitude;

    /**
     * The value for the longitude field.
     * @var        double
     */
    protected $longitude;

    /**
     * The value for the created field.
     * @var        string
     */
    protected $created;

    /**
     * The value for the updated field.
     * @var        string
     */
    protected $updated;

    /**
     * @var        Country
     */
    protected $aCountry;

    /**
     * @var        Subdivision
     */
    protected $aSubdivision;

    /**
     * @var        PropelObjectCollection|Group[] Collection to store aggregation of Group objects.
     */
    protected $collGroups;
    protected $collGroupsPartial;

    /**
     * @var        PropelObjectCollection|GroupUser[] Collection to store aggregation of GroupUser objects.
     */
    protected $collGroupUsers;
    protected $collGroupUsersPartial;

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
    protected $groupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $groupUsersScheduledForDeletion = null;

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
     * Get the [login_name] column value.
     *
     * @return string
     */
    public function getLoginName()
    {
        return $this->login_name;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [given_name] column value.
     *
     * @return string
     */
    public function getGivenName()
    {
        return $this->given_name;
    }

    /**
     * Get the [family_name] column value.
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->family_name;
    }

    /**
     * Get the [display_name] column value.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get the [subdivision_id] column value.
     *
     * @return int
     */
    public function getSubdivisionId()
    {
        return $this->subdivision_id;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [address2] column value.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Get the [optionally formatted] temporal [birthday] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBirthday($format = '%x')
    {
        if ($this->birthday === null) {
            return null;
        }

        if ($this->birthday === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->birthday);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birthday, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [sex] column value.
     *
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Get the [club] column value.
     *
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [postal_code] column value.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Get the [tan] column value.
     *
     * @return string
     */
    public function getTan()
    {
        return $this->tan;
    }

    /**
     * Get the [password_recover_code] column value.
     *
     * @return string
     */
    public function getPasswordRecoverCode()
    {
        return $this->password_recover_code;
    }

    /**
     * Get the [optionally formatted] temporal [password_recover_time] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPasswordRecoverTime($format = 'Y-m-d H:i:s')
    {
        if ($this->password_recover_time === null) {
            return null;
        }

        if ($this->password_recover_time === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->password_recover_time);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->password_recover_time, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [location_status] column value.
     *
     * @return int
     */
    public function getLocationStatus()
    {
        return $this->location_status;
    }

    /**
     * Get the [latitude] column value.
     *
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the [longitude] column value.
     *
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = 'Y-m-d H:i:s')
    {
        if ($this->created === null) {
            return null;
        }

        if ($this->created === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->created);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdated($format = 'Y-m-d H:i:s')
    {
        if ($this->updated === null) {
            return null;
        }

        if ($this->updated === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->updated);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [login_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLoginName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->login_name !== $v) {
            $this->login_name = $v;
            $this->modifiedColumns[] = UserPeer::LOGIN_NAME;
        }


        return $this;
    } // setLoginName()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Set the value of [given_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setGivenName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->given_name !== $v) {
            $this->given_name = $v;
            $this->modifiedColumns[] = UserPeer::GIVEN_NAME;
        }


        return $this;
    } // setGivenName()

    /**
     * Set the value of [family_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setFamilyName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->family_name !== $v) {
            $this->family_name = $v;
            $this->modifiedColumns[] = UserPeer::FAMILY_NAME;
        }


        return $this;
    } // setFamilyName()

    /**
     * Set the value of [display_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setDisplayName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->display_name !== $v) {
            $this->display_name = $v;
            $this->modifiedColumns[] = UserPeer::DISPLAY_NAME;
        }


        return $this;
    } // setDisplayName()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = UserPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [country_iso_nr] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCountryIsoNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_iso_nr !== $v) {
            $this->country_iso_nr = $v;
            $this->modifiedColumns[] = UserPeer::COUNTRY_ISO_NR;
        }

        if ($this->aCountry !== null && $this->aCountry->getIsoNr() !== $v) {
            $this->aCountry = null;
        }


        return $this;
    } // setCountryIsoNr()

    /**
     * Set the value of [subdivision_id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setSubdivisionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->subdivision_id !== $v) {
            $this->subdivision_id = $v;
            $this->modifiedColumns[] = UserPeer::SUBDIVISION_ID;
        }

        if ($this->aSubdivision !== null && $this->aSubdivision->getId() !== $v) {
            $this->aSubdivision = null;
        }


        return $this;
    } // setSubdivisionId()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[] = UserPeer::ADDRESS;
        }


        return $this;
    } // setAddress()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = UserPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Sets the value of [birthday] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setBirthday($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->birthday !== null || $dt !== null) {
            $currentDateAsString = ($this->birthday !== null && $tmpDt = new DateTime($this->birthday)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->birthday = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::BIRTHDAY;
            }
        } // if either are not null


        return $this;
    } // setBirthday()

    /**
     * Set the value of [sex] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setSex($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sex !== $v) {
            $this->sex = $v;
            $this->modifiedColumns[] = UserPeer::SEX;
        }


        return $this;
    } // setSex()

    /**
     * Set the value of [club] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setClub($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->club !== $v) {
            $this->club = $v;
            $this->modifiedColumns[] = UserPeer::CLUB;
        }


        return $this;
    } // setClub()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = UserPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [postal_code] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPostalCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postal_code !== $v) {
            $this->postal_code = $v;
            $this->modifiedColumns[] = UserPeer::POSTAL_CODE;
        }


        return $this;
    } // setPostalCode()

    /**
     * Set the value of [tan] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setTan($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tan !== $v) {
            $this->tan = $v;
            $this->modifiedColumns[] = UserPeer::TAN;
        }


        return $this;
    } // setTan()

    /**
     * Set the value of [password_recover_code] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPasswordRecoverCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password_recover_code !== $v) {
            $this->password_recover_code = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD_RECOVER_CODE;
        }


        return $this;
    } // setPasswordRecoverCode()

    /**
     * Sets the value of [password_recover_time] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setPasswordRecoverTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->password_recover_time !== null || $dt !== null) {
            $currentDateAsString = ($this->password_recover_time !== null && $tmpDt = new DateTime($this->password_recover_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->password_recover_time = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::PASSWORD_RECOVER_TIME;
            }
        } // if either are not null


        return $this;
    } // setPasswordRecoverTime()

    /**
     * Set the value of [location_status] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLocationStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_status !== $v) {
            $this->location_status = $v;
            $this->modifiedColumns[] = UserPeer::LOCATION_STATUS;
        }


        return $this;
    } // setLocationStatus()

    /**
     * Set the value of [latitude] column.
     *
     * @param double $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLatitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->latitude !== $v) {
            $this->latitude = $v;
            $this->modifiedColumns[] = UserPeer::LATITUDE;
        }


        return $this;
    } // setLatitude()

    /**
     * Set the value of [longitude] column.
     *
     * @param double $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLongitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->longitude !== $v) {
            $this->longitude = $v;
            $this->modifiedColumns[] = UserPeer::LONGITUDE;
        }


        return $this;
    } // setLongitude()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            $currentDateAsString = ($this->created !== null && $tmpDt = new DateTime($this->created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::CREATED;
            }
        } // if either are not null


        return $this;
    } // setCreated()

    /**
     * Sets the value of [updated] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated !== null || $dt !== null) {
            $currentDateAsString = ($this->updated !== null && $tmpDt = new DateTime($this->updated)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::UPDATED;
            }
        } // if either are not null


        return $this;
    } // setUpdated()

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
            $this->login_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->password = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->given_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->family_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->display_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->email = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->country_iso_nr = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->subdivision_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->address = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->address2 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->birthday = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->sex = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->club = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->city = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->postal_code = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->tan = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->password_recover_code = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->password_recover_time = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->location_status = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
            $this->latitude = ($row[$startcol + 20] !== null) ? (double) $row[$startcol + 20] : null;
            $this->longitude = ($row[$startcol + 21] !== null) ? (double) $row[$startcol + 21] : null;
            $this->created = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->updated = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
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
        if ($this->aSubdivision !== null && $this->subdivision_id !== $this->aSubdivision->getId()) {
            $this->aSubdivision = null;
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->aSubdivision = null;
            $this->collGroups = null;

            $this->collGroupUsers = null;

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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(UserPeer::CREATED)) {
                    $this->setCreated(time());
                }
                if (!$this->isColumnModified(UserPeer::UPDATED)) {
                    $this->setUpdated(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED)) {
                    $this->setUpdated(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserPeer::addInstanceToPool($this);
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

            if ($this->aSubdivision !== null) {
                if ($this->aSubdivision->isModified() || $this->aSubdivision->isNew()) {
                    $affectedRows += $this->aSubdivision->save($con);
                }
                $this->setSubdivision($this->aSubdivision);
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

            if ($this->groupsScheduledForDeletion !== null) {
                if (!$this->groupsScheduledForDeletion->isEmpty()) {
                    foreach ($this->groupsScheduledForDeletion as $group) {
                        // need to save related object because we set the relation to null
                        $group->save($con);
                    }
                    $this->groupsScheduledForDeletion = null;
                }
            }

            if ($this->collGroups !== null) {
                foreach ($this->collGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->groupUsersScheduledForDeletion !== null) {
                if (!$this->groupUsersScheduledForDeletion->isEmpty()) {
                    GroupUserQuery::create()
                        ->filterByPrimaryKeys($this->groupUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->groupUsersScheduledForDeletion = null;
                }
            }

            if ($this->collGroupUsers !== null) {
                foreach ($this->collGroupUsers as $referrerFK) {
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

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(UserPeer::LOGIN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`LOGIN_NAME`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORD`';
        }
        if ($this->isColumnModified(UserPeer::GIVEN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`GIVEN_NAME`';
        }
        if ($this->isColumnModified(UserPeer::FAMILY_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`FAMILY_NAME`';
        }
        if ($this->isColumnModified(UserPeer::DISPLAY_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`DISPLAY_NAME`';
        }
        if ($this->isColumnModified(UserPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`EMAIL`';
        }
        if ($this->isColumnModified(UserPeer::COUNTRY_ISO_NR)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY_ISO_NR`';
        }
        if ($this->isColumnModified(UserPeer::SUBDIVISION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`SUBDIVISION_ID`';
        }
        if ($this->isColumnModified(UserPeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS`';
        }
        if ($this->isColumnModified(UserPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS2`';
        }
        if ($this->isColumnModified(UserPeer::BIRTHDAY)) {
            $modifiedColumns[':p' . $index++]  = '`BIRTHDAY`';
        }
        if ($this->isColumnModified(UserPeer::SEX)) {
            $modifiedColumns[':p' . $index++]  = '`SEX`';
        }
        if ($this->isColumnModified(UserPeer::CLUB)) {
            $modifiedColumns[':p' . $index++]  = '`CLUB`';
        }
        if ($this->isColumnModified(UserPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`CITY`';
        }
        if ($this->isColumnModified(UserPeer::POSTAL_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`POSTAL_CODE`';
        }
        if ($this->isColumnModified(UserPeer::TAN)) {
            $modifiedColumns[':p' . $index++]  = '`TAN`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD_RECOVER_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORD_RECOVER_CODE`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD_RECOVER_TIME)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORD_RECOVER_TIME`';
        }
        if ($this->isColumnModified(UserPeer::LOCATION_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`LOCATION_STATUS`';
        }
        if ($this->isColumnModified(UserPeer::LATITUDE)) {
            $modifiedColumns[':p' . $index++]  = '`LATITUDE`';
        }
        if ($this->isColumnModified(UserPeer::LONGITUDE)) {
            $modifiedColumns[':p' . $index++]  = '`LONGITUDE`';
        }
        if ($this->isColumnModified(UserPeer::CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED`';
        }
        if ($this->isColumnModified(UserPeer::UPDATED)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED`';
        }

        $sql = sprintf(
            'INSERT INTO `keeko_user` (%s) VALUES (%s)',
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
                    case '`LOGIN_NAME`':
                        $stmt->bindValue($identifier, $this->login_name, PDO::PARAM_STR);
                        break;
                    case '`PASSWORD`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`GIVEN_NAME`':
                        $stmt->bindValue($identifier, $this->given_name, PDO::PARAM_STR);
                        break;
                    case '`FAMILY_NAME`':
                        $stmt->bindValue($identifier, $this->family_name, PDO::PARAM_STR);
                        break;
                    case '`DISPLAY_NAME`':
                        $stmt->bindValue($identifier, $this->display_name, PDO::PARAM_STR);
                        break;
                    case '`EMAIL`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`COUNTRY_ISO_NR`':
                        $stmt->bindValue($identifier, $this->country_iso_nr, PDO::PARAM_INT);
                        break;
                    case '`SUBDIVISION_ID`':
                        $stmt->bindValue($identifier, $this->subdivision_id, PDO::PARAM_INT);
                        break;
                    case '`ADDRESS`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case '`BIRTHDAY`':
                        $stmt->bindValue($identifier, $this->birthday, PDO::PARAM_STR);
                        break;
                    case '`SEX`':
                        $stmt->bindValue($identifier, $this->sex, PDO::PARAM_INT);
                        break;
                    case '`CLUB`':
                        $stmt->bindValue($identifier, $this->club, PDO::PARAM_STR);
                        break;
                    case '`CITY`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`POSTAL_CODE`':
                        $stmt->bindValue($identifier, $this->postal_code, PDO::PARAM_STR);
                        break;
                    case '`TAN`':
                        $stmt->bindValue($identifier, $this->tan, PDO::PARAM_STR);
                        break;
                    case '`PASSWORD_RECOVER_CODE`':
                        $stmt->bindValue($identifier, $this->password_recover_code, PDO::PARAM_STR);
                        break;
                    case '`PASSWORD_RECOVER_TIME`':
                        $stmt->bindValue($identifier, $this->password_recover_time, PDO::PARAM_STR);
                        break;
                    case '`LOCATION_STATUS`':
                        $stmt->bindValue($identifier, $this->location_status, PDO::PARAM_INT);
                        break;
                    case '`LATITUDE`':
                        $stmt->bindValue($identifier, $this->latitude, PDO::PARAM_STR);
                        break;
                    case '`LONGITUDE`':
                        $stmt->bindValue($identifier, $this->longitude, PDO::PARAM_STR);
                        break;
                    case '`CREATED`':
                        $stmt->bindValue($identifier, $this->created, PDO::PARAM_STR);
                        break;
                    case '`UPDATED`':
                        $stmt->bindValue($identifier, $this->updated, PDO::PARAM_STR);
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

            if ($this->aSubdivision !== null) {
                if (!$this->aSubdivision->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSubdivision->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGroups !== null) {
                    foreach ($this->collGroups as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collGroupUsers !== null) {
                    foreach ($this->collGroupUsers as $referrerFK) {
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getLoginName();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getGivenName();
                break;
            case 4:
                return $this->getFamilyName();
                break;
            case 5:
                return $this->getDisplayName();
                break;
            case 6:
                return $this->getEmail();
                break;
            case 7:
                return $this->getCountryIsoNr();
                break;
            case 8:
                return $this->getSubdivisionId();
                break;
            case 9:
                return $this->getAddress();
                break;
            case 10:
                return $this->getAddress2();
                break;
            case 11:
                return $this->getBirthday();
                break;
            case 12:
                return $this->getSex();
                break;
            case 13:
                return $this->getClub();
                break;
            case 14:
                return $this->getCity();
                break;
            case 15:
                return $this->getPostalCode();
                break;
            case 16:
                return $this->getTan();
                break;
            case 17:
                return $this->getPasswordRecoverCode();
                break;
            case 18:
                return $this->getPasswordRecoverTime();
                break;
            case 19:
                return $this->getLocationStatus();
                break;
            case 20:
                return $this->getLatitude();
                break;
            case 21:
                return $this->getLongitude();
                break;
            case 22:
                return $this->getCreated();
                break;
            case 23:
                return $this->getUpdated();
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
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLoginName(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getGivenName(),
            $keys[4] => $this->getFamilyName(),
            $keys[5] => $this->getDisplayName(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getCountryIsoNr(),
            $keys[8] => $this->getSubdivisionId(),
            $keys[9] => $this->getAddress(),
            $keys[10] => $this->getAddress2(),
            $keys[11] => $this->getBirthday(),
            $keys[12] => $this->getSex(),
            $keys[13] => $this->getClub(),
            $keys[14] => $this->getCity(),
            $keys[15] => $this->getPostalCode(),
            $keys[16] => $this->getTan(),
            $keys[17] => $this->getPasswordRecoverCode(),
            $keys[18] => $this->getPasswordRecoverTime(),
            $keys[19] => $this->getLocationStatus(),
            $keys[20] => $this->getLatitude(),
            $keys[21] => $this->getLongitude(),
            $keys[22] => $this->getCreated(),
            $keys[23] => $this->getUpdated(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {
                $result['Country'] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSubdivision) {
                $result['Subdivision'] = $this->aSubdivision->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collGroups) {
                $result['Groups'] = $this->collGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGroupUsers) {
                $result['GroupUsers'] = $this->collGroupUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setLoginName($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setGivenName($value);
                break;
            case 4:
                $this->setFamilyName($value);
                break;
            case 5:
                $this->setDisplayName($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setCountryIsoNr($value);
                break;
            case 8:
                $this->setSubdivisionId($value);
                break;
            case 9:
                $this->setAddress($value);
                break;
            case 10:
                $this->setAddress2($value);
                break;
            case 11:
                $this->setBirthday($value);
                break;
            case 12:
                $this->setSex($value);
                break;
            case 13:
                $this->setClub($value);
                break;
            case 14:
                $this->setCity($value);
                break;
            case 15:
                $this->setPostalCode($value);
                break;
            case 16:
                $this->setTan($value);
                break;
            case 17:
                $this->setPasswordRecoverCode($value);
                break;
            case 18:
                $this->setPasswordRecoverTime($value);
                break;
            case 19:
                $this->setLocationStatus($value);
                break;
            case 20:
                $this->setLatitude($value);
                break;
            case 21:
                $this->setLongitude($value);
                break;
            case 22:
                $this->setCreated($value);
                break;
            case 23:
                $this->setUpdated($value);
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
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLoginName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPassword($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setGivenName($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFamilyName($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDisplayName($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEmail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCountryIsoNr($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSubdivisionId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setAddress($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setAddress2($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setBirthday($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setSex($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setClub($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setCity($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setPostalCode($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setTan($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setPasswordRecoverCode($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setPasswordRecoverTime($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setLocationStatus($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setLatitude($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setLongitude($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setCreated($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setUpdated($arr[$keys[23]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::LOGIN_NAME)) $criteria->add(UserPeer::LOGIN_NAME, $this->login_name);
        if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(UserPeer::GIVEN_NAME)) $criteria->add(UserPeer::GIVEN_NAME, $this->given_name);
        if ($this->isColumnModified(UserPeer::FAMILY_NAME)) $criteria->add(UserPeer::FAMILY_NAME, $this->family_name);
        if ($this->isColumnModified(UserPeer::DISPLAY_NAME)) $criteria->add(UserPeer::DISPLAY_NAME, $this->display_name);
        if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
        if ($this->isColumnModified(UserPeer::COUNTRY_ISO_NR)) $criteria->add(UserPeer::COUNTRY_ISO_NR, $this->country_iso_nr);
        if ($this->isColumnModified(UserPeer::SUBDIVISION_ID)) $criteria->add(UserPeer::SUBDIVISION_ID, $this->subdivision_id);
        if ($this->isColumnModified(UserPeer::ADDRESS)) $criteria->add(UserPeer::ADDRESS, $this->address);
        if ($this->isColumnModified(UserPeer::ADDRESS2)) $criteria->add(UserPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(UserPeer::BIRTHDAY)) $criteria->add(UserPeer::BIRTHDAY, $this->birthday);
        if ($this->isColumnModified(UserPeer::SEX)) $criteria->add(UserPeer::SEX, $this->sex);
        if ($this->isColumnModified(UserPeer::CLUB)) $criteria->add(UserPeer::CLUB, $this->club);
        if ($this->isColumnModified(UserPeer::CITY)) $criteria->add(UserPeer::CITY, $this->city);
        if ($this->isColumnModified(UserPeer::POSTAL_CODE)) $criteria->add(UserPeer::POSTAL_CODE, $this->postal_code);
        if ($this->isColumnModified(UserPeer::TAN)) $criteria->add(UserPeer::TAN, $this->tan);
        if ($this->isColumnModified(UserPeer::PASSWORD_RECOVER_CODE)) $criteria->add(UserPeer::PASSWORD_RECOVER_CODE, $this->password_recover_code);
        if ($this->isColumnModified(UserPeer::PASSWORD_RECOVER_TIME)) $criteria->add(UserPeer::PASSWORD_RECOVER_TIME, $this->password_recover_time);
        if ($this->isColumnModified(UserPeer::LOCATION_STATUS)) $criteria->add(UserPeer::LOCATION_STATUS, $this->location_status);
        if ($this->isColumnModified(UserPeer::LATITUDE)) $criteria->add(UserPeer::LATITUDE, $this->latitude);
        if ($this->isColumnModified(UserPeer::LONGITUDE)) $criteria->add(UserPeer::LONGITUDE, $this->longitude);
        if ($this->isColumnModified(UserPeer::CREATED)) $criteria->add(UserPeer::CREATED, $this->created);
        if ($this->isColumnModified(UserPeer::UPDATED)) $criteria->add(UserPeer::UPDATED, $this->updated);

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
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);

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
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLoginName($this->getLoginName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setGivenName($this->getGivenName());
        $copyObj->setFamilyName($this->getFamilyName());
        $copyObj->setDisplayName($this->getDisplayName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setCountryIsoNr($this->getCountryIsoNr());
        $copyObj->setSubdivisionId($this->getSubdivisionId());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setBirthday($this->getBirthday());
        $copyObj->setSex($this->getSex());
        $copyObj->setClub($this->getClub());
        $copyObj->setCity($this->getCity());
        $copyObj->setPostalCode($this->getPostalCode());
        $copyObj->setTan($this->getTan());
        $copyObj->setPasswordRecoverCode($this->getPasswordRecoverCode());
        $copyObj->setPasswordRecoverTime($this->getPasswordRecoverTime());
        $copyObj->setLocationStatus($this->getLocationStatus());
        $copyObj->setLatitude($this->getLatitude());
        $copyObj->setLongitude($this->getLongitude());
        $copyObj->setCreated($this->getCreated());
        $copyObj->setUpdated($this->getUpdated());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGroupUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGroupUser($relObj->copy($deepCopy));
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
     * @return User Clone of current object.
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
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Country object.
     *
     * @param             Country $v
     * @return User The current object (for fluent API support)
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
            $v->addUser($this);
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
                $this->aCountry->addUsers($this);
             */
        }

        return $this->aCountry;
    }

    /**
     * Declares an association between this object and a Subdivision object.
     *
     * @param             Subdivision $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSubdivision(Subdivision $v = null)
    {
        if ($v === null) {
            $this->setSubdivisionId(NULL);
        } else {
            $this->setSubdivisionId($v->getId());
        }

        $this->aSubdivision = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Subdivision object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated Subdivision object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Subdivision The associated Subdivision object.
     * @throws PropelException
     */
    public function getSubdivision(PropelPDO $con = null)
    {
        if ($this->aSubdivision === null && ($this->subdivision_id !== null)) {
            $this->aSubdivision = SubdivisionQuery::create()->findPk($this->subdivision_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSubdivision->addUsers($this);
             */
        }

        return $this->aSubdivision;
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
        if ('Group' == $relationName) {
            $this->initGroups();
        }
        if ('GroupUser' == $relationName) {
            $this->initGroupUsers();
        }
    }

    /**
     * Clears out the collGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGroups()
     */
    public function clearGroups()
    {
        $this->collGroups = null; // important to set this to null since that means it is uninitialized
        $this->collGroupsPartial = null;
    }

    /**
     * reset is the collGroups collection loaded partially
     *
     * @return void
     */
    public function resetPartialGroups($v = true)
    {
        $this->collGroupsPartial = $v;
    }

    /**
     * Initializes the collGroups collection.
     *
     * By default this just sets the collGroups collection to an empty array (like clearcollGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGroups($overrideExisting = true)
    {
        if (null !== $this->collGroups && !$overrideExisting) {
            return;
        }
        $this->collGroups = new PropelObjectCollection();
        $this->collGroups->setModel('Group');
    }

    /**
     * Gets an array of Group objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Group[] List of Group objects
     * @throws PropelException
     */
    public function getGroups($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                // return empty collection
                $this->initGroups();
            } else {
                $collGroups = GroupQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGroupsPartial && count($collGroups)) {
                      $this->initGroups(false);

                      foreach($collGroups as $obj) {
                        if (false == $this->collGroups->contains($obj)) {
                          $this->collGroups->append($obj);
                        }
                      }

                      $this->collGroupsPartial = true;
                    }

                    return $collGroups;
                }

                if($partial && $this->collGroups) {
                    foreach($this->collGroups as $obj) {
                        if($obj->isNew()) {
                            $collGroups[] = $obj;
                        }
                    }
                }

                $this->collGroups = $collGroups;
                $this->collGroupsPartial = false;
            }
        }

        return $this->collGroups;
    }

    /**
     * Sets a collection of Group objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $groups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setGroups(PropelCollection $groups, PropelPDO $con = null)
    {
        $this->groupsScheduledForDeletion = $this->getGroups(new Criteria(), $con)->diff($groups);

        foreach ($this->groupsScheduledForDeletion as $groupRemoved) {
            $groupRemoved->setUser(null);
        }

        $this->collGroups = null;
        foreach ($groups as $group) {
            $this->addGroup($group);
        }

        $this->collGroups = $groups;
        $this->collGroupsPartial = false;
    }

    /**
     * Returns the number of related Group objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Group objects.
     * @throws PropelException
     */
    public function countGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getGroups());
                }
                $query = GroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collGroups);
        }
    }

    /**
     * Method called to associate a Group object to this object
     * through the Group foreign key attribute.
     *
     * @param    Group $l Group
     * @return User The current object (for fluent API support)
     */
    public function addGroup(Group $l)
    {
        if ($this->collGroups === null) {
            $this->initGroups();
            $this->collGroupsPartial = true;
        }
        if (!in_array($l, $this->collGroups->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGroup($l);
        }

        return $this;
    }

    /**
     * @param	Group $group The group object to add.
     */
    protected function doAddGroup($group)
    {
        $this->collGroups[]= $group;
        $group->setUser($this);
    }

    /**
     * @param	Group $group The group object to remove.
     */
    public function removeGroup($group)
    {
        if ($this->getGroups()->contains($group)) {
            $this->collGroups->remove($this->collGroups->search($group));
            if (null === $this->groupsScheduledForDeletion) {
                $this->groupsScheduledForDeletion = clone $this->collGroups;
                $this->groupsScheduledForDeletion->clear();
            }
            $this->groupsScheduledForDeletion[]= $group;
            $group->setUser(null);
        }
    }

    /**
     * Clears out the collGroupUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGroupUsers()
     */
    public function clearGroupUsers()
    {
        $this->collGroupUsers = null; // important to set this to null since that means it is uninitialized
        $this->collGroupUsersPartial = null;
    }

    /**
     * reset is the collGroupUsers collection loaded partially
     *
     * @return void
     */
    public function resetPartialGroupUsers($v = true)
    {
        $this->collGroupUsersPartial = $v;
    }

    /**
     * Initializes the collGroupUsers collection.
     *
     * By default this just sets the collGroupUsers collection to an empty array (like clearcollGroupUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGroupUsers($overrideExisting = true)
    {
        if (null !== $this->collGroupUsers && !$overrideExisting) {
            return;
        }
        $this->collGroupUsers = new PropelObjectCollection();
        $this->collGroupUsers->setModel('GroupUser');
    }

    /**
     * Gets an array of GroupUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|GroupUser[] List of GroupUser objects
     * @throws PropelException
     */
    public function getGroupUsers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGroupUsersPartial && !$this->isNew();
        if (null === $this->collGroupUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGroupUsers) {
                // return empty collection
                $this->initGroupUsers();
            } else {
                $collGroupUsers = GroupUserQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGroupUsersPartial && count($collGroupUsers)) {
                      $this->initGroupUsers(false);

                      foreach($collGroupUsers as $obj) {
                        if (false == $this->collGroupUsers->contains($obj)) {
                          $this->collGroupUsers->append($obj);
                        }
                      }

                      $this->collGroupUsersPartial = true;
                    }

                    return $collGroupUsers;
                }

                if($partial && $this->collGroupUsers) {
                    foreach($this->collGroupUsers as $obj) {
                        if($obj->isNew()) {
                            $collGroupUsers[] = $obj;
                        }
                    }
                }

                $this->collGroupUsers = $collGroupUsers;
                $this->collGroupUsersPartial = false;
            }
        }

        return $this->collGroupUsers;
    }

    /**
     * Sets a collection of GroupUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $groupUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setGroupUsers(PropelCollection $groupUsers, PropelPDO $con = null)
    {
        $this->groupUsersScheduledForDeletion = $this->getGroupUsers(new Criteria(), $con)->diff($groupUsers);

        foreach ($this->groupUsersScheduledForDeletion as $groupUserRemoved) {
            $groupUserRemoved->setUser(null);
        }

        $this->collGroupUsers = null;
        foreach ($groupUsers as $groupUser) {
            $this->addGroupUser($groupUser);
        }

        $this->collGroupUsers = $groupUsers;
        $this->collGroupUsersPartial = false;
    }

    /**
     * Returns the number of related GroupUser objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related GroupUser objects.
     * @throws PropelException
     */
    public function countGroupUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGroupUsersPartial && !$this->isNew();
        if (null === $this->collGroupUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroupUsers) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getGroupUsers());
                }
                $query = GroupUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collGroupUsers);
        }
    }

    /**
     * Method called to associate a GroupUser object to this object
     * through the GroupUser foreign key attribute.
     *
     * @param    GroupUser $l GroupUser
     * @return User The current object (for fluent API support)
     */
    public function addGroupUser(GroupUser $l)
    {
        if ($this->collGroupUsers === null) {
            $this->initGroupUsers();
            $this->collGroupUsersPartial = true;
        }
        if (!in_array($l, $this->collGroupUsers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGroupUser($l);
        }

        return $this;
    }

    /**
     * @param	GroupUser $groupUser The groupUser object to add.
     */
    protected function doAddGroupUser($groupUser)
    {
        $this->collGroupUsers[]= $groupUser;
        $groupUser->setUser($this);
    }

    /**
     * @param	GroupUser $groupUser The groupUser object to remove.
     */
    public function removeGroupUser($groupUser)
    {
        if ($this->getGroupUsers()->contains($groupUser)) {
            $this->collGroupUsers->remove($this->collGroupUsers->search($groupUser));
            if (null === $this->groupUsersScheduledForDeletion) {
                $this->groupUsersScheduledForDeletion = clone $this->collGroupUsers;
                $this->groupUsersScheduledForDeletion->clear();
            }
            $this->groupUsersScheduledForDeletion[]= $groupUser;
            $groupUser->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related GroupUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GroupUser[] List of GroupUser objects
     */
    public function getGroupUsersJoinGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GroupUserQuery::create(null, $criteria);
        $query->joinWith('Group', $join_behavior);

        return $this->getGroupUsers($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->login_name = null;
        $this->password = null;
        $this->given_name = null;
        $this->family_name = null;
        $this->display_name = null;
        $this->email = null;
        $this->country_iso_nr = null;
        $this->subdivision_id = null;
        $this->address = null;
        $this->address2 = null;
        $this->birthday = null;
        $this->sex = null;
        $this->club = null;
        $this->city = null;
        $this->postal_code = null;
        $this->tan = null;
        $this->password_recover_code = null;
        $this->password_recover_time = null;
        $this->location_status = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->created = null;
        $this->updated = null;
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
            if ($this->collGroups) {
                foreach ($this->collGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGroupUsers) {
                foreach ($this->collGroupUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collGroups instanceof PropelCollection) {
            $this->collGroups->clearIterator();
        }
        $this->collGroups = null;
        if ($this->collGroupUsers instanceof PropelCollection) {
            $this->collGroupUsers->clearIterator();
        }
        $this->collGroupUsers = null;
        $this->aCountry = null;
        $this->aSubdivision = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     User The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = UserPeer::UPDATED;

        return $this;
    }

}
