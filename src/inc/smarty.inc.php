<?php
require_once 'inc/smarty/libs/Smarty.class.php';

global
	$root;

	
$smarty = new Smarty;
$smarty->template_dir = $root . '/tpl/'; 
$smarty->compile_dir = $root. '/tmp/tpl_c/';
$smarty->config_dir = $root . '/tpl/configs/'; 
$smarty->cache_dir = $root . '/tmp/cache/'; 
?>