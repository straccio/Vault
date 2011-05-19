<?php



/**
 * This class defines the structure of the 'magic_cards' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.mtg.map
 */
class MagicCardsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mtg.map.MagicCardsTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('magic_cards');
		$this->setPhpName('MagicCards');
		$this->setClassname('MagicCards');
		$this->setPackage('mtg');
		$this->setUseIdGenerator(false);
		// columns
		$this->addColumn('NOME_CARTA', 'NomeCarta', 'VARCHAR', true, 255, null);
		$this->addColumn('COLORE', 'Colore', 'VARCHAR', true, 255, null);
		$this->addColumn('TIPO', 'Tipo', 'VARCHAR', true, 255, null);
		$this->addColumn('COSTO', 'Costo', 'VARCHAR', true, 255, null);
		$this->addColumn('F_C', 'FC', 'VARCHAR', true, 255, null);
		$this->addColumn('TESTO', 'Testo', 'LONGVARCHAR', true, null, null);
		$this->addColumn('SET', 'Set', 'VARCHAR', true, 255, null);
		$this->addColumn('RARITA', 'Rarita', 'VARCHAR', true, 255, null);
		$this->addPrimaryKey('COD_CARTA', 'CodCarta', 'VARCHAR', true, 255, null);
		$this->addColumn('ENGLISH', 'English', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // MagicCardsTableMap
