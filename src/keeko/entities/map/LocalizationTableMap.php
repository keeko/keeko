<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_localization' table.
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
class LocalizationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.LocalizationTableMap';

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
        $this->setName('keeko_localization');
        $this->setPhpName('Localization');
        $this->setClassname('keeko\\entities\\Localization');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'keeko_localization', 'ID', false, 10, null);
        $this->addForeignKey('LANGUAGE_ID', 'LanguageId', 'INTEGER', 'keeko_language', 'ID', false, 10, null);
        $this->addForeignKey('COUNTRY_ISO_NR', 'CountryIsoNr', 'INTEGER', 'keeko_country', 'ISO_NR', false, 10, null);
        $this->addColumn('IS_DEFAULT', 'IsDefault', 'BOOLEAN', false, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LocalizationRelatedByParentId', 'keeko\\entities\\Localization', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), null, null);
        $this->addRelation('Language', 'keeko\\entities\\Language', RelationMap::MANY_TO_ONE, array('language_id' => 'id', ), null, null);
        $this->addRelation('Country', 'keeko\\entities\\Country', RelationMap::MANY_TO_ONE, array('country_iso_nr' => 'iso_nr', ), null, null);
        $this->addRelation('LocalizationRelatedById', 'keeko\\entities\\Localization', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), null, null, 'LocalizationsRelatedById');
        $this->addRelation('AppUri', 'keeko\\entities\\AppUri', RelationMap::ONE_TO_MANY, array('id' => 'localization_id', ), 'RESTRICT', null, 'AppUris');
    } // buildRelations()

} // LocalizationTableMap
