<?php


/**
 * Base class that represents a query for the 'players' table.
 *
 * 
 *
 * @method     PlayersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PlayersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     PlayersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     PlayersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     PlayersQuery orderByExp($order = Criteria::ASC) Order by the exp column
 *
 * @method     PlayersQuery groupById() Group by the id column
 * @method     PlayersQuery groupByUsername() Group by the username column
 * @method     PlayersQuery groupByPassword() Group by the password column
 * @method     PlayersQuery groupByEmail() Group by the email column
 * @method     PlayersQuery groupByExp() Group by the exp column
 *
 * @method     PlayersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PlayersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PlayersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Players findOne(PropelPDO $con = null) Return the first Players matching the query
 * @method     Players findOneOrCreate(PropelPDO $con = null) Return the first Players matching the query, or a new Players object populated from the query conditions when no match is found
 *
 * @method     Players findOneById(int $id) Return the first Players filtered by the id column
 * @method     Players findOneByUsername(string $username) Return the first Players filtered by the username column
 * @method     Players findOneByPassword(string $password) Return the first Players filtered by the password column
 * @method     Players findOneByEmail(string $email) Return the first Players filtered by the email column
 * @method     Players findOneByExp(string $exp) Return the first Players filtered by the exp column
 *
 * @method     array findById(int $id) Return Players objects filtered by the id column
 * @method     array findByUsername(string $username) Return Players objects filtered by the username column
 * @method     array findByPassword(string $password) Return Players objects filtered by the password column
 * @method     array findByEmail(string $email) Return Players objects filtered by the email column
 * @method     array findByExp(string $exp) Return Players objects filtered by the exp column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BasePlayersQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasePlayersQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Players', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PlayersQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PlayersQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PlayersQuery) {
			return $criteria;
		}
		$query = new PlayersQuery();
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
	 * @return    Players|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = PlayersPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PlayersPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PlayersPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PlayersPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the username column
	 * 
	 * @param     string $username The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByUsername($username = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($username)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $username)) {
				$username = str_replace('*', '%', $username);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PlayersPeer::USERNAME, $username, $comparison);
	}

	/**
	 * Filter the query on the password column
	 * 
	 * @param     string $password The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByPassword($password = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($password)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $password)) {
				$password = str_replace('*', '%', $password);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PlayersPeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query on the email column
	 * 
	 * @param     string $email The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByEmail($email = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($email)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $email)) {
				$email = str_replace('*', '%', $email);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PlayersPeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the exp column
	 * 
	 * @param     string|array $exp The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function filterByExp($exp = null, $comparison = null)
	{
		if (is_array($exp)) {
			$useMinMax = false;
			if (isset($exp['min'])) {
				$this->addUsingAlias(PlayersPeer::EXP, $exp['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($exp['max'])) {
				$this->addUsingAlias(PlayersPeer::EXP, $exp['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PlayersPeer::EXP, $exp, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Players $players Object to remove from the list of results
	 *
	 * @return    PlayersQuery The current query, for fluid interface
	 */
	public function prune($players = null)
	{
		if ($players) {
			$this->addUsingAlias(PlayersPeer::ID, $players->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BasePlayersQuery
