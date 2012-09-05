<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_group' table.
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
class GroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.GroupTableMap';

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
        $this->setName('keeko_group');
        $this->setPhpName('Group');
        $this->setClassname('keeko\\entities\\Group');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'keeko_user', 'ID', false, 10, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 64, null);
        $this->addColumn('IS_GUEST', 'IsGuest', 'BOOLEAN', false, 1, null);
        $this->addColumn('IS_DEFAULT', 'IsDefault', 'BOOLEAN', false, 1, null);
        $this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addColumn('IS_SYSTEM', 'IsSystem', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'keeko\\entities\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', null);
        $this->addRelation('GroupUser', 'keeko\\entities\\GroupUser', RelationMap::ONE_TO_MANY, array('id' => 'group_id', ), 'RESTRICT', null, 'GroupUsers');
        $this->addRelation('GroupAction', 'keeko\\entities\\GroupAction', RelationMap::ONE_TO_MANY, array('id' => 'group_id', ), 'RESTRICT', null, 'GroupActions');
    } // buildRelations()

} // GroupTableMap
