<?php


/**
 * Base class that represents a query for the 'sets' table.
 *
 * 
 *
 * @method     SetsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SetsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SetsQuery orderByDate($order = Criteria::ASC) Order by the date column
 *
 * @method     SetsQuery groupById() Group by the id column
 * @method     SetsQuery groupByName() Group by the name column
 * @method     SetsQuery groupByDate() Group by the date column
 *
 * @method     SetsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SetsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SetsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Sets findOne(PropelPDO $con = null) Return the first Sets matching the query
 * @method     Sets findOneOrCreate(PropelPDO $con = null) Return the first Sets matching the query, or a new Sets object populated from the query conditions when no match is found
 *
 * @method     Sets findOneById(string $id) Return the first Sets filtered by the id column
 * @method     Sets findOneByName(string $name) Return the first Sets filtered by the name column
 * @method     Sets findOneByDate(string $date) Return the first Sets filtered by the date column
 *
 * @method     array findById(string $id) Return Sets objects filtered by the id column
 * @method     array findByName(string $name) Return Sets objects filtered by the name column
 * @method     array findByDate(string $date) Return Sets objects filtered by the date column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseSetsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSetsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Sets', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SetsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SetsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SetsQuery) {
			return $criteria;
		}
		$query = new SetsQuery();
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
	 * @return    Sets|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SetsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SetsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SetsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     string $id The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($id)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $id)) {
				$id = str_replace('*', '%', $id);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SetsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SetsPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the date column
	 * 
	 * @param     string|array $date The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function filterByDate($date = null, $comparison = null)
	{
		if (is_array($date)) {
			$useMinMax = false;
			if (isset($date['min'])) {
				$this->addUsingAlias(SetsPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($date['max'])) {
				$this->addUsingAlias(SetsPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SetsPeer::DATE, $date, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Sets $sets Object to remove from the list of results
	 *
	 * @return    SetsQuery The current query, for fluid interface
	 */
	public function prune($sets = null)
	{
		if ($sets) {
			$this->addUsingAlias(SetsPeer::ID, $sets->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSetsQuery
