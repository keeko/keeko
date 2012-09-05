<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_app_uri' table.
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
class AppUriTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.AppUriTableMap';

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
        $this->setName('keeko_app_uri');
        $this->setPhpName('AppUri');
        $this->setClassname('keeko\\entities\\AppUri');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('HTTPHOST', 'Httphost', 'VARCHAR', true, 255, null);
        $this->addColumn('BASEPATH', 'Basepath', 'VARCHAR', true, 255, null);
        $this->addColumn('SECURE', 'Secure', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('APP_ID', 'AppId', 'INTEGER', 'keeko_app', 'ID', true, 10, null);
        $this->addForeignKey('LOCALIZATION_ID', 'LocalizationId', 'INTEGER', 'keeko_localization', 'ID', true, 10, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('App', 'keeko\\entities\\App', RelationMap::MANY_TO_ONE, array('app_id' => 'id', ), 'RESTRICT', null);
        $this->addRelation('Localization', 'keeko\\entities\\Localization', RelationMap::MANY_TO_ONE, array('localization_id' => 'id', ), 'RESTRICT', null);
    } // buildRelations()

} // AppUriTableMap
