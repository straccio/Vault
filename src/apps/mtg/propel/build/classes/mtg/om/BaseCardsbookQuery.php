<?php


/**
 * Base class that represents a query for the 'cardsbook' table.
 *
 * 
 *
 * @method     CardsbookQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CardsbookQuery orderByBookid($order = Criteria::ASC) Order by the bookid column
 * @method     CardsbookQuery orderByCardid($order = Criteria::ASC) Order by the cardid column
 * @method     CardsbookQuery orderByQta($order = Criteria::ASC) Order by the qta column
 *
 * @method     CardsbookQuery groupById() Group by the id column
 * @method     CardsbookQuery groupByBookid() Group by the bookid column
 * @method     CardsbookQuery groupByCardid() Group by the cardid column
 * @method     CardsbookQuery groupByQta() Group by the qta column
 *
 * @method     CardsbookQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CardsbookQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CardsbookQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Cardsbook findOne(PropelPDO $con = null) Return the first Cardsbook matching the query
 * @method     Cardsbook findOneOrCreate(PropelPDO $con = null) Return the first Cardsbook matching the query, or a new Cardsbook object populated from the query conditions when no match is found
 *
 * @method     Cardsbook findOneById(int $id) Return the first Cardsbook filtered by the id column
 * @method     Cardsbook findOneByBookid(int $bookid) Return the first Cardsbook filtered by the bookid column
 * @method     Cardsbook findOneByCardid(string $cardid) Return the first Cardsbook filtered by the cardid column
 * @method     Cardsbook findOneByQta(int $qta) Return the first Cardsbook filtered by the qta column
 *
 * @method     array findById(int $id) Return Cardsbook objects filtered by the id column
 * @method     array findByBookid(int $bookid) Return Cardsbook objects filtered by the bookid column
 * @method     array findByCardid(string $cardid) Return Cardsbook objects filtered by the cardid column
 * @method     array findByQta(int $qta) Return Cardsbook objects filtered by the qta column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseCardsbookQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCardsbookQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Cardsbook', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CardsbookQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CardsbookQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CardsbookQuery) {
			return $criteria;
		}
		$query = new CardsbookQuery();
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
	 * @return    Cardsbook|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CardsbookPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CardsbookPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CardsbookPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CardsbookPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the bookid column
	 * 
	 * @param     int|array $bookid The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterByBookid($bookid = null, $comparison = null)
	{
		if (is_array($bookid)) {
			$useMinMax = false;
			if (isset($bookid['min'])) {
				$this->addUsingAlias(CardsbookPeer::BOOKID, $bookid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bookid['max'])) {
				$this->addUsingAlias(CardsbookPeer::BOOKID, $bookid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CardsbookPeer::BOOKID, $bookid, $comparison);
	}

	/**
	 * Filter the query on the cardid column
	 * 
	 * @param     string $cardid The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterByCardid($cardid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardid)) {
				$cardid = str_replace('*', '%', $cardid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsbookPeer::CARDID, $cardid, $comparison);
	}

	/**
	 * Filter the query on the qta column
	 * 
	 * @param     int|array $qta The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function filterByQta($qta = null, $comparison = null)
	{
		if (is_array($qta)) {
			$useMinMax = false;
			if (isset($qta['min'])) {
				$this->addUsingAlias(CardsbookPeer::QTA, $qta['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($qta['max'])) {
				$this->addUsingAlias(CardsbookPeer::QTA, $qta['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CardsbookPeer::QTA, $qta, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Cardsbook $cardsbook Object to remove from the list of results
	 *
	 * @return    CardsbookQuery The current query, for fluid interface
	 */
	public function prune($cardsbook = null)
	{
		if ($cardsbook) {
			$this->addUsingAlias(CardsbookPeer::ID, $cardsbook->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCardsbookQuery
