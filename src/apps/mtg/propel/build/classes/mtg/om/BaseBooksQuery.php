<?php


/**
 * Base class that represents a query for the 'books' table.
 *
 * 
 *
 * @method     BooksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BooksQuery orderByPlayerid($order = Criteria::ASC) Order by the playerid column
 *
 * @method     BooksQuery groupById() Group by the id column
 * @method     BooksQuery groupByPlayerid() Group by the playerid column
 *
 * @method     BooksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BooksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BooksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Books findOne(PropelPDO $con = null) Return the first Books matching the query
 * @method     Books findOneOrCreate(PropelPDO $con = null) Return the first Books matching the query, or a new Books object populated from the query conditions when no match is found
 *
 * @method     Books findOneById(int $id) Return the first Books filtered by the id column
 * @method     Books findOneByPlayerid(int $playerid) Return the first Books filtered by the playerid column
 *
 * @method     array findById(int $id) Return Books objects filtered by the id column
 * @method     array findByPlayerid(int $playerid) Return Books objects filtered by the playerid column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseBooksQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseBooksQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Books', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BooksQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BooksQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BooksQuery) {
			return $criteria;
		}
		$query = new BooksQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Books|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = BooksPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    BooksQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BooksPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BooksQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BooksPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BooksQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BooksPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the playerid column
	 * 
	 * @param     int|array $playerid The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BooksQuery The current query, for fluid interface
	 */
	public function filterByPlayerid($playerid = null, $comparison = null)
	{
		if (is_array($playerid)) {
			$useMinMax = false;
			if (isset($playerid['min'])) {
				$this->addUsingAlias(BooksPeer::PLAYERID, $playerid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($playerid['max'])) {
				$this->addUsingAlias(BooksPeer::PLAYERID, $playerid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BooksPeer::PLAYERID, $playerid, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Books $books Object to remove from the list of results
	 *
	 * @return    BooksQuery The current query, for fluid interface
	 */
	public function prune($books = null)
	{
		if ($books) {
			$this->addUsingAlias(BooksPeer::ID, $books->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseBooksQuery
