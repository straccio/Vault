<?php
//require_once 'inc/apps/mtg/MTG.php';

class Direct_MTG extends MTG{
    
    /**
     * @remotable
     */
    function searchCards($query,$start,$limit,$sort,$dir,$fields){
	$ret = $this->propel->search('Cards',$query,$start,$limit,$sort,$dir,$fields);
	return array(
	    'success'=>true,
	    'data'=>$ret
	);
    }
}
?>