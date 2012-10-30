<?php



/**
 * This class defines the structure of the 'contact' table.
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
class ContactTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ContactTableMap';

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
		$this->setName('contact');
		$this->setPhpName('Contact');
		$this->setClassname('Contact');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 64, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 64, null);
		$this->addColumn('COMPANY_NAME', 'CompanyName', 'VARCHAR', false, 128, null);
		$this->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'VARCHAR', true, 150, null);
		$this->addColumn('PHONE_MAIN_NUMBER', 'PhoneMainNumber', 'VARCHAR', false, 32, null);
		$this->addColumn('PHONE_OTHER_NUMBER', 'PhoneOtherNumber', 'VARCHAR', false, 32, null);
		$this->addColumn('MAILING_ADDRESS', 'MailingAddress', 'VARCHAR', false, 255, null);
		$this->addColumn('MAILING_ADDRESS_LATITUDE', 'MailingAddressLatitude', 'DOUBLE', false, null, null);
		$this->addColumn('MAILING_ADDRESS_LONGITUDE', 'MailingAddressLongitude', 'DOUBLE', false, null, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 64, null);
		$this->addForeignKey('STATE_ID', 'StateId', 'INTEGER', 'state', 'ID', true, null, null);
		$this->addColumn('ZIP_CODE', 'ZipCode', 'VARCHAR', false, 7, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('State', 'State', RelationMap::MANY_TO_ONE, array('state_id' => 'id', ), 'RESTRICT', null);
		$this->addRelation('User', 'User', RelationMap::ONE_TO_MANY, array('id' => 'contact_id', ), 'RESTRICT', null, 'Users');
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // ContactTableMap
