<?php
class cacheClass{
	private
			$cache_timeout_seconds;
			
	function __construct(){
		$this->cache_timeout_seconds=3600.0;
	}		
	public function setCacheTimeout($seconds){
		$this->cache_timeout_seconds=$seconds;
	} 
	
	function cache($id,$value=NULL,$force=false){
		if($value){
			file_put_contents("tmp/".$id,serialize($value));
			return $value;
		}else{
			if(file_exists("tmp/".$id)){
				$now=mktime();
				$ftime=filectime("tmp/".$id);
				
				if($force || ((($now - $ftime))<= $this->cache_timeout_seconds)){
					return (unserialize(file_get_contents("tmp/".$id)));
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
}
?>