<?php


/**
 * Base class that represents a query for the 'abscript' table.
 *
 * 
 *
 * @method     AbscriptQuery orderByAbility($order = Criteria::ASC) Order by the ability column
 * @method     AbscriptQuery orderBySample($order = Criteria::ASC) Order by the sample column
 *
 * @method     AbscriptQuery groupByAbility() Group by the ability column
 * @method     AbscriptQuery groupBySample() Group by the sample column
 *
 * @method     AbscriptQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AbscriptQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AbscriptQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Abscript findOne(PropelPDO $con = null) Return the first Abscript matching the query
 * @method     Abscript findOneOrCreate(PropelPDO $con = null) Return the first Abscript matching the query, or a new Abscript object populated from the query conditions when no match is found
 *
 * @method     Abscript findOneByAbility(string $ability) Return the first Abscript filtered by the ability column
 * @method     Abscript findOneBySample(string $sample) Return the first Abscript filtered by the sample column
 *
 * @method     array findByAbility(string $ability) Return Abscript objects filtered by the ability column
 * @method     array findBySample(string $sample) Return Abscript objects filtered by the sample column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseAbscriptQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseAbscriptQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Abscript', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AbscriptQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AbscriptQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AbscriptQuery) {
			return $criteria;
		}
		$query = new AbscriptQuery();
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
	 * @return    Abscript|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = AbscriptPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    AbscriptQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AbscriptPeer::ABILITY, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AbscriptQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AbscriptPeer::ABILITY, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the ability column
	 * 
	 * @param     string $ability The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbscriptQuery The current query, for fluid interface
	 */
	public function filterByAbility($ability = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($ability)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $ability)) {
				$ability = str_replace('*', '%', $ability);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbscriptPeer::ABILITY, $ability, $comparison);
	}

	/**
	 * Filter the query on the sample column
	 * 
	 * @param     string $sample The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbscriptQuery The current query, for fluid interface
	 */
	public function filterBySample($sample = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($sample)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $sample)) {
				$sample = str_replace('*', '%', $sample);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbscriptPeer::SAMPLE, $sample, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Abscript $abscript Object to remove from the list of results
	 *
	 * @return    AbscriptQuery The current query, for fluid interface
	 */
	public function prune($abscript = null)
	{
		if ($abscript) {
			$this->addUsingAlias(AbscriptPeer::ABILITY, $abscript->getAbility(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseAbscriptQuery
