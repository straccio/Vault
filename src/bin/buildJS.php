#!/usr/bin/php

<?php
	error_reporting(0);
	require_once '../inc/public.functions.inc.php';
// | grep -i -e 'text/javascript' -e '<!-- @' -e 'text/css' |sed -E "s/<script.*src=[\'\"](.*).js[\'\"].*>/\1.js/"
	$lparams=array();
	$sparams="";
	for($i=0;$i<count($argv);$i++){
		if(substr($argv[$i],0,1) == "-"){
			if(strlen(substr($argv[$i],1))>1){
				$lparams[count($lparams)]=substr($argv[$i],2,2 )."::";
			}else{
				$sparams .=substr($argv[$i],1)."::";
			}
			$i++;
		}
	}
	$params = _getopt($sparams,$lparams);
	
	if(!count($params)) showHelp();
	$tpl = 'index.tpl';
	foreach ($params as $name=>$value){
		switch($name){
			case '?': 
			case 'help':
				showHelp();
			break; 
			case "a": 
			case "app":
				$app = trim( $value);
			break;
			case 't':
			case 'tpl':
				$tpl = $value;
			break;
		}
	}
	if($app){
		$appFolder='../apps/' . $app;
		if(dir($appFolder)){
			write ('');
			write ('Costruzione JS compressi per l\'applicazione ' . ucfirst($app));
			write('situata in '.$appFolder);
			if(file_exists($appFolder . '/tpl/web2.0/'.$tpl)){
				write('Parsing file index.tpl per estrarre i file da comprimere');
				$rows = array();
				$outputTpl=$appFolder . '/tpl/web2.0/build-'.$tpl;
				exec("echo '' > " .$outputTpl);
				exec('cat '.$appFolder . '/tpl/web2.0/'.$tpl.'| grep -i -e \'text/javascript\' -e \'<!-- @\' -e \'text/css\' |sed -E "s/[[:space:][:blank:][:cntrl:]]*<script .*src=[\\\'\"](.*).js[\'\"].*>/\1.js/" |sed -E "s/[[:space:][:blank:][:cntrl:]]*<link .*href=[\\\'\"](.*).css[\'\"].*>/\1.css/"',$rows);
				//print_r($rows);
				$outputDir = $appFolder . "/js/build/";
				$flgDentro = false;
				foreach($rows as $row){
					if(preg_match('/<!-- @.*\.js -->/',$row)){
						$outputFileJS=$outputDir."/".str_replace('-->', '', str_replace('<!-- @', '', $row));
						write("\nGenerazione " . $outputFileJS);
						exec("echo '' > " . $outputFileJS);
						$flgDentro=true;
					}else{
						if(preg_match('/<!-- @end -->/',$row)){
							$outputFileJS='';
							$flgDentro=false;
						}
						if($flgDentro){
							write("\tAggiungo " . $row);
							exec ('java -jar ~/sbin/yuicompressor-2.4.2.jar --type js --charset utf-8 "../' . $row . '" >> ' .$outputFileJS);
						}
					}
				}
				unset($rows);
				exec('cat '.$appFolder . '/tpl/web2.0/'.$tpl,$rows);
				write("\nGenerazione template" . $outputTpl);
				foreach ($rows as $row){
					if(preg_match('/<!-- @.*\.js -->/',$row)){
						$flgDentro=true;
						$outputFileJS=$outputDir."/".str_replace('-->', '', str_replace('<!-- @', '', $row));
						file_put_contents($outputTpl, '<script type="text/javascript" src="'.str_replace("../", '',  $outputFileJS).'"></script>'."\n",FILE_APPEND);
					}else{
						if(preg_match('/<!-- @end -->/',$row)){
							$flgDentro=false;
						}
					}
					if(!$flgDentro && !preg_match('/<!-- @end -->/',$row)){
						file_put_contents($outputTpl, $row."\n",FILE_APPEND);
					}
				}
			}else{
				write('Impossibile trovare file index.tpl per estrarre i file da comprimere');
				write("Specificare il nome del file tpl da parsare");
			}
			
		}else{
			write ('Applicazione ' . ucfirst($app) . ' non trovata in ' . $appFolder );
		}
	}

	
	
	function showHelp(){
		write('-?, -help : Questo Help');
		write('-a, -app  : Nome dell\'applicazione');
		write('-t, -tple : Nome del file template da parsare');
	}
	
	function write($s){
		echo $s."\n";
	}
?>