<?php


/**
 * Base class that represents a query for the 'cardabilities' table.
 *
 * 
 *
 * @method     CardabilitiesQuery orderByCardcode($order = Criteria::ASC) Order by the cardcode column
 * @method     CardabilitiesQuery orderByAbilityid($order = Criteria::ASC) Order by the abilityid column
 *
 * @method     CardabilitiesQuery groupByCardcode() Group by the cardcode column
 * @method     CardabilitiesQuery groupByAbilityid() Group by the abilityid column
 *
 * @method     CardabilitiesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CardabilitiesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CardabilitiesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Cardabilities findOne(PropelPDO $con = null) Return the first Cardabilities matching the query
 * @method     Cardabilities findOneOrCreate(PropelPDO $con = null) Return the first Cardabilities matching the query, or a new Cardabilities object populated from the query conditions when no match is found
 *
 * @method     Cardabilities findOneByCardcode(string $cardcode) Return the first Cardabilities filtered by the cardcode column
 * @method     Cardabilities findOneByAbilityid(int $abilityid) Return the first Cardabilities filtered by the abilityid column
 *
 * @method     array findByCardcode(string $cardcode) Return Cardabilities objects filtered by the cardcode column
 * @method     array findByAbilityid(int $abilityid) Return Cardabilities objects filtered by the abilityid column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseCardabilitiesQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCardabilitiesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Cardabilities', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CardabilitiesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CardabilitiesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CardabilitiesQuery) {
			return $criteria;
		}
		$query = new CardabilitiesQuery();
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
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 * @param     array[$cardcode, $abilityid] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Cardabilities|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CardabilitiesPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    CardabilitiesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(CardabilitiesPeer::CARDCODE, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(CardabilitiesPeer::ABILITYID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CardabilitiesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(CardabilitiesPeer::CARDCODE, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(CardabilitiesPeer::ABILITYID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the cardcode column
	 * 
	 * @param     string $cardcode The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardabilitiesQuery The current query, for fluid interface
	 */
	public function filterByCardcode($cardcode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardcode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardcode)) {
				$cardcode = str_replace('*', '%', $cardcode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardabilitiesPeer::CARDCODE, $cardcode, $comparison);
	}

	/**
	 * Filter the query on the abilityid column
	 * 
	 * @param     int|array $abilityid The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardabilitiesQuery The current query, for fluid interface
	 */
	public function filterByAbilityid($abilityid = null, $comparison = null)
	{
		if (is_array($abilityid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CardabilitiesPeer::ABILITYID, $abilityid, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Cardabilities $cardabilities Object to remove from the list of results
	 *
	 * @return    CardabilitiesQuery The current query, for fluid interface
	 */
	public function prune($cardabilities = null)
	{
		if ($cardabilities) {
			$this->addCond('pruneCond0', $this->getAliasedColName(CardabilitiesPeer::CARDCODE), $cardabilities->getCardcode(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(CardabilitiesPeer::ABILITYID), $cardabilities->getAbilityid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseCardabilitiesQuery
