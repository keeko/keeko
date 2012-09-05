<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_subdivision' table.
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
class SubdivisionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.SubdivisionTableMap';

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
        $this->setName('keeko_subdivision');
        $this->setPhpName('Subdivision');
        $this->setClassname('keeko\\entities\\Subdivision');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ISO', 'Iso', 'VARCHAR', false, 45, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 128, null);
        $this->addColumn('LOCAL_NAME', 'LocalName', 'VARCHAR', false, 128, null);
        $this->addColumn('EN_NAME', 'EnName', 'VARCHAR', false, 128, null);
        $this->addColumn('ALT_NAMES', 'AltNames', 'VARCHAR', false, 255, null);
        $this->addColumn('PARENT_ID', 'ParentId', 'INTEGER', false, null, null);
        $this->addForeignKey('COUNTRY_ISO_NR', 'CountryIsoNr', 'INTEGER', 'keeko_country', 'ISO_NR', true, null, null);
        $this->addForeignKey('SUBDIVISION_TYPE_ID', 'SubdivisionTypeId', 'INTEGER', 'keeko_subdivision_type', 'ID', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', 'keeko\\entities\\Country', RelationMap::MANY_TO_ONE, array('country_iso_nr' => 'iso_nr', ), null, null);
        $this->addRelation('SubdivisionType', 'keeko\\entities\\SubdivisionType', RelationMap::MANY_TO_ONE, array('subdivision_type_id' => 'id', ), null, null);
        $this->addRelation('User', 'keeko\\entities\\User', RelationMap::ONE_TO_MANY, array('id' => 'subdivision_id', ), null, null, 'Users');
    } // buildRelations()

} // SubdivisionTableMap
