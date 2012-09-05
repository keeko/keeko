<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_language' table.
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
class LanguageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.LanguageTableMap';

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
        $this->setName('keeko_language');
        $this->setPhpName('Language');
        $this->setClassname('keeko\\entities\\Language');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ALPHA_2', 'Alpha2', 'VARCHAR', false, 2, null);
        $this->addColumn('ALPHA_3T', 'Alpha3T', 'VARCHAR', false, 3, null);
        $this->addColumn('ALPHA_3B', 'Alpha3B', 'VARCHAR', false, 3, null);
        $this->addColumn('ALPHA_3', 'Alpha3', 'VARCHAR', false, 3, null);
        $this->addColumn('LOCAL_NAME', 'LocalName', 'VARCHAR', false, 128, null);
        $this->addColumn('EN_NAME', 'EnName', 'VARCHAR', false, 128, null);
        $this->addColumn('COLLATE', 'Collate', 'VARCHAR', false, 10, null);
        $this->addForeignKey('SCOPE_ID', 'ScopeId', 'INTEGER', 'keeko_language_scope', 'ID', false, 10, null);
        $this->addForeignKey('TYPE_ID', 'TypeId', 'INTEGER', 'keeko_language_type', 'ID', false, 10, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('LanguageScope', 'keeko\\entities\\LanguageScope', RelationMap::MANY_TO_ONE, array('scope_id' => 'id', ), null, null);
        $this->addRelation('LanguageType', 'keeko\\entities\\LanguageType', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), null, null);
        $this->addRelation('Localization', 'keeko\\entities\\Localization', RelationMap::ONE_TO_MANY, array('id' => 'language_id', ), null, null, 'Localizations');
    } // buildRelations()

} // LanguageTableMap
