<?php

namespace keeko\entities\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keeko_country' table.
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
class CountryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'keeko.entities.map.CountryTableMap';

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
        $this->setName('keeko_country');
        $this->setPhpName('Country');
        $this->setClassname('keeko\\entities\\Country');
        $this->setPackage('keeko.entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ISO_NR', 'IsoNr', 'INTEGER', true, null, null);
        $this->addColumn('ALPHA_2', 'Alpha2', 'CHAR', false, 2, null);
        $this->addColumn('ALPHA_3', 'Alpha3', 'CHAR', false, 3, null);
        $this->addColumn('IOC', 'Ioc', 'CHAR', false, 3, null);
        $this->addColumn('CAPITAL', 'Capital', 'VARCHAR', false, 128, null);
        $this->addColumn('TLD', 'Tld', 'VARCHAR', false, 3, null);
        $this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 16, null);
        $this->addForeignKey('TERRITORY_ISO_NR', 'TerritoryIsoNr', 'INTEGER', 'keeko_territory', 'ISO_NR', true, null, null);
        $this->addForeignKey('CURRENCY_ISO_NR', 'CurrencyIsoNr', 'INTEGER', 'keeko_currency', 'ISO_NR', true, null, null);
        $this->addColumn('OFFICIAL_LOCAL_NAME', 'OfficialLocalName', 'VARCHAR', false, 128, null);
        $this->addColumn('OFFICIAL_EN_NAME', 'OfficialEnName', 'VARCHAR', false, 128, null);
        $this->addColumn('SHORT_LOCAL_NAME', 'ShortLocalName', 'VARCHAR', false, 128, null);
        $this->addColumn('SHORT_EN_NAME', 'ShortEnName', 'VARCHAR', false, 128, null);
        $this->addColumn('BBOX_SW_LAT', 'BboxSwLat', 'FLOAT', false, null, null);
        $this->addColumn('BBOX_SW_LNG', 'BboxSwLng', 'FLOAT', false, null, null);
        $this->addColumn('BBOX_NE_LAT', 'BboxNeLat', 'FLOAT', false, null, null);
        $this->addColumn('BBOX_NE_LNG', 'BboxNeLng', 'FLOAT', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Territory', 'keeko\\entities\\Territory', RelationMap::MANY_TO_ONE, array('territory_iso_nr' => 'iso_nr', ), null, null);
        $this->addRelation('Currency', 'keeko\\entities\\Currency', RelationMap::MANY_TO_ONE, array('currency_iso_nr' => 'iso_nr', ), null, null);
        $this->addRelation('User', 'keeko\\entities\\User', RelationMap::ONE_TO_MANY, array('iso_nr' => 'country_iso_nr', ), null, null, 'Users');
        $this->addRelation('Localization', 'keeko\\entities\\Localization', RelationMap::ONE_TO_MANY, array('iso_nr' => 'country_iso_nr', ), null, null, 'Localizations');
        $this->addRelation('Subdivision', 'keeko\\entities\\Subdivision', RelationMap::ONE_TO_MANY, array('iso_nr' => 'country_iso_nr', ), null, null, 'Subdivisions');
    } // buildRelations()

} // CountryTableMap
