<?php



/**
 * This class defines the structure of the 'ability' table.
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
class AbilityTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mtg.map.AbilityTableMap';

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
		$this->setName('ability');
		$this->setPhpName('Ability');
		$this->setClassname('Ability');
		$this->setPackage('mtg');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('TEXTIT', 'Textit', 'LONGVARCHAR', true, null, null);
		$this->addColumn('TEXTEN', 'Texten', 'LONGVARCHAR', true, null, null);
		$this->addColumn('REGEX', 'Regex', 'LONGVARCHAR', true, null, null);
		$this->addColumn('DESCRIPTIONIT', 'Descriptionit', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTIONEN', 'Descriptionen', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AbilityTableMap
