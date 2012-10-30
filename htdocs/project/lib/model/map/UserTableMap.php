<?php



/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserTableMap';

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
		$this->setName('user');
		$this->setPhpName('User');
		$this->setClassname('User');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('PASSWORD_RESET_KEY', 'PasswordResetKey', 'VARCHAR', false, 16, null);
		$this->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('CONTACT_ID', 'ContactId', 'INTEGER', 'contact', 'ID', false, null, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Contact', 'Contact', RelationMap::MANY_TO_ONE, array('contact_id' => 'id', ), 'RESTRICT', null);
		$this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('sf_guard_user_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('Session', 'Session', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'Sessions');
		$this->addRelation('SingleSignOnKey', 'SingleSignOnKey', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'SingleSignOnKeys');
		$this->addRelation('SystemEventSubscription', 'SystemEventSubscription', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', 'CASCADE', 'SystemEventSubscriptions');
		$this->addRelation('SystemEventInstance', 'SystemEventInstance', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', 'CASCADE', 'SystemEventInstances');
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

} // UserTableMap
