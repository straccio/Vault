<?php


/**
 * Base class that represents a row from the 'magic_cards' table.
 *
 * 
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseMagicCards extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'MagicCardsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MagicCardsPeer
	 */
	protected static $peer;

	/**
	 * The value for the nome_carta field.
	 * @var        string
	 */
	protected $nome_carta;

	/**
	 * The value for the colore field.
	 * @var        string
	 */
	protected $colore;

	/**
	 * The value for the tipo field.
	 * @var        string
	 */
	protected $tipo;

	/**
	 * The value for the costo field.
	 * @var        string
	 */
	protected $costo;

	/**
	 * The value for the f_c field.
	 * @var        string
	 */
	protected $f_c;

	/**
	 * The value for the testo field.
	 * @var        string
	 */
	protected $testo;

	/**
	 * The value for the set field.
	 * @var        string
	 */
	protected $set;

	/**
	 * The value for the rarita field.
	 * @var        string
	 */
	protected $rarita;

	/**
	 * The value for the cod_carta field.
	 * @var        string
	 */
	protected $cod_carta;

	/**
	 * The value for the english field.
	 * @var        string
	 */
	protected $english;

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
	 * Get the [nome_carta] column value.
	 * 
	 * @return     string
	 */
	public function getNomeCarta()
	{
		return $this->nome_carta;
	}

	/**
	 * Get the [colore] column value.
	 * 
	 * @return     string
	 */
	public function getColore()
	{
		return $this->colore;
	}

	/**
	 * Get the [tipo] column value.
	 * 
	 * @return     string
	 */
	public function getTipo()
	{
		return $this->tipo;
	}

	/**
	 * Get the [costo] column value.
	 * 
	 * @return     string
	 */
	public function getCosto()
	{
		return $this->costo;
	}

	/**
	 * Get the [f_c] column value.
	 * 
	 * @return     string
	 */
	public function getFC()
	{
		return $this->f_c;
	}

	/**
	 * Get the [testo] column value.
	 * 
	 * @return     string
	 */
	public function getTesto()
	{
		return $this->testo;
	}

	/**
	 * Get the [set] column value.
	 * 
	 * @return     string
	 */
	public function getSet()
	{
		return $this->set;
	}

	/**
	 * Get the [rarita] column value.
	 * 
	 * @return     string
	 */
	public function getRarita()
	{
		return $this->rarita;
	}

	/**
	 * Get the [cod_carta] column value.
	 * 
	 * @return     string
	 */
	public function getCodCarta()
	{
		return $this->cod_carta;
	}

	/**
	 * Get the [english] column value.
	 * 
	 * @return     string
	 */
	public function getEnglish()
	{
		return $this->english;
	}

	/**
	 * Set the value of [nome_carta] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setNomeCarta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nome_carta !== $v) {
			$this->nome_carta = $v;
			$this->modifiedColumns[] = MagicCardsPeer::NOME_CARTA;
		}

		return $this;
	} // setNomeCarta()

	/**
	 * Set the value of [colore] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setColore($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->colore !== $v) {
			$this->colore = $v;
			$this->modifiedColumns[] = MagicCardsPeer::COLORE;
		}

		return $this;
	} // setColore()

	/**
	 * Set the value of [tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tipo !== $v) {
			$this->tipo = $v;
			$this->modifiedColumns[] = MagicCardsPeer::TIPO;
		}

		return $this;
	} // setTipo()

	/**
	 * Set the value of [costo] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setCosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->costo !== $v) {
			$this->costo = $v;
			$this->modifiedColumns[] = MagicCardsPeer::COSTO;
		}

		return $this;
	} // setCosto()

	/**
	 * Set the value of [f_c] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setFC($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->f_c !== $v) {
			$this->f_c = $v;
			$this->modifiedColumns[] = MagicCardsPeer::F_C;
		}

		return $this;
	} // setFC()

	/**
	 * Set the value of [testo] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setTesto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->testo !== $v) {
			$this->testo = $v;
			$this->modifiedColumns[] = MagicCardsPeer::TESTO;
		}

		return $this;
	} // setTesto()

	/**
	 * Set the value of [set] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setSet($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->set !== $v) {
			$this->set = $v;
			$this->modifiedColumns[] = MagicCardsPeer::SET;
		}

		return $this;
	} // setSet()

	/**
	 * Set the value of [rarita] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setRarita($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->rarita !== $v) {
			$this->rarita = $v;
			$this->modifiedColumns[] = MagicCardsPeer::RARITA;
		}

		return $this;
	} // setRarita()

	/**
	 * Set the value of [cod_carta] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setCodCarta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cod_carta !== $v) {
			$this->cod_carta = $v;
			$this->modifiedColumns[] = MagicCardsPeer::COD_CARTA;
		}

		return $this;
	} // setCodCarta()

	/**
	 * Set the value of [english] column.
	 * 
	 * @param      string $v new value
	 * @return     MagicCards The current object (for fluent API support)
	 */
	public function setEnglish($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->english !== $v) {
			$this->english = $v;
			$this->modifiedColumns[] = MagicCardsPeer::ENGLISH;
		}

		return $this;
	} // setEnglish()

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

			$this->nome_carta = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->colore = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->tipo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->costo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->f_c = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->testo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->set = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->rarita = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->cod_carta = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->english = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 10; // 10 = MagicCardsPeer::NUM_COLUMNS - MagicCardsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating MagicCards object", $e);
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
			$con = Propel::getConnection(MagicCardsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MagicCardsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(MagicCardsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				MagicCardsQuery::create()
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
			$con = Propel::getConnection(MagicCardsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				MagicCardsPeer::addInstanceToPool($this);
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
					$affectedRows = MagicCardsPeer::doUpdate($this, $con);
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


			if (($retval = MagicCardsPeer::doValidate($this, $columns)) !== true) {
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
		$pos = MagicCardsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNomeCarta();
				break;
			case 1:
				return $this->getColore();
				break;
			case 2:
				return $this->getTipo();
				break;
			case 3:
				return $this->getCosto();
				break;
			case 4:
				return $this->getFC();
				break;
			case 5:
				return $this->getTesto();
				break;
			case 6:
				return $this->getSet();
				break;
			case 7:
				return $this->getRarita();
				break;
			case 8:
				return $this->getCodCarta();
				break;
			case 9:
				return $this->getEnglish();
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
		$keys = MagicCardsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNomeCarta(),
			$keys[1] => $this->getColore(),
			$keys[2] => $this->getTipo(),
			$keys[3] => $this->getCosto(),
			$keys[4] => $this->getFC(),
			$keys[5] => $this->getTesto(),
			$keys[6] => $this->getSet(),
			$keys[7] => $this->getRarita(),
			$keys[8] => $this->getCodCarta(),
			$keys[9] => $this->getEnglish(),
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
		$pos = MagicCardsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNomeCarta($value);
				break;
			case 1:
				$this->setColore($value);
				break;
			case 2:
				$this->setTipo($value);
				break;
			case 3:
				$this->setCosto($value);
				break;
			case 4:
				$this->setFC($value);
				break;
			case 5:
				$this->setTesto($value);
				break;
			case 6:
				$this->setSet($value);
				break;
			case 7:
				$this->setRarita($value);
				break;
			case 8:
				$this->setCodCarta($value);
				break;
			case 9:
				$this->setEnglish($value);
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
		$keys = MagicCardsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNomeCarta($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setColore($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCosto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFC($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTesto($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSet($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRarita($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCodCarta($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnglish($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MagicCardsPeer::DATABASE_NAME);

		if ($this->isColumnModified(MagicCardsPeer::NOME_CARTA)) $criteria->add(MagicCardsPeer::NOME_CARTA, $this->nome_carta);
		if ($this->isColumnModified(MagicCardsPeer::COLORE)) $criteria->add(MagicCardsPeer::COLORE, $this->colore);
		if ($this->isColumnModified(MagicCardsPeer::TIPO)) $criteria->add(MagicCardsPeer::TIPO, $this->tipo);
		if ($this->isColumnModified(MagicCardsPeer::COSTO)) $criteria->add(MagicCardsPeer::COSTO, $this->costo);
		if ($this->isColumnModified(MagicCardsPeer::F_C)) $criteria->add(MagicCardsPeer::F_C, $this->f_c);
		if ($this->isColumnModified(MagicCardsPeer::TESTO)) $criteria->add(MagicCardsPeer::TESTO, $this->testo);
		if ($this->isColumnModified(MagicCardsPeer::SET)) $criteria->add(MagicCardsPeer::SET, $this->set);
		if ($this->isColumnModified(MagicCardsPeer::RARITA)) $criteria->add(MagicCardsPeer::RARITA, $this->rarita);
		if ($this->isColumnModified(MagicCardsPeer::COD_CARTA)) $criteria->add(MagicCardsPeer::COD_CARTA, $this->cod_carta);
		if ($this->isColumnModified(MagicCardsPeer::ENGLISH)) $criteria->add(MagicCardsPeer::ENGLISH, $this->english);

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
		$criteria = new Criteria(MagicCardsPeer::DATABASE_NAME);
		$criteria->add(MagicCardsPeer::COD_CARTA, $this->cod_carta);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCodCarta();
	}

	/**
	 * Generic method to set the primary key (cod_carta column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCodCarta($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getCodCarta();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of MagicCards (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setNomeCarta($this->nome_carta);
		$copyObj->setColore($this->colore);
		$copyObj->setTipo($this->tipo);
		$copyObj->setCosto($this->costo);
		$copyObj->setFC($this->f_c);
		$copyObj->setTesto($this->testo);
		$copyObj->setSet($this->set);
		$copyObj->setRarita($this->rarita);
		$copyObj->setCodCarta($this->cod_carta);
		$copyObj->setEnglish($this->english);

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
	 * @return     MagicCards Clone of current object.
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
	 * @return     MagicCardsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MagicCardsPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->nome_carta = null;
		$this->colore = null;
		$this->tipo = null;
		$this->costo = null;
		$this->f_c = null;
		$this->testo = null;
		$this->set = null;
		$this->rarita = null;
		$this->cod_carta = null;
		$this->english = null;
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

} // BaseMagicCards
