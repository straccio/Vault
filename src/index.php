<?php
require_once 'inc/public.functions.inc.php';
require_once 'inc/globals.inc.php';
require_once 'inc/smarty.inc.php';

	global
		$defaultci,
		$render;
	
	$params = array();
	if ($render=="web"){
		$params = array_merge($_POST,$_GET); 
	}else{
		$lparams=array();
		$sparams="";
		for($i=0;$i<count($argv);$i++){
			if(substr($argv[$i],0,1) == "-"){
				if(strlen(substr($argv[$i],1))>1){
					$lparams[count($lparams)]=substr($argv[$i],2 )."::";
				}else{
					$sparams .=substr($argv[$i],1)."::";
				}
				$i++;
			}
		}
		$params = _getopt($sparams,$lparams);
	}
	if(!$params["app"]) $params["app"] = $defaultci;
	if ($params["app"]){
		if(strlen($params["app"])<=3){
		    $class=strtoupper($params["app"]);
		}else{
		    $class=ucwords($params["app"]);
		}
		require_once "apps/".$params["app"] . "/inc/" . $class . ".php";
                
		$objci = new $class();
                
		$objci->execute($params);
		
		if($render!=false){
                    $objci->render($render);
		}
	}
?>