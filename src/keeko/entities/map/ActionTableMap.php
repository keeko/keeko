<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_action' table.
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
class ActionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.ActionTableMap';

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
        $this->setName('keeko_action');
        $this->setPhpName('Action');
        $this->setClassname('keeko\\entities\\Action');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('MODULE_ID', 'ModuleId', 'INTEGER', 'keeko_module', 'ID', true, 10, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 32, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Module', 'keeko\\entities\\Module', RelationMap::MANY_TO_ONE, array('module_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('GroupAction', 'keeko\\entities\\GroupAction', RelationMap::ONE_TO_MANY, array('id' => 'action_id', ), 'RESTRICT', null, 'GroupActions');
    } // buildRelations()

} // ActionTableMap
