<?php



/**
 * This class defines the structure of the 'country' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.lib.model.map
 */
class CountryTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CountryTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('country');
		$this->setPhpName('Country');
		$this->setClassname('Country');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 64, null);
		$this->addColumn('ISO_CODE', 'IsoCode', 'VARCHAR', true, 12, null);
		$this->addColumn('ISO_SHORT_CODE', 'IsoShortCode', 'VARCHAR', true, 2, null);
		$this->addColumn('DEMONYM', 'Demonym', 'VARCHAR', true, 128, null);
		$this->addForeignKey('DEFAULT_CURRENCY_ID', 'DefaultCurrencyId', 'INTEGER', 'currency', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Currency', 'Currency', RelationMap::MANY_TO_ONE, array('default_currency_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('State', 'State', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', null, 'States');
	} // buildRelations()

	/**
	 *
	 * Gets the list of behaviors registered for this table
	 *
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // CountryTableMap
