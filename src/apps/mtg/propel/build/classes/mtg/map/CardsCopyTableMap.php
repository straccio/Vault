<?php



/**
 * This class defines the structure of the 'cards_copy' table.
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
class CardsCopyTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mtg.map.CardsCopyTableMap';

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
		$this->setName('cards_copy');
		$this->setPhpName('CardsCopy');
		$this->setClassname('CardsCopy');
		$this->setPackage('mtg');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 255, null);
		$this->addColumn('SETID', 'Setid', 'VARCHAR', true, 255, null);
		$this->addColumn('NAMEEN', 'Nameen', 'VARCHAR', true, 255, null);
		$this->addColumn('NAMEIT', 'Nameit', 'VARCHAR', true, 255, null);
		$this->addColumn('COLOR', 'Color', 'VARCHAR', true, 255, null);
		$this->addColumn('TYPEIT', 'Typeit', 'VARCHAR', true, 255, null);
		$this->addColumn('COST', 'Cost', 'VARCHAR', true, 255, null);
		$this->addColumn('TEXTEN', 'Texten', 'LONGVARCHAR', true, null, null);
		$this->addColumn('TEXTIT', 'Textit', 'LONGVARCHAR', true, null, null);
		$this->addColumn('FC', 'Fc', 'VARCHAR', true, 255, null);
		$this->addColumn('RARITY', 'Rarity', 'VARCHAR', true, 255, null);
		$this->addColumn('FLAVOR', 'Flavor', 'LONGVARCHAR', true, null, null);
		$this->addColumn('ARTIST', 'Artist', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // CardsCopyTableMap
