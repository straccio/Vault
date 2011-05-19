<?php


/**
 * Base class that represents a row from the 'cards' table.
 *
 * 
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseCards extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CardsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CardsPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        string
	 */
	protected $id;

	/**
	 * The value for the setid field.
	 * @var        string
	 */
	protected $setid;

	/**
	 * The value for the nameen field.
	 * @var        string
	 */
	protected $nameen;

	/**
	 * The value for the nameit field.
	 * @var        string
	 */
	protected $nameit;

	/**
	 * The value for the color field.
	 * @var        string
	 */
	protected $color;

	/**
	 * The value for the texten field.
	 * @var        string
	 */
	protected $texten;

	/**
	 * The value for the typeit field.
	 * @var        string
	 */
	protected $typeit;

	/**
	 * The value for the cost field.
	 * @var        string
	 */
	protected $cost;

	/**
	 * The value for the convertedcost field.
	 * @var        string
	 */
	protected $convertedcost;

	/**
	 * The value for the typeen field.
	 * @var        string
	 */
	protected $typeen;

	/**
	 * The value for the textit field.
	 * @var        string
	 */
	protected $textit;

	/**
	 * The value for the fc field.
	 * @var        string
	 */
	protected $fc;

	/**
	 * The value for the rarity field.
	 * @var        string
	 */
	protected $rarity;

	/**
	 * The value for the flavor field.
	 * @var        string
	 */
	protected $flavor;

	/**
	 * The value for the artist field.
	 * @var        string
	 */
	protected $artist;

	/**
	 * The value for the script field.
	 * @var        string
	 */
	protected $script;

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
	 * Get the [id] column value.
	 * 
	 * @return     string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [setid] column value.
	 * 
	 * @return     string
	 */
	public function getSetid()
	{
		return $this->setid;
	}

	/**
	 * Get the [nameen] column value.
	 * 
	 * @return     string
	 */
	public function getNameen()
	{
		return $this->nameen;
	}

	/**
	 * Get the [nameit] column value.
	 * 
	 * @return     string
	 */
	public function getNameit()
	{
		return $this->nameit;
	}

	/**
	 * Get the [color] column value.
	 * 
	 * @return     string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * Get the [texten] column value.
	 * 
	 * @return     string
	 */
	public function getTexten()
	{
		return $this->texten;
	}

	/**
	 * Get the [typeit] column value.
	 * 
	 * @return     string
	 */
	public function getTypeit()
	{
		return $this->typeit;
	}

	/**
	 * Get the [cost] column value.
	 * 
	 * @return     string
	 */
	public function getCost()
	{
		return $this->cost;
	}

	/**
	 * Get the [convertedcost] column value.
	 * 
	 * @return     string
	 */
	public function getConvertedcost()
	{
		return $this->convertedcost;
	}

	/**
	 * Get the [typeen] column value.
	 * 
	 * @return     string
	 */
	public function getTypeen()
	{
		return $this->typeen;
	}

	/**
	 * Get the [textit] column value.
	 * 
	 * @return     string
	 */
	public function getTextit()
	{
		return $this->textit;
	}

	/**
	 * Get the [fc] column value.
	 * 
	 * @return     string
	 */
	public function getFc()
	{
		return $this->fc;
	}

	/**
	 * Get the [rarity] column value.
	 * 
	 * @return     string
	 */
	public function getRarity()
	{
		return $this->rarity;
	}

	/**
	 * Get the [flavor] column value.
	 * 
	 * @return     string
	 */
	public function getFlavor()
	{
		return $this->flavor;
	}

	/**
	 * Get the [artist] column value.
	 * 
	 * @return     string
	 */
	public function getArtist()
	{
		return $this->artist;
	}

	/**
	 * Get the [script] column value.
	 * 
	 * @return     string
	 */
	public function getScript()
	{
		return $this->script;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CardsPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [setid] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setSetid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->setid !== $v) {
			$this->setid = $v;
			$this->modifiedColumns[] = CardsPeer::SETID;
		}

		return $this;
	} // setSetid()

	/**
	 * Set the value of [nameen] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setNameen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nameen !== $v) {
			$this->nameen = $v;
			$this->modifiedColumns[] = CardsPeer::NAMEEN;
		}

		return $this;
	} // setNameen()

	/**
	 * Set the value of [nameit] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setNameit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nameit !== $v) {
			$this->nameit = $v;
			$this->modifiedColumns[] = CardsPeer::NAMEIT;
		}

		return $this;
	} // setNameit()

	/**
	 * Set the value of [color] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setColor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->color !== $v) {
			$this->color = $v;
			$this->modifiedColumns[] = CardsPeer::COLOR;
		}

		return $this;
	} // setColor()

	/**
	 * Set the value of [texten] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setTexten($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->texten !== $v) {
			$this->texten = $v;
			$this->modifiedColumns[] = CardsPeer::TEXTEN;
		}

		return $this;
	} // setTexten()

	/**
	 * Set the value of [typeit] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setTypeit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->typeit !== $v) {
			$this->typeit = $v;
			$this->modifiedColumns[] = CardsPeer::TYPEIT;
		}

		return $this;
	} // setTypeit()

	/**
	 * Set the value of [cost] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setCost($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cost !== $v) {
			$this->cost = $v;
			$this->modifiedColumns[] = CardsPeer::COST;
		}

		return $this;
	} // setCost()

	/**
	 * Set the value of [convertedcost] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setConvertedcost($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->convertedcost !== $v) {
			$this->convertedcost = $v;
			$this->modifiedColumns[] = CardsPeer::CONVERTEDCOST;
		}

		return $this;
	} // setConvertedcost()

	/**
	 * Set the value of [typeen] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setTypeen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->typeen !== $v) {
			$this->typeen = $v;
			$this->modifiedColumns[] = CardsPeer::TYPEEN;
		}

		return $this;
	} // setTypeen()

	/**
	 * Set the value of [textit] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setTextit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->textit !== $v) {
			$this->textit = $v;
			$this->modifiedColumns[] = CardsPeer::TEXTIT;
		}

		return $this;
	} // setTextit()

	/**
	 * Set the value of [fc] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setFc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->fc !== $v) {
			$this->fc = $v;
			$this->modifiedColumns[] = CardsPeer::FC;
		}

		return $this;
	} // setFc()

	/**
	 * Set the value of [rarity] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setRarity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->rarity !== $v) {
			$this->rarity = $v;
			$this->modifiedColumns[] = CardsPeer::RARITY;
		}

		return $this;
	} // setRarity()

	/**
	 * Set the value of [flavor] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setFlavor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->flavor !== $v) {
			$this->flavor = $v;
			$this->modifiedColumns[] = CardsPeer::FLAVOR;
		}

		return $this;
	} // setFlavor()

	/**
	 * Set the value of [artist] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setArtist($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->artist !== $v) {
			$this->artist = $v;
			$this->modifiedColumns[] = CardsPeer::ARTIST;
		}

		return $this;
	} // setArtist()

	/**
	 * Set the value of [script] column.
	 * 
	 * @param      string $v new value
	 * @return     Cards The current object (for fluent API support)
	 */
	public function setScript($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->script !== $v) {
			$this->script = $v;
			$this->modifiedColumns[] = CardsPeer::SCRIPT;
		}

		return $this;
	} // setScript()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
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
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->setid = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->nameen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->nameit = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->color = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->texten = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->typeit = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->cost = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->convertedcost = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->typeen = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->textit = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->fc = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->rarity = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->flavor = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->artist = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->script = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 16; // 16 = CardsPeer::NUM_COLUMNS - CardsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cards object", $e);
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
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
			$con = Propel::getConnection(CardsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CardsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CardsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				CardsQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
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
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CardsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
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
				CardsPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
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
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setNew(false);
				} else {
					$affectedRows = CardsPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
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
	 * @return     boolean Whether all columns pass validation.
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
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = CardsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CardsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSetid();
				break;
			case 2:
				return $this->getNameen();
				break;
			case 3:
				return $this->getNameit();
				break;
			case 4:
				return $this->getColor();
				break;
			case 5:
				return $this->getTexten();
				break;
			case 6:
				return $this->getTypeit();
				break;
			case 7:
				return $this->getCost();
				break;
			case 8:
				return $this->getConvertedcost();
				break;
			case 9:
				return $this->getTypeen();
				break;
			case 10:
				return $this->getTextit();
				break;
			case 11:
				return $this->getFc();
				break;
			case 12:
				return $this->getRarity();
				break;
			case 13:
				return $this->getFlavor();
				break;
			case 14:
				return $this->getArtist();
				break;
			case 15:
				return $this->getScript();
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
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CardsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSetid(),
			$keys[2] => $this->getNameen(),
			$keys[3] => $this->getNameit(),
			$keys[4] => $this->getColor(),
			$keys[5] => $this->getTexten(),
			$keys[6] => $this->getTypeit(),
			$keys[7] => $this->getCost(),
			$keys[8] => $this->getConvertedcost(),
			$keys[9] => $this->getTypeen(),
			$keys[10] => $this->getTextit(),
			$keys[11] => $this->getFc(),
			$keys[12] => $this->getRarity(),
			$keys[13] => $this->getFlavor(),
			$keys[14] => $this->getArtist(),
			$keys[15] => $this->getScript(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CardsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSetid($value);
				break;
			case 2:
				$this->setNameen($value);
				break;
			case 3:
				$this->setNameit($value);
				break;
			case 4:
				$this->setColor($value);
				break;
			case 5:
				$this->setTexten($value);
				break;
			case 6:
				$this->setTypeit($value);
				break;
			case 7:
				$this->setCost($value);
				break;
			case 8:
				$this->setConvertedcost($value);
				break;
			case 9:
				$this->setTypeen($value);
				break;
			case 10:
				$this->setTextit($value);
				break;
			case 11:
				$this->setFc($value);
				break;
			case 12:
				$this->setRarity($value);
				break;
			case 13:
				$this->setFlavor($value);
				break;
			case 14:
				$this->setArtist($value);
				break;
			case 15:
				$this->setScript($value);
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
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CardsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSetid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNameen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNameit($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setColor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTexten($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTypeit($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCost($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setConvertedcost($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTypeen($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTextit($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFc($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setRarity($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setFlavor($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setArtist($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setScript($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CardsPeer::DATABASE_NAME);

		if ($this->isColumnModified(CardsPeer::ID)) $criteria->add(CardsPeer::ID, $this->id);
		if ($this->isColumnModified(CardsPeer::SETID)) $criteria->add(CardsPeer::SETID, $this->setid);
		if ($this->isColumnModified(CardsPeer::NAMEEN)) $criteria->add(CardsPeer::NAMEEN, $this->nameen);
		if ($this->isColumnModified(CardsPeer::NAMEIT)) $criteria->add(CardsPeer::NAMEIT, $this->nameit);
		if ($this->isColumnModified(CardsPeer::COLOR)) $criteria->add(CardsPeer::COLOR, $this->color);
		if ($this->isColumnModified(CardsPeer::TEXTEN)) $criteria->add(CardsPeer::TEXTEN, $this->texten);
		if ($this->isColumnModified(CardsPeer::TYPEIT)) $criteria->add(CardsPeer::TYPEIT, $this->typeit);
		if ($this->isColumnModified(CardsPeer::COST)) $criteria->add(CardsPeer::COST, $this->cost);
		if ($this->isColumnModified(CardsPeer::CONVERTEDCOST)) $criteria->add(CardsPeer::CONVERTEDCOST, $this->convertedcost);
		if ($this->isColumnModified(CardsPeer::TYPEEN)) $criteria->add(CardsPeer::TYPEEN, $this->typeen);
		if ($this->isColumnModified(CardsPeer::TEXTIT)) $criteria->add(CardsPeer::TEXTIT, $this->textit);
		if ($this->isColumnModified(CardsPeer::FC)) $criteria->add(CardsPeer::FC, $this->fc);
		if ($this->isColumnModified(CardsPeer::RARITY)) $criteria->add(CardsPeer::RARITY, $this->rarity);
		if ($this->isColumnModified(CardsPeer::FLAVOR)) $criteria->add(CardsPeer::FLAVOR, $this->flavor);
		if ($this->isColumnModified(CardsPeer::ARTIST)) $criteria->add(CardsPeer::ARTIST, $this->artist);
		if ($this->isColumnModified(CardsPeer::SCRIPT)) $criteria->add(CardsPeer::SCRIPT, $this->script);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CardsPeer::DATABASE_NAME);
		$criteria->add(CardsPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
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
	 * @param      object $copyObj An object of Cards (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setId($this->id);
		$copyObj->setSetid($this->setid);
		$copyObj->setNameen($this->nameen);
		$copyObj->setNameit($this->nameit);
		$copyObj->setColor($this->color);
		$copyObj->setTexten($this->texten);
		$copyObj->setTypeit($this->typeit);
		$copyObj->setCost($this->cost);
		$copyObj->setConvertedcost($this->convertedcost);
		$copyObj->setTypeen($this->typeen);
		$copyObj->setTextit($this->textit);
		$copyObj->setFc($this->fc);
		$copyObj->setRarity($this->rarity);
		$copyObj->setFlavor($this->flavor);
		$copyObj->setArtist($this->artist);
		$copyObj->setScript($this->script);

		$copyObj->setNew(true);
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
	 * @return     Cards Clone of current object.
	 * @throws     PropelException
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
	 * @return     CardsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CardsPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->setid = null;
		$this->nameen = null;
		$this->nameit = null;
		$this->color = null;
		$this->texten = null;
		$this->typeit = null;
		$this->cost = null;
		$this->convertedcost = null;
		$this->typeen = null;
		$this->textit = null;
		$this->fc = null;
		$this->rarity = null;
		$this->flavor = null;
		$this->artist = null;
		$this->script = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseCards
