<?php
    require_once 'apps/mtg/inc/mtg.inc.php'	;
    Class MTG extends AppDefault{
	public function __construct() {
	    $this->directClassName=array('MTG');
	    //parent::directClassName=array('MTG');
	    parent::__construct(true, true);	
	}
    }
?>