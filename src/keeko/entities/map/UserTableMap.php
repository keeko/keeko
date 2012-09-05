<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.keeko.entities.map
 */
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.UserTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('keeko_user');
        $this->setPhpName('User');
        $this->setClassname('keeko\\entities\\User');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('LOGIN_NAME', 'LoginName', 'VARCHAR', true, 100, null);
        $this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 100, null);
        $this->addColumn('GIVEN_NAME', 'GivenName', 'VARCHAR', true, 100, null);
        $this->addColumn('FAMILY_NAME', 'FamilyName', 'VARCHAR', true, 100, null);
        $this->addColumn('DISPLAY_NAME', 'DisplayName', 'VARCHAR', true, 100, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 255, null);
        $this->addForeignKey('COUNTRY_ISO_NR', 'CountryIsoNr', 'INTEGER', 'keeko_country', 'ISO_NR', true, null, null);
        $this->addForeignKey('SUBDIVISION_ID', 'SubdivisionId', 'INTEGER', 'keeko_subdivision', 'ID', false, null, null);
        $this->addColumn('ADDRESS', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ADDRESS2', 'Address2', 'LONGVARCHAR', false, null, null);
        $this->addColumn('BIRTHDAY', 'Birthday', 'DATE', true, null, null);
        $this->addColumn('SEX', 'Sex', 'TINYINT', true, null, null);
        $this->addColumn('CLUB', 'Club', 'VARCHAR', false, 100, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', false, 128, null);
        $this->addColumn('POSTAL_CODE', 'PostalCode', 'VARCHAR', false, 45, null);
        $this->addColumn('TAN', 'Tan', 'VARCHAR', false, 13, null);
        $this->addColumn('PASSWORD_RECOVER_CODE', 'PasswordRecoverCode', 'VARCHAR', false, 32, null);
        $this->addColumn('PASSWORD_RECOVER_TIME', 'PasswordRecoverTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('LOCATION_STATUS', 'LocationStatus', 'TINYINT', false, 2, null);
        $this->addColumn('LATITUDE', 'Latitude', 'FLOAT', false, 10, null);
        $this->addColumn('LONGITUDE', 'Longitude', 'FLOAT', false, 10, null);
        $this->addColumn('CREATED', 'Created', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED', 'Updated', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', 'keeko\\entities\\Country', RelationMap::MANY_TO_ONE, array('country_iso_nr' => 'iso_nr', ), null, null);
        $this->addRelation('Subdivision', 'keeko\\entities\\Subdivision', RelationMap::MANY_TO_ONE, array('subdivision_id' => 'id', ), null, null);
        $this->addRelation('Group', 'keeko\\entities\\Group', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'RESTRICT', null, 'Groups');
        $this->addRelation('GroupUser', 'keeko\\entities\\GroupUser', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'RESTRICT', null, 'GroupUsers');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created', 'update_column' => 'updated', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

} // UserTableMap
