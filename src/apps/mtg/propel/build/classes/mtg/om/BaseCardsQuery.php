<?php


/**
 * Base class that represents a query for the 'cards' table.
 *
 * 
 *
 * @method     CardsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CardsQuery orderBySetid($order = Criteria::ASC) Order by the setid column
 * @method     CardsQuery orderByNameen($order = Criteria::ASC) Order by the nameEN column
 * @method     CardsQuery orderByNameit($order = Criteria::ASC) Order by the nameIT column
 * @method     CardsQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     CardsQuery orderByTexten($order = Criteria::ASC) Order by the textEN column
 * @method     CardsQuery orderByTypeit($order = Criteria::ASC) Order by the typeIT column
 * @method     CardsQuery orderByCost($order = Criteria::ASC) Order by the cost column
 * @method     CardsQuery orderByConvertedcost($order = Criteria::ASC) Order by the convertedCost column
 * @method     CardsQuery orderByTypeen($order = Criteria::ASC) Order by the typeEN column
 * @method     CardsQuery orderByTextit($order = Criteria::ASC) Order by the textIT column
 * @method     CardsQuery orderByFc($order = Criteria::ASC) Order by the FC column
 * @method     CardsQuery orderByRarity($order = Criteria::ASC) Order by the rarity column
 * @method     CardsQuery orderByFlavor($order = Criteria::ASC) Order by the flavor column
 * @method     CardsQuery orderByArtist($order = Criteria::ASC) Order by the artist column
 * @method     CardsQuery orderByScript($order = Criteria::ASC) Order by the script column
 *
 * @method     CardsQuery groupById() Group by the id column
 * @method     CardsQuery groupBySetid() Group by the setid column
 * @method     CardsQuery groupByNameen() Group by the nameEN column
 * @method     CardsQuery groupByNameit() Group by the nameIT column
 * @method     CardsQuery groupByColor() Group by the color column
 * @method     CardsQuery groupByTexten() Group by the textEN column
 * @method     CardsQuery groupByTypeit() Group by the typeIT column
 * @method     CardsQuery groupByCost() Group by the cost column
 * @method     CardsQuery groupByConvertedcost() Group by the convertedCost column
 * @method     CardsQuery groupByTypeen() Group by the typeEN column
 * @method     CardsQuery groupByTextit() Group by the textIT column
 * @method     CardsQuery groupByFc() Group by the FC column
 * @method     CardsQuery groupByRarity() Group by the rarity column
 * @method     CardsQuery groupByFlavor() Group by the flavor column
 * @method     CardsQuery groupByArtist() Group by the artist column
 * @method     CardsQuery groupByScript() Group by the script column
 *
 * @method     CardsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CardsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CardsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Cards findOne(PropelPDO $con = null) Return the first Cards matching the query
 * @method     Cards findOneOrCreate(PropelPDO $con = null) Return the first Cards matching the query, or a new Cards object populated from the query conditions when no match is found
 *
 * @method     Cards findOneById(string $id) Return the first Cards filtered by the id column
 * @method     Cards findOneBySetid(string $setid) Return the first Cards filtered by the setid column
 * @method     Cards findOneByNameen(string $nameEN) Return the first Cards filtered by the nameEN column
 * @method     Cards findOneByNameit(string $nameIT) Return the first Cards filtered by the nameIT column
 * @method     Cards findOneByColor(string $color) Return the first Cards filtered by the color column
 * @method     Cards findOneByTexten(string $textEN) Return the first Cards filtered by the textEN column
 * @method     Cards findOneByTypeit(string $typeIT) Return the first Cards filtered by the typeIT column
 * @method     Cards findOneByCost(string $cost) Return the first Cards filtered by the cost column
 * @method     Cards findOneByConvertedcost(string $convertedCost) Return the first Cards filtered by the convertedCost column
 * @method     Cards findOneByTypeen(string $typeEN) Return the first Cards filtered by the typeEN column
 * @method     Cards findOneByTextit(string $textIT) Return the first Cards filtered by the textIT column
 * @method     Cards findOneByFc(string $FC) Return the first Cards filtered by the FC column
 * @method     Cards findOneByRarity(string $rarity) Return the first Cards filtered by the rarity column
 * @method     Cards findOneByFlavor(string $flavor) Return the first Cards filtered by the flavor column
 * @method     Cards findOneByArtist(string $artist) Return the first Cards filtered by the artist column
 * @method     Cards findOneByScript(string $script) Return the first Cards filtered by the script column
 *
 * @method     array findById(string $id) Return Cards objects filtered by the id column
 * @method     array findBySetid(string $setid) Return Cards objects filtered by the setid column
 * @method     array findByNameen(string $nameEN) Return Cards objects filtered by the nameEN column
 * @method     array findByNameit(string $nameIT) Return Cards objects filtered by the nameIT column
 * @method     array findByColor(string $color) Return Cards objects filtered by the color column
 * @method     array findByTexten(string $textEN) Return Cards objects filtered by the textEN column
 * @method     array findByTypeit(string $typeIT) Return Cards objects filtered by the typeIT column
 * @method     array findByCost(string $cost) Return Cards objects filtered by the cost column
 * @method     array findByConvertedcost(string $convertedCost) Return Cards objects filtered by the convertedCost column
 * @method     array findByTypeen(string $typeEN) Return Cards objects filtered by the typeEN column
 * @method     array findByTextit(string $textIT) Return Cards objects filtered by the textIT column
 * @method     array findByFc(string $FC) Return Cards objects filtered by the FC column
 * @method     array findByRarity(string $rarity) Return Cards objects filtered by the rarity column
 * @method     array findByFlavor(string $flavor) Return Cards objects filtered by the flavor column
 * @method     array findByArtist(string $artist) Return Cards objects filtered by the artist column
 * @method     array findByScript(string $script) Return Cards objects filtered by the script column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseCardsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCardsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'Cards', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CardsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CardsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CardsQuery) {
			return $criteria;
		}
		$query = new CardsQuery();
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
	 * @return    Cards|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CardsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CardsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CardsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     string $id The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the setid column
	 * 
	 * @param     string $setid The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterBySetid($setid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($setid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $setid)) {
				$setid = str_replace('*', '%', $setid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::SETID, $setid, $comparison);
	}

	/**
	 * Filter the query on the nameEN column
	 * 
	 * @param     string $nameen The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByNameen($nameen = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nameen)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nameen)) {
				$nameen = str_replace('*', '%', $nameen);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::NAMEEN, $nameen, $comparison);
	}

	/**
	 * Filter the query on the nameIT column
	 * 
	 * @param     string $nameit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByNameit($nameit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nameit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nameit)) {
				$nameit = str_replace('*', '%', $nameit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::NAMEIT, $nameit, $comparison);
	}

	/**
	 * Filter the query on the color column
	 * 
	 * @param     string $color The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByColor($color = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($color)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $color)) {
				$color = str_replace('*', '%', $color);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::COLOR, $color, $comparison);
	}

	/**
	 * Filter the query on the textEN column
	 * 
	 * @param     string $texten The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsPeer::TEXTEN, $texten, $comparison);
	}

	/**
	 * Filter the query on the typeIT column
	 * 
	 * @param     string $typeit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByTypeit($typeit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($typeit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $typeit)) {
				$typeit = str_replace('*', '%', $typeit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::TYPEIT, $typeit, $comparison);
	}

	/**
	 * Filter the query on the cost column
	 * 
	 * @param     string $cost The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByCost($cost = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cost)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cost)) {
				$cost = str_replace('*', '%', $cost);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::COST, $cost, $comparison);
	}

	/**
	 * Filter the query on the convertedCost column
	 * 
	 * @param     string $convertedcost The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByConvertedcost($convertedcost = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($convertedcost)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $convertedcost)) {
				$convertedcost = str_replace('*', '%', $convertedcost);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::CONVERTEDCOST, $convertedcost, $comparison);
	}

	/**
	 * Filter the query on the typeEN column
	 * 
	 * @param     string $typeen The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByTypeen($typeen = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($typeen)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $typeen)) {
				$typeen = str_replace('*', '%', $typeen);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::TYPEEN, $typeen, $comparison);
	}

	/**
	 * Filter the query on the textIT column
	 * 
	 * @param     string $textit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsPeer::TEXTIT, $textit, $comparison);
	}

	/**
	 * Filter the query on the FC column
	 * 
	 * @param     string $fc The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByFc($fc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fc)) {
				$fc = str_replace('*', '%', $fc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::FC, $fc, $comparison);
	}

	/**
	 * Filter the query on the rarity column
	 * 
	 * @param     string $rarity The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByRarity($rarity = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($rarity)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $rarity)) {
				$rarity = str_replace('*', '%', $rarity);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::RARITY, $rarity, $comparison);
	}

	/**
	 * Filter the query on the flavor column
	 * 
	 * @param     string $flavor The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByFlavor($flavor = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($flavor)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $flavor)) {
				$flavor = str_replace('*', '%', $flavor);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::FLAVOR, $flavor, $comparison);
	}

	/**
	 * Filter the query on the artist column
	 * 
	 * @param     string $artist The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByArtist($artist = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($artist)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $artist)) {
				$artist = str_replace('*', '%', $artist);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::ARTIST, $artist, $comparison);
	}

	/**
	 * Filter the query on the script column
	 * 
	 * @param     string $script The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function filterByScript($script = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($script)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $script)) {
				$script = str_replace('*', '%', $script);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardsPeer::SCRIPT, $script, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Cards $cards Object to remove from the list of results
	 *
	 * @return    CardsQuery The current query, for fluid interface
	 */
	public function prune($cards = null)
	{
		if ($cards) {
			$this->addUsingAlias(CardsPeer::ID, $cards->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCardsQuery
