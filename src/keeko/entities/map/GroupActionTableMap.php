<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_group_action' table.
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
class GroupActionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.GroupActionTableMap';

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
        $this->setName('keeko_group_action');
        $this->setPhpName('GroupAction');
        $this->setClassname('keeko\\entities\\GroupAction');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'INTEGER' , 'keeko_group', 'ID', true, 10, null);
        $this->addForeignPrimaryKey('ACTION_ID', 'ActionId', 'INTEGER' , 'keeko_action', 'ID', true, 10, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', 'keeko\\entities\\Group', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), 'RESTRICT', null);
        $this->addRelation('Action', 'keeko\\entities\\Action', RelationMap::MANY_TO_ONE, array('action_id' => 'id', ), 'RESTRICT', null);
    } // buildRelations()

} // GroupActionTableMap
