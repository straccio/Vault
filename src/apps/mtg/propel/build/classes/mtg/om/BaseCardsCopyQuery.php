<?php


/**
 * Base class that represents a query for the 'cards_copy' table.
 *
 * 
 *
 * @method     CardsCopyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CardsCopyQuery orderBySetid($order = Criteria::ASC) Order by the setid column
 * @method     CardsCopyQuery orderByNameen($order = Criteria::ASC) Order by the nameEN column
 * @method     CardsCopyQuery orderByNameit($order = Criteria::ASC) Order by the nameIT column
 * @method     CardsCopyQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     CardsCopyQuery orderByTypeit($order = Criteria::ASC) Order by the typeIT column
 * @method     CardsCopyQuery orderByCost($order = Criteria::ASC) Order by the cost column
 * @method     CardsCopyQuery orderByTexten($order = Criteria::ASC) Order by the textEN column
 * @method     CardsCopyQuery orderByTextit($order = Criteria::ASC) Order by the textIT column
 * @method     CardsCopyQuery orderByFc($order = Criteria::ASC) Order by the FC column
 * @method     CardsCopyQuery orderByRarity($order = Criteria::ASC) Order by the rarity column
 * @method     CardsCopyQuery orderByFlavor($order = Criteria::ASC) Order by the flavor column
 * @method     CardsCopyQuery orderByArtist($order = Criteria::ASC) Order by the artist column
 *
 * @method     CardsCopyQuery groupById() Group by the id column
 * @method     CardsCopyQuery groupBySetid() Group by the setid column
 * @method     CardsCopyQuery groupByNameen() Group by the nameEN column
 * @method     CardsCopyQuery groupByNameit() Group by the nameIT column
 * @method     CardsCopyQuery groupByColor() Group by the color column
 * @method     CardsCopyQuery groupByTypeit() Group by the typeIT column
 * @method     CardsCopyQuery groupByCost() Group by the cost column
 * @method     CardsCopyQuery groupByTexten() Group by the textEN column
 * @method     CardsCopyQuery groupByTextit() Group by the textIT column
 * @method     CardsCopyQuery groupByFc() Group by the FC column
 * @method     CardsCopyQuery groupByRarity() Group by the rarity column
 * @method     CardsCopyQuery groupByFlavor() Group by the flavor column
 * @method     CardsCopyQuery groupByArtist() Group by the artist column
 *
 * @method     CardsCopyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CardsCopyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CardsCopyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CardsCopy findOne(PropelPDO $con = null) Return the first CardsCopy matching the query
 * @method     CardsCopy findOneOrCreate(PropelPDO $con = null) Return the first CardsCopy matching the query, or a new CardsCopy object populated from the query conditions when no match is found
 *
 * @method     CardsCopy findOneById(string $id) Return the first CardsCopy filtered by the id column
 * @method     CardsCopy findOneBySetid(string $setid) Return the first CardsCopy filtered by the setid column
 * @method     CardsCopy findOneByNameen(string $nameEN) Return the first CardsCopy filtered by the nameEN column
 * @method     CardsCopy findOneByNameit(string $nameIT) Return the first CardsCopy filtered by the nameIT column
 * @method     CardsCopy findOneByColor(string $color) Return the first CardsCopy filtered by the color column
 * @method     CardsCopy findOneByTypeit(string $typeIT) Return the first CardsCopy filtered by the typeIT column
 * @method     CardsCopy findOneByCost(string $cost) Return the first CardsCopy filtered by the cost column
 * @method     CardsCopy findOneByTexten(string $textEN) Return the first CardsCopy filtered by the textEN column
 * @method     CardsCopy findOneByTextit(string $textIT) Return the first CardsCopy filtered by the textIT column
 * @method     CardsCopy findOneByFc(string $FC) Return the first CardsCopy filtered by the FC column
 * @method     CardsCopy findOneByRarity(string $rarity) Return the first CardsCopy filtered by the rarity column
 * @method     CardsCopy findOneByFlavor(string $flavor) Return the first CardsCopy filtered by the flavor column
 * @method     CardsCopy findOneByArtist(string $artist) Return the first CardsCopy filtered by the artist column
 *
 * @method     array findById(string $id) Return CardsCopy objects filtered by the id column
 * @method     array findBySetid(string $setid) Return CardsCopy objects filtered by the setid column
 * @method     array findByNameen(string $nameEN) Return CardsCopy objects filtered by the nameEN column
 * @method     array findByNameit(string $nameIT) Return CardsCopy objects filtered by the nameIT column
 * @method     array findByColor(string $color) Return CardsCopy objects filtered by the color column
 * @method     array findByTypeit(string $typeIT) Return CardsCopy objects filtered by the typeIT column
 * @method     array findByCost(string $cost) Return CardsCopy objects filtered by the cost column
 * @method     array findByTexten(string $textEN) Return CardsCopy objects filtered by the textEN column
 * @method     array findByTextit(string $textIT) Return CardsCopy objects filtered by the textIT column
 * @method     array findByFc(string $FC) Return CardsCopy objects filtered by the FC column
 * @method     array findByRarity(string $rarity) Return CardsCopy objects filtered by the rarity column
 * @method     array findByFlavor(string $flavor) Return CardsCopy objects filtered by the flavor column
 * @method     array findByArtist(string $artist) Return CardsCopy objects filtered by the artist column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseCardsCopyQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCardsCopyQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'CardsCopy', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CardsCopyQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CardsCopyQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CardsCopyQuery) {
			return $criteria;
		}
		$query = new CardsCopyQuery();
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
	 * @return    CardsCopy|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CardsCopyPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CardsCopyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CardsCopyPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CardsCopyPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     string $id The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the setid column
	 * 
	 * @param     string $setid The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::SETID, $setid, $comparison);
	}

	/**
	 * Filter the query on the nameEN column
	 * 
	 * @param     string $nameen The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::NAMEEN, $nameen, $comparison);
	}

	/**
	 * Filter the query on the nameIT column
	 * 
	 * @param     string $nameit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::NAMEIT, $nameit, $comparison);
	}

	/**
	 * Filter the query on the color column
	 * 
	 * @param     string $color The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::COLOR, $color, $comparison);
	}

	/**
	 * Filter the query on the typeIT column
	 * 
	 * @param     string $typeit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::TYPEIT, $typeit, $comparison);
	}

	/**
	 * Filter the query on the cost column
	 * 
	 * @param     string $cost The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::COST, $cost, $comparison);
	}

	/**
	 * Filter the query on the textEN column
	 * 
	 * @param     string $texten The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::TEXTEN, $texten, $comparison);
	}

	/**
	 * Filter the query on the textIT column
	 * 
	 * @param     string $textit The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::TEXTIT, $textit, $comparison);
	}

	/**
	 * Filter the query on the FC column
	 * 
	 * @param     string $fc The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::FC, $fc, $comparison);
	}

	/**
	 * Filter the query on the rarity column
	 * 
	 * @param     string $rarity The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::RARITY, $rarity, $comparison);
	}

	/**
	 * Filter the query on the flavor column
	 * 
	 * @param     string $flavor The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::FLAVOR, $flavor, $comparison);
	}

	/**
	 * Filter the query on the artist column
	 * 
	 * @param     string $artist The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CardsCopyPeer::ARTIST, $artist, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     CardsCopy $cardsCopy Object to remove from the list of results
	 *
	 * @return    CardsCopyQuery The current query, for fluid interface
	 */
	public function prune($cardsCopy = null)
	{
		if ($cardsCopy) {
			$this->addUsingAlias(CardsCopyPeer::ID, $cardsCopy->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCardsCopyQuery
