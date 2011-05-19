<?php


/**
 * Base class that represents a query for the 'ability' table.
 *
 * 
 *
 * @method     AbilityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AbilityQuery orderByTextit($order = Criteria::ASC) Order by the textIT column
 * @method     AbilityQuery orderByTexten($order = Criteria::ASC) Order by the textEN column
 * @method     AbilityQuery orderByRegex($order = Criteria::ASC) Order by the RegEx column
 * @method     AbilityQuery orderByDescriptionit($order = Criteria::ASC) Order by the descriptionIT column
 * @method     AbilityQuery orderByDescriptionen($order = Criteria::ASC) Order by the descriptionEN column
 *
 * @method     AbilityQuery groupById() Group by the id column
 * @method     AbilityQuery groupByTextit() Group by the textIT column
 * @method     AbilityQuery groupByTexten() Group by the textEN column
 * @method     AbilityQuery groupByRegex() Group by the RegEx column
 * @method     AbilityQuery groupByDescriptionit() Group by the descriptionIT column
 * @method     AbilityQuery groupByDescriptionen() Group by the descriptionEN column
 *
 * @method     AbilityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AbilityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AbilityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Ability findOne(PropelPDO $con = null) Return the first Ability matching the query
 * @method     Ability findOneOrCreate(PropelPDO $con = null) Return the first Ability matching the query, or a new Ability object populated from the query conditions when no match is found
 *
 * @method     Ability findOneById(int $id) Return the first Ability filtered by the id column
 * @method     Ability findOneByTextit(string $textIT) Return the first Ability filtered by the textIT column
 * @method     Ability findOneByTexten(string $textEN) Return the first Ability filtered by the textEN column
 * @method     Ability findOneByRegex(string $RegEx) Return the first Ability filtered by the RegEx column
 * @method     Ability findOneByDescriptionit(string $descriptionIT) Return the first Ability filtered by the descriptionIT column
 * @method     Ability findOneByDescriptionen(string $descriptionEN) Return the first Ability filtered by the descriptionEN column
 *
 * @method     array findById(int $id) Return Ability objects filtered by the id column
 * @method     array findByTextit(string $textIT) Return Ability objects filtered by the textIT column
 * @method     array findByTexten(string $textEN) Return Ability objects filtered by the textEN column
 * @method     array findByRegex(string $RegEx) Return Ability objects filtered by the RegEx column
 * @method     array findByDescriptionit(string $descriptionIT) Return Ability objects filtered by the descriptionIT column
 * @method     array findByDescriptionen(string $descriptionEN) Return Ability objects filtered by the descriptionEN column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseAbilityQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseAbilityQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Ability', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AbilityQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AbilityQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AbilityQuery) {
			return $criteria;
		}
		$query = new AbilityQuery();
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
	 * @return    Ability|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = AbilityPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AbilityPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AbilityPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AbilityPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the textIT column
	 * 
	 * @param     string $textit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByTextit($textit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($textit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $textit)) {
				$textit = str_replace('*', '%', $textit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbilityPeer::TEXTIT, $textit, $comparison);
	}

	/**
	 * Filter the query on the textEN column
	 * 
	 * @param     string $texten The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByTexten($texten = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($texten)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $texten)) {
				$texten = str_replace('*', '%', $texten);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbilityPeer::TEXTEN, $texten, $comparison);
	}

	/**
	 * Filter the query on the RegEx column
	 * 
	 * @param     string $regex The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByRegex($regex = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($regex)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $regex)) {
				$regex = str_replace('*', '%', $regex);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbilityPeer::REGEX, $regex, $comparison);
	}

	/**
	 * Filter the query on the descriptionIT column
	 * 
	 * @param     string $descriptionit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByDescriptionit($descriptionit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($descriptionit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $descriptionit)) {
				$descriptionit = str_replace('*', '%', $descriptionit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbilityPeer::DESCRIPTIONIT, $descriptionit, $comparison);
	}

	/**
	 * Filter the query on the descriptionEN column
	 * 
	 * @param     string $descriptionen The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function filterByDescriptionen($descriptionen = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($descriptionen)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $descriptionen)) {
				$descriptionen = str_replace('*', '%', $descriptionen);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AbilityPeer::DESCRIPTIONEN, $descriptionen, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Ability $ability Object to remove from the list of results
	 *
	 * @return    AbilityQuery The current query, for fluid interface
	 */
	public function prune($ability = null)
	{
		if ($ability) {
			$this->addUsingAlias(AbilityPeer::ID, $ability->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseAbilityQuery
