<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_currency' table.
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
class CurrencyTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.CurrencyTableMap';

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
        $this->setName('keeko_currency');
        $this->setPhpName('Currency');
        $this->setClassname('keeko\\entities\\Currency');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ISO_NR', 'IsoNr', 'INTEGER', true, null, null);
        $this->addColumn('ISO3', 'Iso3', 'CHAR', true, 3, null);
        $this->addColumn('EN_NAME', 'EnName', 'VARCHAR', false, 45, null);
        $this->addColumn('SYMBOL_LEFT', 'SymbolLeft', 'VARCHAR', false, 45, null);
        $this->addColumn('SYMBOL_RIGHT', 'SymbolRight', 'VARCHAR', false, 45, null);
        $this->addColumn('DECIMAL_DIGITS', 'DecimalDigits', 'INTEGER', false, null, null);
        $this->addColumn('SUB_DIVISOR', 'SubDivisor', 'INTEGER', false, null, null);
        $this->addColumn('SUB_SYMBOL_LEFT', 'SubSymbolLeft', 'VARCHAR', false, 45, null);
        $this->addColumn('SUB_SYMBOL_RIGHT', 'SubSymbolRight', 'VARCHAR', false, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', 'keeko\\entities\\Country', RelationMap::ONE_TO_MANY, array('iso_nr' => 'currency_iso_nr', ), null, null, 'Countrys');
    } // buildRelations()

} // CurrencyTableMap
