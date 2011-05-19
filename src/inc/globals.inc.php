<?php
require_once('mobile_device_detect.php');
global
        $defaultci,
	$render,
	$crlf,
	$server_cas,
	$service_url,
	$root,
	$currentUser;
	if($_SERVER["DOCUMENT_ROOT"]){ 
		$crlf="<br/>";
		$root = $_SERVER["DOCUMENT_ROOT"];// . $_SERVER["REQUEST_URI"];
                if(mobile_device_detect(true,true,true,false,false,false,false,false,false)){
                    $render = "mobile"; 
                }else{
                    $render = "web"; 
                }
	}else{
		$crlf = "\n";
		$root=$_ENV["PWD"];
		if(!$root) $root = getenv("PWD");
		$render="sh";
	}
	
	$HTTP_HOST_CI_AR = explode('.',$HTTP_SERVER_VARS['HTTP_HOST']);
	$HTTP_HOST_CI = $HTTP_HOST_CI_AR[0]; 
	
	switch ($HTTP_HOST_CI){
                case "www":
                       $HTTP_HOST_CI=$HTTP_HOST_CI_AR[1];
		default:
			$defaultci=$HTTP_HOST_CI; 
		break;
	}
	
?>