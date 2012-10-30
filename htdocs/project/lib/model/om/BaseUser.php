<?php


/**
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseUser extends BaseObject 
{

    /**
     * Peer class name
     */
    const PEER = 'UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the password_reset_key field.
     * @var        string
     */
    protected $password_reset_key;

    /**
     * The value for the sf_guard_user_id field.
     * @var        int
     */
    protected $sf_guard_user_id;

    /**
     * The value for the contact_id field.
     * @var        int
     */
    protected $contact_id;

    /**
     * The value for the active field.
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        Contact
     */
    protected $aContact;

    /**
     * @var        sfGuardUser
     */
    protected $asfGuardUser;

    /**
     * @var        PropelObjectCollection|Session[] Collection to store aggregation of Session objects.
     */
    protected $collSessions;

    /**
     * @var        PropelObjectCollection|SingleSignOnKey[] Collection to store aggregation of SingleSignOnKey objects.
     */
    protected $collSingleSignOnKeys;

    /**
     * @var        PropelObjectCollection|SystemEventSubscription[] Collection to store aggregation of SystemEventSubscription objects.
     */
    protected $collSystemEventSubscriptions;

    /**
     * @var        PropelObjectCollection|SystemEventInstance[] Collection to store aggregation of SystemEventInstance objects.
     */
    protected $collSystemEventInstances;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $sessionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $singleSignOnKeysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $systemEventSubscriptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $systemEventInstancesScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     * 
     * @return   int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [password_reset_key] column value.
     * 
     * @return   string
     */
    public function getPasswordResetKey()
    {

        return $this->password_reset_key;
    }

    /**
     * Get the [sf_guard_user_id] column value.
     * 
     * @return   int
     */
    public function getSfGuardUserId()
    {

        return $this->sf_guard_user_id;
    }

    /**
     * Get the [contact_id] column value.
     * 
     * @return   int
     */
    public function getContactId()
    {

        return $this->contact_id;
    }

    /**
     * Get the [active] column value.
     * 
     * @return   boolean
     */
    public function getActive()
    {

        return $this->active;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *							If format is NULL, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }


        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of NULL,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->created_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is TRUE, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *							If format is NULL, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }


        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of NULL,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->updated_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is TRUE, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Set the value of [id] column.
     * 
     * @param      int $v new value
     * @return   User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [password_reset_key] column.
     * 
     * @param      string $v new value
     * @return   User The current object (for fluent API support)
     */
    public function setPasswordResetKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password_reset_key !== $v) {
            $this->password_reset_key = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD_RESET_KEY;
        }


        return $this;
    } // setPasswordResetKey()

    /**
     * Set the value of [sf_guard_user_id] column.
     * 
     * @param      int $v new value
     * @return   User The current object (for fluent API support)
     */
    public function setSfGuardUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sf_guard_user_id !== $v) {
            $this->sf_guard_user_id = $v;
            $this->modifiedColumns[] = UserPeer::SF_GUARD_USER_ID;
        }

        if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
            $this->asfGuardUser = null;
        }


        return $this;
    } // setSfGuardUserId()

    /**
     * Set the value of [contact_id] column.
     * 
     * @param      int $v new value
     * @return   User The current object (for fluent API support)
     */
    public function setContactId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->contact_id !== $v) {
            $this->contact_id = $v;
            $this->modifiedColumns[] = UserPeer::CONTACT_ID;
        }

        if ($this->aContact !== null && $this->aContact->getId() !== $v) {
            $this->aContact = null;
        }


        return $this;
    } // setContactId()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param      boolean|integer|string $v The new value
     * @return   User The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = UserPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     * 
     * @param      mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as NULL.
     * @return   User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     * 
     * @param      mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as NULL.
     * @return   User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->password_reset_key = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->sf_guard_user_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->contact_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->active = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->asfGuardUser !== null && $this->sf_guard_user_id !== $this->asfGuardUser->getId()) {
            $this->asfGuardUser = null;
        }
        if ($this->aContact !== null && $this->contact_id !== $this->aContact->getId()) {
            $this->aContact = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aContact = null;
            $this->asfGuardUser = null;
            $this->collSessions = null;

            $this->collSingleSignOnKeys = null;

            $this->collSystemEventSubscriptions = null;

            $this->collSystemEventInstances = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseUser:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			    return;
			  }
			}

            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseUser:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseUser:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			// symfony_timestampable behavior
			if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED_AT))
			{
				$this->setUpdatedAt(time());
			}
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(UserPeer::CREATED_AT))
				{
				  $this->setCreatedAt(time());
				}

            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseUser:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

                UserPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aContact !== null) {
                if ($this->aContact->isModified() || $this->aContact->isNew()) {
                    $affectedRows += $this->aContact->save($con);
                }
                $this->setContact($this->aContact);
            }

            if ($this->asfGuardUser !== null) {
                if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
                    $affectedRows += $this->asfGuardUser->save($con);
                }
                $this->setsfGuardUser($this->asfGuardUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->sessionsScheduledForDeletion !== null) {
                if (!$this->sessionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->sessionsScheduledForDeletion as $session) {
                        // need to save related object because we set the relation to null
                        $session->save($con);
                    }
                    $this->sessionsScheduledForDeletion = null;
                }
            }

            if ($this->collSessions !== null) {
                foreach ($this->collSessions as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleSignOnKeysScheduledForDeletion !== null) {
                if (!$this->singleSignOnKeysScheduledForDeletion->isEmpty()) {
                    SingleSignOnKeyQuery::create()
                        ->filterByPrimaryKeys($this->singleSignOnKeysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->singleSignOnKeysScheduledForDeletion = null;
                }
            }

            if ($this->collSingleSignOnKeys !== null) {
                foreach ($this->collSingleSignOnKeys as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->systemEventSubscriptionsScheduledForDeletion !== null) {
                if (!$this->systemEventSubscriptionsScheduledForDeletion->isEmpty()) {
                    SystemEventSubscriptionQuery::create()
                        ->filterByPrimaryKeys($this->systemEventSubscriptionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->systemEventSubscriptionsScheduledForDeletion = null;
                }
            }

            if ($this->collSystemEventSubscriptions !== null) {
                foreach ($this->collSystemEventSubscriptions as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->systemEventInstancesScheduledForDeletion !== null) {
                if (!$this->systemEventInstancesScheduledForDeletion->isEmpty()) {
                    foreach ($this->systemEventInstancesScheduledForDeletion as $systemEventInstance) {
                        // need to save related object because we set the relation to null
                        $systemEventInstance->save($con);
                    }
                    $this->systemEventInstancesScheduledForDeletion = null;
                }
            }

            if ($this->collSystemEventInstances !== null) {
                foreach ($this->collSystemEventInstances as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD_RESET_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORD_RESET_KEY`';
        }
        if ($this->isColumnModified(UserPeer::SF_GUARD_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`SF_GUARD_USER_ID`';
        }
        if ($this->isColumnModified(UserPeer::CONTACT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT_ID`';
        }
        if ($this->isColumnModified(UserPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }
        if ($this->isColumnModified(UserPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `user` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`PASSWORD_RESET_KEY`':
						$stmt->bindValue($identifier, $this->password_reset_key, PDO::PARAM_STR);
                        break;
                    case '`SF_GUARD_USER_ID`':
						$stmt->bindValue($identifier, $this->sf_guard_user_id, PDO::PARAM_INT);
                        break;
                    case '`CONTACT_ID`':
						$stmt->bindValue($identifier, $this->contact_id, PDO::PARAM_INT);
                        break;
                    case '`ACTIVE`':
						$stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`CREATED_AT`':
						$stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
						$stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
			$pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param      mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param      array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aContact !== null) {
                if (!$this->aContact->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aContact->getValidationFailures());
                }
            }

            if ($this->asfGuardUser !== null) {
                if (!$this->asfGuardUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collSessions !== null) {
                    foreach ($this->collSessions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSingleSignOnKeys !== null) {
                    foreach ($this->collSingleSignOnKeys as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSystemEventSubscriptions !== null) {
                    foreach ($this->collSystemEventSubscriptions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSystemEventInstances !== null) {
                    foreach ($this->collSystemEventInstances as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPasswordResetKey();
                break;
            case 2:
                return $this->getSfGuardUserId();
                break;
            case 3:
                return $this->getContactId();
                break;
            case 4:
                return $this->getActive();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPasswordResetKey(),
            $keys[2] => $this->getSfGuardUserId(),
            $keys[3] => $this->getContactId(),
            $keys[4] => $this->getActive(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aContact) {
                $result['Contact'] = $this->aContact->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->asfGuardUser) {
                $result['sfGuardUser'] = $this->asfGuardUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSessions) {
                $result['Sessions'] = $this->collSessions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSingleSignOnKeys) {
                $result['SingleSignOnKeys'] = $this->collSingleSignOnKeys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSystemEventSubscriptions) {
                $result['SystemEventSubscriptions'] = $this->collSystemEventSubscriptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSystemEventInstances) {
                $result['SystemEventInstances'] = $this->collSystemEventInstances->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name peer name
     * @param      mixed $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPasswordResetKey($value);
                break;
            case 2:
                $this->setSfGuardUserId($value);
                break;
            case 3:
                $this->setContactId($value);
                break;
            case 4:
                $this->setActive($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPasswordResetKey($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSfGuardUserId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setContactId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setActive($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::PASSWORD_RESET_KEY)) $criteria->add(UserPeer::PASSWORD_RESET_KEY, $this->password_reset_key);
        if ($this->isColumnModified(UserPeer::SF_GUARD_USER_ID)) $criteria->add(UserPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
        if ($this->isColumnModified(UserPeer::CONTACT_ID)) $criteria->add(UserPeer::CONTACT_ID, $this->contact_id);
        if ($this->isColumnModified(UserPeer::ACTIVE)) $criteria->add(UserPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) $criteria->add(UserPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPasswordResetKey($this->getPasswordResetKey());
        $copyObj->setSfGuardUserId($this->getSfGuardUserId());
        $copyObj->setContactId($this->getContactId());
        $copyObj->setActive($this->getActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSession($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSingleSignOnKeys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSingleSignOnKey($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSystemEventSubscriptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSystemEventSubscription($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSystemEventInstances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSystemEventInstance($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 User Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return   UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Contact object.
     *
     * @param                  Contact $v
     * @return                 User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContact(Contact $v = null)
    {
        if ($v === null) {
            $this->setContactId(NULL);
        } else {
            $this->setContactId($v->getId());
        }

        $this->aContact = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Contact object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated Contact object
     *
     * @param      PropelPDO $con Optional Connection object.
     * @return                 Contact The associated Contact object.
     * @throws PropelException
     */
    public function getContact(PropelPDO $con = null)
    {
        if ($this->aContact === null && ($this->contact_id !== null)) {
            $this->aContact = ContactQuery::create()->findPk($this->contact_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContact->addUsers($this);
             */
        }

        return $this->aContact;
    }

    /**
     * Declares an association between this object and a sfGuardUser object.
     *
     * @param                  sfGuardUser $v
     * @return                 User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setsfGuardUser(sfGuardUser $v = null)
    {
        if ($v === null) {
            $this->setSfGuardUserId(NULL);
        } else {
            $this->setSfGuardUserId($v->getId());
        }

        $this->asfGuardUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the sfGuardUser object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated sfGuardUser object
     *
     * @param      PropelPDO $con Optional Connection object.
     * @return                 sfGuardUser The associated sfGuardUser object.
     * @throws PropelException
     */
    public function getsfGuardUser(PropelPDO $con = null)
    {
        if ($this->asfGuardUser === null && ($this->sf_guard_user_id !== null)) {
            $this->asfGuardUser = sfGuardUserQuery::create()->findPk($this->sf_guard_user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->asfGuardUser->addUsers($this);
             */
        }

        return $this->asfGuardUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Session' == $relationName) {
            $this->initSessions();
        }
        if ('SingleSignOnKey' == $relationName) {
            $this->initSingleSignOnKeys();
        }
        if ('SystemEventSubscription' == $relationName) {
            $this->initSystemEventSubscriptions();
        }
        if ('SystemEventInstance' == $relationName) {
            $this->initSystemEventInstances();
        }
    }

    /**
     * Clears out the collSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSessions()
     */
    public function clearSessions()
    {
        $this->collSessions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSessions collection.
     *
     * By default this just sets the collSessions collection to an empty array (like clearcollSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSessions($overrideExisting = true)
    {
        if (null !== $this->collSessions && !$overrideExisting) {
            return;
        }
        $this->collSessions = new PropelObjectCollection();
        $this->collSessions->setModel('Session');
    }

    /**
     * Gets an array of Session objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelObjectCollection|Session[] List of Session objects
     * @throws PropelException
     */
    public function getSessions($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSessions || null !== $criteria) {
            if ($this->isNew() && null === $this->collSessions) {
                // return empty collection
                $this->initSessions();
            } else {
                $collSessions = SessionQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSessions;
                }
                $this->collSessions = $collSessions;
            }
        }

        return $this->collSessions;
    }

    /**
     * Sets a collection of Session objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $sessions A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setSessions(PropelCollection $sessions, PropelPDO $con = null)
    {
        $this->sessionsScheduledForDeletion = $this->getSessions(new Criteria(), $con)->diff($sessions);

        foreach ($this->sessionsScheduledForDeletion as $sessionRemoved) {
            $sessionRemoved->setUser(null);
        }

        $this->collSessions = null;
        foreach ($sessions as $session) {
            $this->addSession($session);
        }

        $this->collSessions = $sessions;
    }

    /**
     * Returns the number of related Session objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related Session objects.
     * @throws PropelException
     */
    public function countSessions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSessions || null !== $criteria) {
            if ($this->isNew() && null === $this->collSessions) {
                return 0;
            } else {
                $query = SessionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collSessions);
        }
    }

    /**
     * Method called to associate a Session object to this object
     * through the Session foreign key attribute.
     *
     * @param    Session $l Session
     * @return   User The current object (for fluent API support)
     */
    public function addSession(Session $l)
    {
        if ($this->collSessions === null) {
            $this->initSessions();
        }
        if (!$this->collSessions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddSession($l);
        }

        return $this;
    }

    /**
     * @param	Session $session The session object to add.
     */
    protected function doAddSession($session)
    {
        $this->collSessions[]= $session;
        $session->setUser($this);
    }

    /**
     * @param	Session $session The session object to remove.
     */
    public function removeSession($session)
    {
        if ($this->getSessions()->contains($session)) {
            $this->collSessions->remove($this->collSessions->search($session));
            if (null === $this->sessionsScheduledForDeletion) {
                $this->sessionsScheduledForDeletion = clone $this->collSessions;
                $this->sessionsScheduledForDeletion->clear();
            }
            $this->sessionsScheduledForDeletion[]= $session;
            $session->setUser(null);
        }
    }

    /**
     * Clears out the collSingleSignOnKeys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSingleSignOnKeys()
     */
    public function clearSingleSignOnKeys()
    {
        $this->collSingleSignOnKeys = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSingleSignOnKeys collection.
     *
     * By default this just sets the collSingleSignOnKeys collection to an empty array (like clearcollSingleSignOnKeys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSingleSignOnKeys($overrideExisting = true)
    {
        if (null !== $this->collSingleSignOnKeys && !$overrideExisting) {
            return;
        }
        $this->collSingleSignOnKeys = new PropelObjectCollection();
        $this->collSingleSignOnKeys->setModel('SingleSignOnKey');
    }

    /**
     * Gets an array of SingleSignOnKey objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelObjectCollection|SingleSignOnKey[] List of SingleSignOnKey objects
     * @throws PropelException
     */
    public function getSingleSignOnKeys($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSingleSignOnKeys || null !== $criteria) {
            if ($this->isNew() && null === $this->collSingleSignOnKeys) {
                // return empty collection
                $this->initSingleSignOnKeys();
            } else {
                $collSingleSignOnKeys = SingleSignOnKeyQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSingleSignOnKeys;
                }
                $this->collSingleSignOnKeys = $collSingleSignOnKeys;
            }
        }

        return $this->collSingleSignOnKeys;
    }

    /**
     * Sets a collection of SingleSignOnKey objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $singleSignOnKeys A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setSingleSignOnKeys(PropelCollection $singleSignOnKeys, PropelPDO $con = null)
    {
        $this->singleSignOnKeysScheduledForDeletion = $this->getSingleSignOnKeys(new Criteria(), $con)->diff($singleSignOnKeys);

        foreach ($this->singleSignOnKeysScheduledForDeletion as $singleSignOnKeyRemoved) {
            $singleSignOnKeyRemoved->setUser(null);
        }

        $this->collSingleSignOnKeys = null;
        foreach ($singleSignOnKeys as $singleSignOnKey) {
            $this->addSingleSignOnKey($singleSignOnKey);
        }

        $this->collSingleSignOnKeys = $singleSignOnKeys;
    }

    /**
     * Returns the number of related SingleSignOnKey objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related SingleSignOnKey objects.
     * @throws PropelException
     */
    public function countSingleSignOnKeys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSingleSignOnKeys || null !== $criteria) {
            if ($this->isNew() && null === $this->collSingleSignOnKeys) {
                return 0;
            } else {
                $query = SingleSignOnKeyQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collSingleSignOnKeys);
        }
    }

    /**
     * Method called to associate a SingleSignOnKey object to this object
     * through the SingleSignOnKey foreign key attribute.
     *
     * @param    SingleSignOnKey $l SingleSignOnKey
     * @return   User The current object (for fluent API support)
     */
    public function addSingleSignOnKey(SingleSignOnKey $l)
    {
        if ($this->collSingleSignOnKeys === null) {
            $this->initSingleSignOnKeys();
        }
        if (!$this->collSingleSignOnKeys->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddSingleSignOnKey($l);
        }

        return $this;
    }

    /**
     * @param	SingleSignOnKey $singleSignOnKey The singleSignOnKey object to add.
     */
    protected function doAddSingleSignOnKey($singleSignOnKey)
    {
        $this->collSingleSignOnKeys[]= $singleSignOnKey;
        $singleSignOnKey->setUser($this);
    }

    /**
     * @param	SingleSignOnKey $singleSignOnKey The singleSignOnKey object to remove.
     */
    public function removeSingleSignOnKey($singleSignOnKey)
    {
        if ($this->getSingleSignOnKeys()->contains($singleSignOnKey)) {
            $this->collSingleSignOnKeys->remove($this->collSingleSignOnKeys->search($singleSignOnKey));
            if (null === $this->singleSignOnKeysScheduledForDeletion) {
                $this->singleSignOnKeysScheduledForDeletion = clone $this->collSingleSignOnKeys;
                $this->singleSignOnKeysScheduledForDeletion->clear();
            }
            $this->singleSignOnKeysScheduledForDeletion[]= $singleSignOnKey;
            $singleSignOnKey->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related SingleSignOnKeys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|SingleSignOnKey[] List of SingleSignOnKey objects
     */
    public function getSingleSignOnKeysJoinSession($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SingleSignOnKeyQuery::create(null, $criteria);
        $query->joinWith('Session', $join_behavior);

        return $this->getSingleSignOnKeys($query, $con);
    }

    /**
     * Clears out the collSystemEventSubscriptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSystemEventSubscriptions()
     */
    public function clearSystemEventSubscriptions()
    {
        $this->collSystemEventSubscriptions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSystemEventSubscriptions collection.
     *
     * By default this just sets the collSystemEventSubscriptions collection to an empty array (like clearcollSystemEventSubscriptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSystemEventSubscriptions($overrideExisting = true)
    {
        if (null !== $this->collSystemEventSubscriptions && !$overrideExisting) {
            return;
        }
        $this->collSystemEventSubscriptions = new PropelObjectCollection();
        $this->collSystemEventSubscriptions->setModel('SystemEventSubscription');
    }

    /**
     * Gets an array of SystemEventSubscription objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelObjectCollection|SystemEventSubscription[] List of SystemEventSubscription objects
     * @throws PropelException
     */
    public function getSystemEventSubscriptions($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSystemEventSubscriptions || null !== $criteria) {
            if ($this->isNew() && null === $this->collSystemEventSubscriptions) {
                // return empty collection
                $this->initSystemEventSubscriptions();
            } else {
                $collSystemEventSubscriptions = SystemEventSubscriptionQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSystemEventSubscriptions;
                }
                $this->collSystemEventSubscriptions = $collSystemEventSubscriptions;
            }
        }

        return $this->collSystemEventSubscriptions;
    }

    /**
     * Sets a collection of SystemEventSubscription objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $systemEventSubscriptions A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setSystemEventSubscriptions(PropelCollection $systemEventSubscriptions, PropelPDO $con = null)
    {
        $this->systemEventSubscriptionsScheduledForDeletion = $this->getSystemEventSubscriptions(new Criteria(), $con)->diff($systemEventSubscriptions);

        foreach ($this->systemEventSubscriptionsScheduledForDeletion as $systemEventSubscriptionRemoved) {
            $systemEventSubscriptionRemoved->setUser(null);
        }

        $this->collSystemEventSubscriptions = null;
        foreach ($systemEventSubscriptions as $systemEventSubscription) {
            $this->addSystemEventSubscription($systemEventSubscription);
        }

        $this->collSystemEventSubscriptions = $systemEventSubscriptions;
    }

    /**
     * Returns the number of related SystemEventSubscription objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related SystemEventSubscription objects.
     * @throws PropelException
     */
    public function countSystemEventSubscriptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSystemEventSubscriptions || null !== $criteria) {
            if ($this->isNew() && null === $this->collSystemEventSubscriptions) {
                return 0;
            } else {
                $query = SystemEventSubscriptionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collSystemEventSubscriptions);
        }
    }

    /**
     * Method called to associate a SystemEventSubscription object to this object
     * through the SystemEventSubscription foreign key attribute.
     *
     * @param    SystemEventSubscription $l SystemEventSubscription
     * @return   User The current object (for fluent API support)
     */
    public function addSystemEventSubscription(SystemEventSubscription $l)
    {
        if ($this->collSystemEventSubscriptions === null) {
            $this->initSystemEventSubscriptions();
        }
        if (!$this->collSystemEventSubscriptions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddSystemEventSubscription($l);
        }

        return $this;
    }

    /**
     * @param	SystemEventSubscription $systemEventSubscription The systemEventSubscription object to add.
     */
    protected function doAddSystemEventSubscription($systemEventSubscription)
    {
        $this->collSystemEventSubscriptions[]= $systemEventSubscription;
        $systemEventSubscription->setUser($this);
    }

    /**
     * @param	SystemEventSubscription $systemEventSubscription The systemEventSubscription object to remove.
     */
    public function removeSystemEventSubscription($systemEventSubscription)
    {
        if ($this->getSystemEventSubscriptions()->contains($systemEventSubscription)) {
            $this->collSystemEventSubscriptions->remove($this->collSystemEventSubscriptions->search($systemEventSubscription));
            if (null === $this->systemEventSubscriptionsScheduledForDeletion) {
                $this->systemEventSubscriptionsScheduledForDeletion = clone $this->collSystemEventSubscriptions;
                $this->systemEventSubscriptionsScheduledForDeletion->clear();
            }
            $this->systemEventSubscriptionsScheduledForDeletion[]= $systemEventSubscription;
            $systemEventSubscription->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related SystemEventSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|SystemEventSubscription[] List of SystemEventSubscription objects
     */
    public function getSystemEventSubscriptionsJoinSystemEvent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SystemEventSubscriptionQuery::create(null, $criteria);
        $query->joinWith('SystemEvent', $join_behavior);

        return $this->getSystemEventSubscriptions($query, $con);
    }

    /**
     * Clears out the collSystemEventInstances collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSystemEventInstances()
     */
    public function clearSystemEventInstances()
    {
        $this->collSystemEventInstances = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSystemEventInstances collection.
     *
     * By default this just sets the collSystemEventInstances collection to an empty array (like clearcollSystemEventInstances());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSystemEventInstances($overrideExisting = true)
    {
        if (null !== $this->collSystemEventInstances && !$overrideExisting) {
            return;
        }
        $this->collSystemEventInstances = new PropelObjectCollection();
        $this->collSystemEventInstances->setModel('SystemEventInstance');
    }

    /**
     * Gets an array of SystemEventInstance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelObjectCollection|SystemEventInstance[] List of SystemEventInstance objects
     * @throws PropelException
     */
    public function getSystemEventInstances($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSystemEventInstances || null !== $criteria) {
            if ($this->isNew() && null === $this->collSystemEventInstances) {
                // return empty collection
                $this->initSystemEventInstances();
            } else {
                $collSystemEventInstances = SystemEventInstanceQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSystemEventInstances;
                }
                $this->collSystemEventInstances = $collSystemEventInstances;
            }
        }

        return $this->collSystemEventInstances;
    }

    /**
     * Sets a collection of SystemEventInstance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $systemEventInstances A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setSystemEventInstances(PropelCollection $systemEventInstances, PropelPDO $con = null)
    {
        $this->systemEventInstancesScheduledForDeletion = $this->getSystemEventInstances(new Criteria(), $con)->diff($systemEventInstances);

        foreach ($this->systemEventInstancesScheduledForDeletion as $systemEventInstanceRemoved) {
            $systemEventInstanceRemoved->setUser(null);
        }

        $this->collSystemEventInstances = null;
        foreach ($systemEventInstances as $systemEventInstance) {
            $this->addSystemEventInstance($systemEventInstance);
        }

        $this->collSystemEventInstances = $systemEventInstances;
    }

    /**
     * Returns the number of related SystemEventInstance objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related SystemEventInstance objects.
     * @throws PropelException
     */
    public function countSystemEventInstances(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSystemEventInstances || null !== $criteria) {
            if ($this->isNew() && null === $this->collSystemEventInstances) {
                return 0;
            } else {
                $query = SystemEventInstanceQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collSystemEventInstances);
        }
    }

    /**
     * Method called to associate a SystemEventInstance object to this object
     * through the SystemEventInstance foreign key attribute.
     *
     * @param    SystemEventInstance $l SystemEventInstance
     * @return   User The current object (for fluent API support)
     */
    public function addSystemEventInstance(SystemEventInstance $l)
    {
        if ($this->collSystemEventInstances === null) {
            $this->initSystemEventInstances();
        }
        if (!$this->collSystemEventInstances->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddSystemEventInstance($l);
        }

        return $this;
    }

    /**
     * @param	SystemEventInstance $systemEventInstance The systemEventInstance object to add.
     */
    protected function doAddSystemEventInstance($systemEventInstance)
    {
        $this->collSystemEventInstances[]= $systemEventInstance;
        $systemEventInstance->setUser($this);
    }

    /**
     * @param	SystemEventInstance $systemEventInstance The systemEventInstance object to remove.
     */
    public function removeSystemEventInstance($systemEventInstance)
    {
        if ($this->getSystemEventInstances()->contains($systemEventInstance)) {
            $this->collSystemEventInstances->remove($this->collSystemEventInstances->search($systemEventInstance));
            if (null === $this->systemEventInstancesScheduledForDeletion) {
                $this->systemEventInstancesScheduledForDeletion = clone $this->collSystemEventInstances;
                $this->systemEventInstancesScheduledForDeletion->clear();
            }
            $this->systemEventInstancesScheduledForDeletion[]= $systemEventInstance;
            $systemEventInstance->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related SystemEventInstances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|SystemEventInstance[] List of SystemEventInstance objects
     */
    public function getSystemEventInstancesJoinSystemEvent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SystemEventInstanceQuery::create(null, $criteria);
        $query->joinWith('SystemEvent', $join_behavior);

        return $this->getSystemEventInstances($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->password_reset_key = null;
        $this->sf_guard_user_id = null;
        $this->contact_id = null;
        $this->active = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collSessions) {
                foreach ($this->collSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSingleSignOnKeys) {
                foreach ($this->collSingleSignOnKeys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSystemEventSubscriptions) {
                foreach ($this->collSystemEventSubscriptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSystemEventInstances) {
                foreach ($this->collSystemEventInstances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collSessions instanceof PropelCollection) {
            $this->collSessions->clearIterator();
        }
        $this->collSessions = null;
        if ($this->collSingleSignOnKeys instanceof PropelCollection) {
            $this->collSingleSignOnKeys->clearIterator();
        }
        $this->collSingleSignOnKeys = null;
        if ($this->collSystemEventSubscriptions instanceof PropelCollection) {
            $this->collSystemEventSubscriptions->clearIterator();
        }
        $this->collSystemEventSubscriptions = null;
        if ($this->collSystemEventInstances instanceof PropelCollection) {
            $this->collSystemEventInstances->clearIterator();
        }
        $this->collSystemEventInstances = null;
        $this->aContact = null;
        $this->asfGuardUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * Catches calls to virtual methods
     */
    public function __call($name, $params)
    {
        
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BaseUser:' . $name))
		{
		  array_unshift($params, $this);
		  return call_user_func_array($callable, $params);
		}


        return parent::__call($name, $params);
    }

} // BaseUser
