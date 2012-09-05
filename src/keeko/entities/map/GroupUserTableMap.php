<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_group_user' table.
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
class GroupUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.GroupUserTableMap';

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
        $this->setName('keeko_group_user');
        $this->setPhpName('GroupUser');
        $this->setClassname('keeko\\entities\\GroupUser');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'keeko_user', 'ID', true, 10, null);
        $this->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'INTEGER' , 'keeko_group', 'ID', true, 10, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', 'keeko\\entities\\Group', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), 'RESTRICT', null);
        $this->addRelation('User', 'keeko\\entities\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', null);
    } // buildRelations()

} // GroupUserTableMap
