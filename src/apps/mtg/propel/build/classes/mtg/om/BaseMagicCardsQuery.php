<?php


/**
 * Base class that represents a query for the 'magic_cards' table.
 *
 * 
 *
 * @method     MagicCardsQuery orderByNomeCarta($order = Criteria::ASC) Order by the Nome_Carta column
 * @method     MagicCardsQuery orderByColore($order = Criteria::ASC) Order by the Colore column
 * @method     MagicCardsQuery orderByTipo($order = Criteria::ASC) Order by the Tipo column
 * @method     MagicCardsQuery orderByCosto($order = Criteria::ASC) Order by the Costo column
 * @method     MagicCardsQuery orderByFC($order = Criteria::ASC) Order by the F_C column
 * @method     MagicCardsQuery orderByTesto($order = Criteria::ASC) Order by the Testo column
 * @method     MagicCardsQuery orderBySet($order = Criteria::ASC) Order by the Set column
 * @method     MagicCardsQuery orderByRarita($order = Criteria::ASC) Order by the Rarita column
 * @method     MagicCardsQuery orderByCodCarta($order = Criteria::ASC) Order by the Cod_Carta column
 * @method     MagicCardsQuery orderByEnglish($order = Criteria::ASC) Order by the English column
 *
 * @method     MagicCardsQuery groupByNomeCarta() Group by the Nome_Carta column
 * @method     MagicCardsQuery groupByColore() Group by the Colore column
 * @method     MagicCardsQuery groupByTipo() Group by the Tipo column
 * @method     MagicCardsQuery groupByCosto() Group by the Costo column
 * @method     MagicCardsQuery groupByFC() Group by the F_C column
 * @method     MagicCardsQuery groupByTesto() Group by the Testo column
 * @method     MagicCardsQuery groupBySet() Group by the Set column
 * @method     MagicCardsQuery groupByRarita() Group by the Rarita column
 * @method     MagicCardsQuery groupByCodCarta() Group by the Cod_Carta column
 * @method     MagicCardsQuery groupByEnglish() Group by the English column
 *
 * @method     MagicCardsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MagicCardsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MagicCardsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MagicCards findOne(PropelPDO $con = null) Return the first MagicCards matching the query
 * @method     MagicCards findOneOrCreate(PropelPDO $con = null) Return the first MagicCards matching the query, or a new MagicCards object populated from the query conditions when no match is found
 *
 * @method     MagicCards findOneByNomeCarta(string $Nome_Carta) Return the first MagicCards filtered by the Nome_Carta column
 * @method     MagicCards findOneByColore(string $Colore) Return the first MagicCards filtered by the Colore column
 * @method     MagicCards findOneByTipo(string $Tipo) Return the first MagicCards filtered by the Tipo column
 * @method     MagicCards findOneByCosto(string $Costo) Return the first MagicCards filtered by the Costo column
 * @method     MagicCards findOneByFC(string $F_C) Return the first MagicCards filtered by the F_C column
 * @method     MagicCards findOneByTesto(string $Testo) Return the first MagicCards filtered by the Testo column
 * @method     MagicCards findOneBySet(string $Set) Return the first MagicCards filtered by the Set column
 * @method     MagicCards findOneByRarita(string $Rarita) Return the first MagicCards filtered by the Rarita column
 * @method     MagicCards findOneByCodCarta(string $Cod_Carta) Return the first MagicCards filtered by the Cod_Carta column
 * @method     MagicCards findOneByEnglish(string $English) Return the first MagicCards filtered by the English column
 *
 * @method     array findByNomeCarta(string $Nome_Carta) Return MagicCards objects filtered by the Nome_Carta column
 * @method     array findByColore(string $Colore) Return MagicCards objects filtered by the Colore column
 * @method     array findByTipo(string $Tipo) Return MagicCards objects filtered by the Tipo column
 * @method     array findByCosto(string $Costo) Return MagicCards objects filtered by the Costo column
 * @method     array findByFC(string $F_C) Return MagicCards objects filtered by the F_C column
 * @method     array findByTesto(string $Testo) Return MagicCards objects filtered by the Testo column
 * @method     array findBySet(string $Set) Return MagicCards objects filtered by the Set column
 * @method     array findByRarita(string $Rarita) Return MagicCards objects filtered by the Rarita column
 * @method     array findByCodCarta(string $Cod_Carta) Return MagicCards objects filtered by the Cod_Carta column
 * @method     array findByEnglish(string $English) Return MagicCards objects filtered by the English column
 *
 * @package    propel.generator.mtg.om
 */
abstract class BaseMagicCardsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMagicCardsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'mtg', $modelName = 'MagicCards', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MagicCardsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MagicCardsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MagicCardsQuery) {
			return $criteria;
		}
		$query = new MagicCardsQuery();
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
	 * @return    MagicCards|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MagicCardsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MagicCardsPeer::COD_CARTA, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MagicCardsPeer::COD_CARTA, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the Nome_Carta column
	 * 
	 * @param     string $nomeCarta The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByNomeCarta($nomeCarta = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nomeCarta)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nomeCarta)) {
				$nomeCarta = str_replace('*', '%', $nomeCarta);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::NOME_CARTA, $nomeCarta, $comparison);
	}

	/**
	 * Filter the query on the Colore column
	 * 
	 * @param     string $colore The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByColore($colore = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($colore)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $colore)) {
				$colore = str_replace('*', '%', $colore);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::COLORE, $colore, $comparison);
	}

	/**
	 * Filter the query on the Tipo column
	 * 
	 * @param     string $tipo The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByTipo($tipo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($tipo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $tipo)) {
				$tipo = str_replace('*', '%', $tipo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::TIPO, $tipo, $comparison);
	}

	/**
	 * Filter the query on the Costo column
	 * 
	 * @param     string $costo The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByCosto($costo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($costo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $costo)) {
				$costo = str_replace('*', '%', $costo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::COSTO, $costo, $comparison);
	}

	/**
	 * Filter the query on the F_C column
	 * 
	 * @param     string $fC The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByFC($fC = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fC)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fC)) {
				$fC = str_replace('*', '%', $fC);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::F_C, $fC, $comparison);
	}

	/**
	 * Filter the query on the Testo column
	 * 
	 * @param     string $testo The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByTesto($testo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($testo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $testo)) {
				$testo = str_replace('*', '%', $testo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::TESTO, $testo, $comparison);
	}

	/**
	 * Filter the query on the Set column
	 * 
	 * @param     string $set The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterBySet($set = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($set)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $set)) {
				$set = str_replace('*', '%', $set);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::SET, $set, $comparison);
	}

	/**
	 * Filter the query on the Rarita column
	 * 
	 * @param     string $rarita The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByRarita($rarita = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($rarita)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $rarita)) {
				$rarita = str_replace('*', '%', $rarita);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::RARITA, $rarita, $comparison);
	}

	/**
	 * Filter the query on the Cod_Carta column
	 * 
	 * @param     string $codCarta The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByCodCarta($codCarta = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($codCarta)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $codCarta)) {
				$codCarta = str_replace('*', '%', $codCarta);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::COD_CARTA, $codCarta, $comparison);
	}

	/**
	 * Filter the query on the English column
	 * 
	 * @param     string $english The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function filterByEnglish($english = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($english)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $english)) {
				$english = str_replace('*', '%', $english);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MagicCardsPeer::ENGLISH, $english, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MagicCards $magicCards Object to remove from the list of results
	 *
	 * @return    MagicCardsQuery The current query, for fluid interface
	 */
	public function prune($magicCards = null)
	{
		if ($magicCards) {
			$this->addUsingAlias(MagicCardsPeer::COD_CARTA, $magicCards->getCodCarta(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseMagicCardsQuery
