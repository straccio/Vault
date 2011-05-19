<?php 
require_once 'propel/Propel.php';

$include_path=get_include_path();
$include_path.=':../propel/build/classes/:.';
set_include_path($include_path);

Propel::init('../propel/build/conf/mtg-conf.php');
 

$xsl = new DomDocument;
$xsl->substituteEntities = true;
$xsl->load('parse.xslt');
  
//$dirlist = scandir(".");

$numbers_ar = array('zero','one','two','three','four','five','six','seven','eight','nine','ten');
$ab_ar=array(
    'flanking','intimidate','flying','vigilance','reach','trample','flash','a\(flash\)back','defender','fear','kicker','multia(kicker)','haste','metalcraft',
    'first strike','morph','evoke','convoke','amplify','plainscycling','infect','echo','hellbent','suspend','banding','regenerate','deathtouch','rampage',
    'persist','conspire','exalted','haunt','shroud','buyback','unearth','fading','split second','graft','bushido','modular-sunburst','cycling','cumulative upkeep',
    'cascade','madness','annihilator','storm','shadow','prowl','vanishing','changeling','entwine','threshold','Landfall','swampwalk','mountainwalk','plainswalk',
    'islandwalk','forestwalk','legendary landwalk','wither','infect'
);
$col_ar=array('white','black','red','green','blue','basic','multicolored');
$mana_ar=array('G','B','R','W','U','X','Y','Z');
$land_ar=array('forests?','swamps?','islands?','plains?','mountains?');
$act_ar=array('attacking','blocking','attacckers','blockers');
$cond_ar=array('kicked','face-down','untapped','tapped','activated','unblocked','enchanted','\$\{fc\}');
$pha_ar=array('beginning phase','combat phase','first main phase','second main phase','main phase','end phase');
$step_ar=array('draw step','end step','tap step','untap step','upkeep step','upkeep','beginning of combat step','declare attackers','declare blockers step',
	'combat damage step','end of combat step','end of combat','end of turn step','end of turn','clean up step'
);
$time_ar=array('end of turn');
//$spells_ar=array('permanents?','lands?','spells?','instants?','sorcerys?','walls?','creatures?','artifacts?','enchantments?','equipments?','abilitys?');
//'battlefield'
$obj_ar=array('opponents?','librarys?','cards?','hands?','players?','\$\{me\}');

$loc_ar=array('library','graveyard','battlefield','hands?','out of game');

$p = CardsQuery::create();	
$type_ar_tmp =$p->setFormatter(ModelCriteria::FORMAT_ARRAY)->groupBy('Typeen')->select(array('Typeen'))->find();

$spells_ar=array('permanents?','spells?','sorcerys?','walls?','equipments?','abilitys?','enchantments?','lands?');;

$type_ar=array();
$subtype_ar=array();
foreach($type_ar_tmp as $t){
    $t=explode(' - ', strtolower($t));
    if(count($t)>1){
	$t[0]=explode(' ',$t[0]);
	if(count($t[0])>1){
	    $t[0][0]=explode( ' ',$t[0][0]);
	    foreach($t[0][0] as $s){
		$subtype_ar[$s]= $s;
	    }
	    $spells_ar[$t[0][1]]=$t[0][1].'s?';
	}else{
	    $spells_ar[$t[0][0]]=$t[0][0].'s?';
	}
	$t[1]= explode(' ',$t[1]);
	foreach($t[1] as $s){
	    $type_ar[$s]=$s;
	}
	
    }else{
	$t[0]=explode(' ',$t[0]);

	if(count($t[0])>1){
	    $t[0][0]=explode($t[0][0], ' ');
	    foreach($t[0][0] as $s){
		$subtype_ar[$s]= $s;
	    }
	    $spells_ar[$t[0][1]]=$t[0][1].'s?';
	}else{
	    $spells_ar[$t[0][0]]=$t[0][0].'s?';
	}
    }

}
unset($type_ar_tmp);
$targ_ar=array_merge(
	$land_ar,
	array_merge(
	    $spells_ar,
	    array_merge(
		$col_ar,
		$obj_ar
	    )
	)
);

$typa_ar=array_merge($type_ar,$subtype_ar);
$filter = "";
if(count($argv)<=1){ 
	$filter = "*";
}else{
	for($i=1;$i<count($argv);$i++){
		$filter .= $argv[$i].' ';
	}
	$filter = trim($filter);
}

exec('find -L . -type f -name "' . $filter . '.html"',$dirlist);
echo "\ntrovate " .count($dirlist) . " carte da elaborare\n";
foreach ($dirlist as $d){
	$xp = new XsltProcessor();
	$xp->importStylesheet($xsl);
	$d = substr($d, 2);
	if(preg_match('/\.html$/', $d)){
		$d='./'.$d;
		//echo 'html: '.$d.';';
		shell_exec('./parseImages.sh '. escapeshellarg(str_replace('"','\"',$d)));
		
		//$fname=iconv("UTF-8", "ISO-8859-1//TRANSLIT//IGNORE", str_replace(":","/",preg_replace('/\.html$/', '',preg_replace('/\^.\/html\/','',$d))));
                $fname=str_replace(":","/",preg_replace('/\.html$/', '',preg_replace('/^\.\/html\//','',$d)));
		//$fname = str_replace(":","/",preg_replace('/\.html$/', '',$d));
		$xml_doc = new DomDocument;
		$xml_doc->strictErrorChecking=false;
		$xml_doc->loadHTMLFile($d.".ok");
		//echo "html loaded;";
		if ($html = $xp->transformToXml($xml_doc)) {
			//echo "html transformed;";
			$aa=json_decode($html);
			//var_dump($aa);
			//echo "json decoded;";
			if(is_array($aa)){
				foreach($aa as $a){
					if($fname==$a->CardName){
						updateCard($a, $fname);
					}
				}
			}else{
				//echo "updating card;";
				updateCard($aa, $fname);
			}
			//echo "updated card;";
			unset($aa);
			unset($html);
		}else{
			echo $d.": ko in xslt\n";
		}
		unset($xml_doc);
		unset($fname);
		shell_exec('rm -f "'.$d.'.ok"');
	}
	unset($xp);
}

function updateCard($jCard,$cname){
	if($jCard->Url<>""){
		shell_exec('wget "'.$jCard->Url.'" -O '. escapeshellarg($cname.'.html'));
		echo $cname.": ko download html\n";
	}else{
		$q = CardsQuery::create();
		//echo "db search;";
		$cards= $q->findByNameen(str_replace('"', '', $cname ));
		//echo "search founded " . count($cards) .";";
		//$cards = $q->where(CardsPeer::NAMEEN, '=', $cname)->find();
		if(count($cards)==0){
			$con = Propel::getConnection(CardsPeer::DATABASE_NAME);
			$stmt = $con->prepare("select * from Cards where nameEN sounds like :name");
			$stmt->execute(array(':name' => str_replace('"', '', $cname )));
			
			$formatter = new PropelObjectFormatter();
			$formatter->setClass('Cards');
			$cards = $formatter->format($stmt);
			
			if(count($cards)==0){
				echo $cname.": ko no card found\n";
			}
			unset($con);
			unset($stmt);
			unset ($formatter);
		}
		foreach($cards as $card){
			
			if($card){
				$card->setTypeen(parseOutputText($jCard->Types));
				$card->setTexten(parseOutputText($jCard->CardText));
				$card->setCost(parseOutputText($jCard->ManaCost));
				$card->setConvertedCost(parseOutputText($jCard->ConvertedManaCost));
				$card->setScript(parseTextForScript($jCard));
				if($jCard->FlavorText){
					$card->setFlavor(parseOutputText($jCard->FlavorText));
				}
				if($jCard->Artist){
					$card->setArtist(parseOutputText($jCard->Artist));
				}
				$card->save();
				insertAbility($card->getScript());
				echo $cname.": ok set ".$card->getSetid()."\n";
			}else{
				echo $cname.": ko no card found\n";
			}
		}
		unset($cards);
		unset($q);
	}
	//flush();
	//print_r($card->toArray());
}

function parseScript($text){
    $ret= parseFunctions(
	parseEvents(
		parseDuration(
			trim($text)
		)
	) 
    );
    return $ret;
}

function insertAbility($text){
	$abs = preg_split('/\],?/', $text);
	foreach($abs as $ab){
		//$s = AbscriptQuery::create()->findPk($ab."]");
		if($ab){
			$s = new Abscript();
			$t=parseAbility(substr(trim($ab),2));
			if($t!=''){
				$s->setAbility(parseScript(trim($t)));
				$s->setSample(parseScript(trim($ab."]")));
				try {
					$s->save();	
				} catch (Exception $e) {
					unset($e);
				}
				unset($s);
				preg_match('/a\([^\)]*\)/',$ab,$sabs);
				foreach ($sabs as $sab){
					//$s = AbscriptQuery::create()->findPk($sab);
					if($sab ){
						$s = new Abscript();
						
						$s->setAbility(parseScript(trim($sab)));
						$s->setSample(parseScript(trim($sab)));
						try {
							$s->save();	
						} catch (Exception $e) {
							unset($e);
						}
						unset($s);		
					}
				}
			}
		}
	}
	unset($abs);
	unset($ab);
	unset($sabs);
	unset($sab);
}

function parseAbility($text){
	$ret = $text;
	/*
	$ret = preg_replace_callback(
		'/@\([^\)]*\)/', 
		'escapeFC',
		$ret);
	*/
	
	$ret = preg_replace('/([@mcavpslts]\([^\)]*\))/',' $1 ',$ret);
	$ret=str_replace('  ', ' ', $ret);
	
	$ret = preg_replace('/@\([^\)]*\)/','${fc}',$ret);
	//$ret = preg_replace('/m\([^\)]*\)([^:]?):/','${cost}$1:', $ret);
	$ret = preg_replace('/^[^:]*:/','${cost}:', $ret);
	$ret = preg_replace('/m\([^\)]*\)/',' ${mana} ', $ret);
	$ret = preg_replace('/c\([^\)]*\)/',' ${condition} ', $ret);
	$ret = preg_replace('/a\([^\)]*\)/',' ${ability} ', $ret);
	$ret = preg_replace('/v\([^\)]*\)/',' ${val} ', $ret);
	$ret = preg_replace('/p\([^\)]*\)/',' ${phase} ', $ret);
	$ret = preg_replace('/s\([^\)]*\)/',' ${step} ', $ret);
	$ret = preg_replace('/l\([^\)]*\)/',' ${loc} ', $ret);
	$ret = preg_replace('/t\([^\)]*\)/',' ${target} ', $ret);	
	$ret = preg_replace('/t\(v\([^\)\)]*\)/',' ${target} ', $ret);
	$ret = preg_replace('/\s\([^\)]*\)/','',$ret); 
	
	$ret=str_replace('  ', ' ', $ret);
	if(trim(preg_replace('/\$\{ability\}[\.,\s]?/','',$ret))!=''){
		return $ret;
	}else{
		return '';
	}
}

function escapeFC($matches){	
	print_r($matches);
	return '${fc}';
}

function parseOutputText($text){
	$ret = preg_replace('/[^[:print:]]/', '', $text);
	$ret = str_replace(chr(226) , '-', $ret);
	$ret = str_replace(chr(195), 'AE', $ret);
	//$ret = iconv("UTF-8", "ISO-8859-1//IGNORE",$ret); 
	return $ret; 
}

function parseTextForScript($jCard){
    global
	$numbers_ar,
	$ab_ar,
	$col_ar,
	$mana_ar,
	$land_ar,
	$act_ar,
	$cond_ar,
	$obj_ar,	
	$spells_ar,
	$type_ar,
	$subtype_ar,
	$targ_ar,
	$pha_ar,
	$time_ar,
	$step_ar,
	$loc_ar;
    
    
    $ret = parseOutputText($jCard->CardScript); 




    $ret=preg_replace('/([dD]raws?) a card/','$1 one card',$ret);

    $ret=preg_replace('/([dD]iscards?) a card/','$1 one card',$ret);

    $ret = str_replace('{tap}','{TAP}',$ret);

    $ret = preg_replace('/([+-]?[0-9XYZ]*\/[+-]?[0-9XYZ])/', '@($1)', $ret);
    $ret = preg_replace('/(\{[0-9]?['. implode('',$mana_ar) .']?\})/', 'm($1)', $ret);
    $ret = preg_replace('/\)m\(/', '', $ret);

    $ret = preg_replace('/\s([+-]?[0-9XYZ])[\s\.,;]/', ' v($1) ', $ret);
    $ret = preg_replace('/(counters?|tokens?)/i', ' v($1) ', $ret);




    $i=0;
    foreach($numbers_ar as $n){
	$ret=str_replace(' '.$n.' ',' v('.$i.') ',$ret);
	$i++;
    }

    $ret = preg_replace('/^([+-]?[0-9XYZ]):?/', 'v($1):', $ret);
    $ret = preg_replace('/'.parseOutputText($jCard->CardName).'s?/i', '${me}',$ret);
    



    $ability=  implode($ab_ar, '|');
    $colors=implode($col_ar, '|');
    $lands=implode($land_ar, '|');
    $spells=implode($spells_ar, '|');
    
    unset($targ_ar['s']);
    unset($targ_ar[""]);
    
    $targets=implode($targ_ar, '|');
    $type=implode($type_ar, '|');
    $actions=implode($act_ar, '|');
    $condition=implode($cond_ar, '|');
    
    //DA GUARDARE $ret = preg_replace('/[Tt]arget (([v@])\([^\)]*\)/', 't($1$2)', $ret);
    
    $ret = preg_replace('/[Tt]arget (non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', 't($1$2$3$4)', $ret);
    
    $ret = preg_replace('/(to) (that|a)?\s?(non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', '$1$2 t($3$4)', $ret);
    
    $ret = preg_replace('/(all) (non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', '$1$2 t($3$4)', $ret);
    
    $ret = preg_replace('/t\(([^\)]*)\),\s?(and)?\/?(or)?\s?(non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', 't($1 $2 $4$5$6)', $ret);
        
    $ret = preg_replace('/(non-?)?('.$targets.'|'.$actions.'|'.$type .')?\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.') (has|gets?)/i', 't($1$2$3$4) $5', $ret);
        
    while (preg_match('/t\(([^\)]*)\),?\s?(and)?\/?(or)?\s?(non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', $ret)){    

	
	$ret = preg_replace('/t\(([^\)]*)\),?\s?(and)?\/?(or)?\s?(non-?)?('.$targets.'|'.$actions.'|'.$type .')\s?('. $condition.'|'.$actions.'|'.$colors.'|'.$type .')?\s?('.$targets .'|'.$spells.'|'.$lands.'|'.$type.')?/i', 't($1 $2 $4$5$6)', $ret);
	
    }
    
    $ret = preg_replace('/\],\s$/', ']', $ret);
    
    $ret = preg_replace('/(non)?('.$colors .')\s?('.$type.')? ('.$targets.')/i','v($1$2$3$4)',$ret);
    
    foreach($ab_ar as $ab){
	$ret = str_ireplace($ab, 'a('.
	    ucfirst(
		str_replace(')','',str_replace(' ','',str_replace('a(','', $ab)))).')'
	    , $ret);
    }
    unset($ab);
    foreach($pha_ar as $p){
	$ret=str_ireplace(' '.$p, ' p('.  strtolower(str_replace(' ', '', $p)).')' , $ret);
    }
    unset($p);
    foreach($step_ar as $s){
	$ret=str_ireplace(' '.$s, ' s('.  strtolower(str_replace(' ', '', $s)).')' , $ret);
    }
    unset($s);
    foreach($loc_ar as $l){
	$ret=str_ireplace(' '.$l, ' l('.  strtolower(str_replace(' ', '', $l)).')' , $ret);
    }
    unset($l);
    
    foreach($cond_ar as $c){
	$ret=str_ireplace(' '.$c, ' c('.  strtolower(str_replace(' ', '', $c)).')' , $ret);
    }
    unset($c);

    $ret = preg_replace('/[Pp]rotection from the ([^\s^,^\.^;^:\]]*)/','a($1Protection)',$ret);
    $ret = preg_replace('/[Pp]rotection from ([^\s^,^\.^;^:\]]*)/','a($1Protection)',$ret);
    $ret = preg_replace('/(a\([^\)]*[Pp]rotection\)) and from ([^\s^,^\.^;^:\]]*)/','$1 a($2Protection)',$ret);
    $ret = preg_replace('/[Aa]ffinity for ([^\s^,^\.^;^:\]]*)/','a($1Affinity)',$ret);
    $ret = preg_replace('/(a\([^\)]*[Aa]ffinity\)) and from ([^\s^,^\.^;^:\]]*)/','$1 a($2Affinity)',$ret);
    
    unset($ability);
    unset($colors);
    unset($lands);
    unset($spells);
    unset($targets);
    unset($type);
    unset($actions);
    unset($condition);
    
    
    return $ret;
}

function parseFunctions($text){
    
    $ret=&$text;
/*    
    if(preg_match('/deals? /i', $ret)){
	echo $ret."\n";
    }
*/
    $ret=preg_replace('/draw ([\$v][\(\{][^\}^\)]*[\}\)]) cards?/i','func_drawCards:$1',$ret);
    $ret=preg_replace('/([\$t][\(\{][^\}^\)]*[\}\)])?\s?discards? ([\$v][\(\{][^\}^\)]*[\}\)]) cards?\s?(at)?\s?(random)?/i','func_discardCards:$2 :$1 :$4',$ret);
    $ret=preg_replace('/deals? ([\$v][\(\{][^\}^\)]*[\}\)]) (damage)?\s?to ([\$t][\(\{][^\}^\)]*[\}\)])/i','func_dealDamagesTo:$1 :$3',$ret);
    $ret=preg_replace('/deals? ([\$v][\(\{][^\}^\)]*[\}\)]) (combat damage)?\s?to ([\$t][\(\{][^\}^\)]*[\}\)])/i','func_dealCombatDamagesTo:$1 :$3',$ret);
/*    
    if(preg_match('/deals? /i', $ret)||preg_match('/func_deal/i', $ret)){
	echo $ret."\n";
    }
*/
    return $ret;
}

function parseEvents($text){
    global
	$act_ar;
    $ret=&$text;
    
    $ret=preg_replace('/at the (beginning|end) of (your|opponents?|players?) ([\$][\(\{][^\}^\)]*[\}\)])/i','event_$1:\${target} :$3',$ret);
    $ret=preg_replace('/at the (beginning|end) of (your|opponents?|players?) ([\sp][\(\{][^\}^\)]*[\}\)])/i','event_$1:t($2) :$3',$ret);
    $ret=preg_replace('/whenever ([\$sp][\(\{][^\}^\)]*[\}\)]) ('.implode('|', $act_ar).')/i','event_whenever :$1 :$2',$ret);
    return $ret;
}

function parseDuration($text){
    $ret=&$text;
    $ret=preg_replace('/until ([\$sp][\(\{][^\}^\)]*[\}\)])/i','duration_until :$1',$ret);
    return $ret;
}

?>