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
$colors_ar=array('white','black','red','green','blue','basic','multicolored','monocolored','colorless','any colors?','all colors?');
$colors_r=implode('|',$colors_ar);
$manas_ar=array('G','B','R','W','U','X','Y','Z');
$manas_r=implode('|',$manas_ar);
$abilities_ar = array(
    'Deathtouch','Defender','Double Strike','Enchant','Equip','First Strike','Flying','Haste','Intimidate','Landwalk','Lifelink','Protection','Reach','Shroud',
    'Trample','Vigilance','Banding','Rampage','Cumulative Upkeep','Flanking','Phasing','Buyback','Shadow','Cycling','Echo','Horsemanship','Fading','Kicker','Flashback','Flash',
    'Madness','Fear','Morph','Amplify','Provoke','Storm','Affinity','Entwine','Modular','Sunburst','Bushido','Soulshift','Splice','Offering','Ninjutsu','Epic','Convoke',
    'Dredge','Transmute','Bloodthirst','Haunt','Replicate','Forecast','Graft','Recover','Ripple','Split Second','Suspend','Vanishing','Absorb','Aura Swap','Delve',
    'Fortify','Frenzy','Gravestorm','Poisonous','Transfigure','Champion','Changeling','Evoke','Hideaway','Prowl','Reinforce','Conspire','Persist','Wither','Retrace',
    'Devour','Exalted','Unearth','Cascade','Annihilator','Level Up','Rebound','Totem Armor','Infect','Battle Cry','Living Weapon','mana ability',
    'bands','channels?', 'chromas?', 'domains?', 'grandeurs?', 'hellbents?', 'imprints?', 'kinships?', 'landfalls?', 'metalcrafts?', 'radiances?', 'sweeps?', 'thresholds?' //Italics
);
$abilities_r=implode('|',$abilities_ar);
$types_ar = array(
    'Artifacts?','Creatures?','Enchantments?','Instants?','Lands?','Planeswalkers?','Sorceries?','Tribals?','Planes?','Vanguards?',
    'Schemes?','Spells?','Mana Abilities','Abilities','Sorcery','Walls?','permanents?','Ability','Equipments?'
);
$types_r=implode('|',$types_ar);
$players_ar=array('Opponents?','Players?','he or she','Owners?'.'controllers?','owners?','your control','yours?','you control','you','his or her');
$players_r=implode('|', $players_ar);
$lands_ar=array('forests?','swamps?','islands?','plains?','mountains?','basic lands?');
$lands_r=implode('|',$lands_ar);
$zones_ar = array(
    'Librarys?','Hands?','Battlefields?','Graveyards?','Stacks?','Antes?','Mana Pools?'
);
$zones_r=implode('|',$zones_ar);
$turnStructures_ar = array(
    'Beginning Phases?','Untap Steps?','Upkeep Steps?','Draw Steps?','Main Phases?','Combat Phases?','Beginning of Combat Steps?','Declare Attackers Steps?',
    'Declare Blockers Steps?','Combat Damage Steps?','End of Combat Steps?','Ending Phases?','End Steps?','End Of Turns?','Turns?','Upkeeps?'
);
$turnStructures_r=implode('|',$turnStructures_ar);

$actions_ar = array(
  'Activates?','Attachs?','Attacks?','Blocks?','Casts?','NONFARLOCounter','Destroy','Exchange','Exiles?','Play','Regenerates?','Reveals?','Sacrifices?','Search','Shuffle',
  'Tapp,','Untapp','Taps?','Untaps?','Scry','Fateseal','Clashs?','Planeswalk','Set in Motions?','Abandon','Proliferates?','Discards?','Draws?','Defends?','Flips?'
);
$actions_r=implode('|',$actions_ar);

$counters_ar=array(
    'charges?','quests?','dooms?','ages?','golds?','kis?','pages?','arrows?','bloods?','fuses?','storages?','bountys?','devotions?','screams?','omens?','pupas?',
    'rustas?','intervention?','ices?','wishs?','paralyzations?','energys?','delays?','elixirs?','depletions?','vitalitys?','winchs?','ores?','times?','fates?',
    'floods?','plagues?','shells?','spores?','pains?','sleeps?','mines?'
);
$counters_r=implode('|',$counters_ar);

$selectors_ar=array('all','each');
$selectors_r=implode('|',$selectors_ar);
/*
array_multisort($abilities_ar,SORT_DESC);
array_multisort($types_ar,SORT_DESC);
array_multisort($types_ar,SORT_DESC);
array_multisort($actions_ar,SORT_DESC);
*/

$status_ar = array('exiled','regenerated','Equipped','unblockable','Enchanted','Exchanges','Activated','Proliferated');
foreach ($actions_ar as &$action){
    array_push($status_ar,  str_replace('\?', '', $action).'ed');
}
$status_r =implode('|',$status_ar );

$active_ar = array();
foreach ($actions_ar as &$action){
    array_push($active_ar,str_replace('s?', '', $action).'ing');
}
$active_r =implode('|',$active_ar );



$subtypes_ar=array('Saprolings?','Spawns?','Graveborns?|green|bears?|Pentavites?');//array('Urzas','Legendary','Zombie','snow','Spirit','Vampire','Elf','Faerie','Eye');
$p = CardsQuery::create();
$subtypes_ar_tmp =$p->setFormatter(ModelCriteria::FORMAT_ARRAY)->groupBy('Typeen')->select(array('Typeen'))->find();
foreach($subtypes_ar_tmp as &$st){
    parseRepairSomeText($st);
    $st=str_replace(' - ',' ',$st);
    reSpace($st);
    $st = explode(' ', $st);
    foreach ($st as &$sti){
	$sti = trim($sti);
	if(strlen( $sti)>1){
	    array_push($subtypes_ar,$sti);
	}
    }
	

    /*
    while($st){
	$st=str_replace('Urza-s', 'Urzas', $st);
	if($st=='Tribal Sorcery'){
	    $a=true;
	}
	if(!preg_match('/^('.$types_r.'|'.implode('|', $subtypes_ar).')$/',$st)){
	    if(preg_match('/('.$types_r.'|'.implode('|', $subtypes_ar).')\s[-]\s(.*)/', $st,$m)){
		$st=$m[2];
	    }else{
		if(preg_match('/([^\-]*)[- ]([^\-]*)/', $st,$m)){
		    $st='';
		    array_shift($m);
		    foreach ($m as $mm){
			if(strpos($mm,'-') || strpos( $mm,' ')){
			    $st=$mm;
			    array_shift($m);
			}
		    }
		    $subtypes_ar=array_merge($subtypes_ar,$m);
		    
		}else{
		    array_push($subtypes_ar, $st);
		    $st='';
		}
	    }
	}else{
	    $st='';
	}
    }
     */   
}
unset($subtypes_ar_tmp);
$subtypes_ar=array_unique($subtypes_ar);
$subtypes_ar = explode('|', str_replace('|s?|','|' , implode('s?|',$subtypes_ar)));
$subtypes_r=implode('|',  $subtypes_ar);

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
	    $html = $xp->transformToXml($xml_doc);
	    if ($html) {
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
				//$card->setScript(parseTextForScript($jCard));
				$card->setScript(parseScript(parseOutputText($jCard->CardScript),$jCard->CardName));
				if($jCard->FlavorText){
					$card->setFlavor(parseOutputText($jCard->FlavorText));
				}
				if($jCard->Artist){
					$card->setArtist(parseOutputText($jCard->Artist));
				}
				$card->save();
				//insertAbility($card->getScript());
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

function parseScript($text,$name){
    if($name){
	$text = preg_replace('/'.parseOutputText($name).'s?/i', '$Me',$text);
    }    
    preg_match_all('/@\[[^\]]*\],?/', $text, $actions_ar);
    $text='';
    foreach($actions_ar[0] as &$action){
	
	parseRepairSomeText($action);
	
	$cost = parseCost($action);
	
	parseFC($action);
	parseNumbers($action);
	
	parseChoose($action);
	parseManas($action);
	parseCoins($action);
	parsePlayers($action);
	parseStatus($action);
	parseActive($action);
	parseZones($action);
	parseCounters($action);
	
	parseTypes($action);
	//parseTypes($action);
	parseAbilitys($action);	
	parseTurnStructures($action);
	parseAction($action);
	parseSelectors($action);
	//parseTargets($action);
	$parsers_ar=array('FC','Number','Mana','Status','Active','TurnStructure','Zone','Ability','Type','Action','Coin');
	foreach($parsers_ar as $pa){
	    $rx='/\{type:\\\''.$pa.'\\\',\s?value:\\\'([^\\\']*)\\\'\}\s?(and| )\s?{type:\\\''.$pa.'\\\',\s?value:\\\'([^\\\']*)\\\'\}/i'; 
	    while(preg_match($rx, $action)){
		$action = preg_replace($rx, '{type:\''.$pa.'\',value:\'$1,$3\'}', $action);
	    }
	}
	foreach($parsers_ar as $pa){
	    $rx='/\{type:\\\''.$pa.'\\\',\s?value:\[?([^\}^\]]*)\]?\}\s?,?\s?(or)\s?(the)?\s?{type:\\\''.$pa.'\\\',\s?value:\[?([^\}^\]]*)\]?\}/i'; 
	    while(preg_match($rx, $action)){
		$action = preg_replace($rx, '{type:\''.$pa.'\',value:[$1,$4]}', $action);
	    }
	}
	
	parseFunctions($action);
	
	insertSingleAbility($action,$cost);
	$text.=$cost.' : '.$action .'';
	
    }
    //$text = preg_replace('/([@mcavpslts]\([^\)]*\))/',' $1 ',$text);
    unset ($action);
   return $text;
    
    
    /*
    
    $ret= parseFunctions(
	parseEvents(
		parseDuration(
			trim($text)
		)
	) 
    );
    return $ret;
     *
     */
}

function parseRepairSomeText(&$text){
    $ret=&$text;
    $ret=preg_replace('/^@\[([^\]]*)\],?/', '$1', $ret);
    $ret=preg_replace('/\([^\)]*\)\s?$/','',$ret);
    
    $ret=str_ireplace('Urza-s', '$Urzas', $ret);
    $ret=str_ireplace('non-', 'non ', $ret);
    
    $ret=preg_replace('/(puts?) a /i','$1 one ',$ret);
    $ret=preg_replace('/(remove) a /i','$1 one ',$ret);
    $ret=preg_replace('/(draws?) a card/i','$1 one card',$ret);
    $ret=preg_replace('/(discards?) a card/i','$1 one card',$ret);
    $ret=preg_replace('/(flips?) a coin/i','$1 one coin',$ret);
    $ret=preg_replace('/power and toughness/i','power/toughness',$ret);
    $ret=preg_replace('/([.]); or/','$1 ; or',$ret);
    
    $ret=preg_replace('/([A-Za-z])-([^-])/', '$1 - $2', $ret);
    $ret=preg_replace('/-([A-Za-z])/', '- $1', $ret);
    
    return $ret;
}

function parsePlayers(&$text){
    global
	$players_r;
    $ret = &$text;
    //$ret = preg_replace('/(each)?\s?('.$players_r.')/i',' {type:\'Player\',value:\'$1$2\'}) ',$ret);
    parser('Player', '('.$players_r.')', '$1', $ret);
}

function parseAction(&$text){
    global 
	$actions_r;
    $ret = &$text;
    
    //$ret = preg_replace('/^[\s\.,]?('.$actions_r.')[\s\.,]/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret);
    //$ret = preg_replace('/[\s\.,]('.$actions_r.')[\s\.,]?$/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret);
    //$ret = preg_replace('/[\s\.,]('.$actions_r.')[\s\.,]/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret); 
    parser('Action', '('.$actions_r.')', '$1', $ret);
    
    return $ret;
}

function parseActive(&$text){
    global 
	$active_r;
    $ret = &$text;
    //$ret = preg_replace('/(this|isnt|is|non)?-?\s?('.$active_r.')/i','{type:\'Active\',value:\'$2$1\'}) ',$ret);
    parser('Active', '(isnt|non)?(this|is)?\s?('.$active_r.')', '$1$3', $ret);
    return $ret;
}

function parseTypes(&$text){
    global
	$colors_r,
	$lands_r,
	$subtypes_r,
	$types_r;
    
    $ret=&$text;
    //$ret=preg_replace('/^[\s\.,]?(this|isnt|is|non)?-?\s?a?\s?('. $types_r.'|'. $subtypes_r .'|'.$lands_r.'|'.$colors_r.')[\s\.\,;]/i', ' {type:\'Type\',value:\'$1$2\'} ', $ret);
    //$ret=preg_replace('/[\s\.,;](this|isnt|is|non)?-?\s?a?\s?('. $types_r.'|'. $subtypes_r .'|'.$lands_r.'|'.$colors_r.')[\s\.\,;]?$/i', ' {type:\'Type\',value:\'$1$2\'} ', $ret);
    //$ret=preg_replace('/[\s\.,;](this|isnt|is|non)?-?\s?a?\s?('. $types_r.'|'. $subtypes_r .'|'.$lands_r.'|'.$colors_r.')[\s\.\,;]/i', ' {type:\'Type\',value:\'$1$2\'} ', $ret);
    parser('Type', '(isnt|non)?(this|is)?\s?a?\s?('. $types_r.'|'. $subtypes_r .'|'.$lands_r.'|'.$colors_r.')', '$1$3', $ret);
}

function parseFC(&$text){
    $ret=&$text;    
    //F/C
    //$ret = preg_replace('/([+-]?[0-9XYZ]*\/[+-]?[0-9XYZ])/', ' {type:\'FC\',value:\'$1\'} ', $ret);
    parser('FC', '([+-]?[0-9XYZ][0-9XYZ]?\/[+-]?[0-9XYZ][0-9XYZ]?)', '$1', $ret);
}

function parseManas(&$text){
    global
	$manas_r;
    $ret=&$text;
    //Mana
    //$ret = preg_replace('/\{([0-9]?['. implode('',$manas_ar) .']?)\}/i', ' {type:\'Mana\',value:[\'$1\']} ', $ret);
    parser('Mana', '\{([0-9])?('. $manas_r .')?\}', '$1$2', $ret,false);
    //$ret = preg_replace('/\]\}\{type:\'Mana\',value\:\[/', '\',\'', $ret);
    
}

function parseNumbers(&$text){
    global
	$numbers_ar;
    $ret=&$text;
    $i=0;
    foreach($numbers_ar as $n){
	$ret=preg_replace('/ '.$n.'[\s\,\.\:\-;]/i',' '. $i . ' ',$ret);
	$i++;
    }

    //$ret = preg_replace('/^([+\-]?[0-9XYZ][\s,\.;])/', ' {type:\'Number\',value:\'$1\'} ', $ret);
    //$ret = preg_replace('/[\s,\.;:]([+\-]?[0-9XYZ][\s,\.;]?å$)/', ' {type:\'Number\',value:\'$1\'} ', $ret);
    //$ret = preg_replace('/[\s,\.;:]([+\-]?[0-9XYZ][\s,\.;])/', ' {type:\'Number\',value:\'$1\'} ', $ret);
    parser('Number', '([+-]?[0-9XYZ][0-9XYZ]?)', '$1', $ret);
    
    
}

function parseChoose(&$text){
    $ret=&$text;

    if(preg_match('/^Choose ([^\-]*) - /i',$ret)){
	$ret = preg_replace('/^Choose ([^\-]*) - /i',' {type:\'Choose\',value:\'$1\'} ; ', $ret);
    }
}

function parseCost(&$text){
    $ret=&$text;
    
    if(preg_match('/Add one mana of any color to your mana pool\./',$ret) ){
	$ret=&$ret;
    }
    

    if(preg_match('/^\{[^:]*:/',$ret)){
	$cost = preg_replace('/^([^:]*): .*/','$1', $ret);
	$cost = str_replace('{tap}','{TAP}',$cost);
	parseRepairSomeText($cost);
	parseNumbers($cost);
	parseFC($cost);
	parseAction($cost);
	parseManas($cost);
	//$cost = str_replace('{', '\'', $cost);
	//$cost = str_replace('}', '\'', $cost);
	//$cost = str_replace('$\'me\'','${me}',$cost);
	$cost = str_replace('\'\'', '\',\'', $cost);
	
	$cost = ' {type:\'Cost\',value:['.$cost.']} : ';
	
	
	$ret = preg_replace('/(^{[^:]*): /',$cost, $ret);
	$ret = str_replace($cost,'',$ret);
	return $cost;
    }
}

function parseAbilitys(&$text){
    global
	$colors_r,
	$abilities_r;// _ar;
    
    $ret=&$text;
    
    $rx='(isnt|non)?(this|is)??\s?a?\s?('.$abilities_r.')\s?(from)?\s?(the)?\s?('.$colors_r.')?';
    
    //$ret=preg_replace('/^'.$rx.'/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    //$ret=preg_replace('/'.$rx.'$/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    //$ret=preg_replace('/[\s,\.;^:]'.$rx.'[\s,\.;]/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    parser('Ability', '(isnt|non)?(this|is)?\s?a?\s?('.$abilities_r.')\s?(from)?\s?(the)?\s?('.$colors_r.')?', '$1$6$3', $ret);
    
    
    //$ret = preg_replace('/[Pp]rotection from the ([^\s^,^\.^;^:\]]*)/i',' {type:\'Ability\',value:\'$1Protection\'} ',$ret);
//$ret = parser('Ability', '[Pp]rotection from ([^\s^,^\.^;^:\]]*)', '$1Protection', $ret);
    //$ret = preg_replace('/[Pp]rotection from ([^\s^,^\.^;^:\]]*)/i',' {type:\'Ability\',value:\'$1Protection\'} ',$ret);
    //$ret = preg_replace('/(a\([^\}]*[Pp]rotection\)) and from ([^\s^,^\.^;^:\]]*)/i','$1 {type:\'Ability\',value:\'$2Protection\'} ',$ret);
    //$ret = parser('Ability', '[Pp]rotection from ([^\s^,^\.^;^:\]]*)', '$1Protection', $ret);
    
    //$ret = preg_replace('/[Aa]ffinity for ([^\s^,^\.^;^:\]]*)/i',' {type:\'Ability\',value:\'$1Affinity\'} ',$ret);
//$ret = parser('Ability', '[Aa]ffinity for ([^\s^,^\.^;^:\]]*)', '$1Protection', $ret);
    //$ret = preg_replace('/(a\([^\}]*[Aa]ffinity\)) and from ([^\s^,^\.^;^:\]]*)/i','$1 {type:\'Ability\',value:\'$2Affinity\'} ',$ret);
    
    return $ret;
}

function parseTurnStructures(&$text){
    global
	 $turnStructures_r;
    
    $ret=&$text;
    
    //$ret = preg_replace('/\s('.$turnStructures_r.')[\s,\.;]/i',' {type:\'TurnStructures\',value:\'$1\'} ',$ret);
    parser('TurnStructure','('.$turnStructures_r.')','$1',$ret);
    
}

function parseZones(&$text){
    global
	$zones_r;

    $ret=&$text;
    //$ret = preg_replace('/ ('.$zones_r.')/i', ' {type:\'Zones\',value:\'$1\'} ' , $ret);
    parser('Zone', '('.$zones_r.')', '$1', $ret);
}

function parseStatus(&$text){
    global
	$status_r;

    $ret=&$text;
    
    //$ret = preg_replace('/(this|isnt|is|non)?-?\s?a?\s??('.$status_r.')/i', ' {type:\'Status\',value:\'$1$2\'} ' , $ret);
    parser('Status', '(isnt|non)?(this|is)?\s?a?\s?('.$status_r.')', '$1$3', $ret);
}

function parseCounters(&$text){
    global
	$counters_r;

    $ret=&$text;
    
    //$ret = preg_replace('/(this|isnt|is|non)?-?\s?a?\s??('.$status_r.')/i', ' {type:\'Status\',value:\'$1$2\'} ' , $ret);
    parser('Counter', '('.$counters_r.') counters?', '$1', $ret);
}

function parseSelectors(&$text){
    global
	$selectors_r;

    $ret=&$text;
    
    //$ret = preg_replace('/(this|isnt|is|non)?-?\s?a?\s??('.$status_r.')/i', ' {type:\'Status\',value:\'$1$2\'} ' , $ret);
    parser('Selector', '('.$selectors_r.')', '$1', $ret);
}

function parseCoins(&$text){
    $ret=&$text;
    parser('Coin', '\{(C)\}', '$1' , $ret,false);
    //parser('Coin', '(Flip a coin)', '$1', $ret,false);
}

function insertSingleAbility($text,$cost){
    $abs=explode(' ; ', $text);
    foreach ($abs as &$ab){
    //$ab=$text;
	if($ab){
	    $s = new Abscript();
	    $t=parseAbility(trim($ab));
	    if($t!=''){
		    $s->setAbility(parseAbility(trim($t)));
		    $s->setSample(trim($cost.$ab));
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

				    $s->setAbility(parseAbility(trim($sab)));
				    $s->setSample(trim($cost.$sab));
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
}

function insertAbility($text){
	preg_match_all('/@\[[^\]]*\],?/', $text, $abs);
	//$abs = preg_split('/\], /', $text);
	foreach($abs[0] as $ab){
		//$s = AbscriptQuery::create()->findPk($ab."]");
		if($ab){
			$s = new Abscript();
			$t=parseAbility(substr(trim($ab),2));
			if($t!=''){
				$s->setAbility(parseAbility(trim($t)));
				$s->setSample(trim($ab."]"));
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
						
						$s->setAbility(parseAbility(trim($sab)));
						$s->setSample(trim($sab));
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

function parseAbility(&$text){
	$ret = $text;
	/*
	$ret = preg_replace_callback(
		'/@\([^\)]*\)/', 
		'escapeFC',
		$ret);
	*/
	$ret = preg_replace('/\{type:\'([^\']*)\'[^\}]*\}/',' ${$1} ',$ret);
	$ret = preg_replace('/\$Me/',' ${Me} ',$ret);
	/*
	$ret = preg_replace('/@\([^\)]*\)/',' ${FC} ',$ret);
	$ret = preg_replace('/m\([^\)]*\)/',' ${Mana} ', $ret);
	
	
	$ret=str_replace('  ', ' ', $ret);
	
	
	//$ret = preg_replace('/m\([^\)]*\)([^:]?):/','${cost}$1:', $ret);
	
	
	//$ret = preg_replace('/c\([^\)]*\)/',' ${condition} ', $ret);
	$ret = preg_replace('/a\([^\)]*\)/',' ${Ability} ', $ret);
	$ret = preg_replace('/v\([^\)]*\)/',' ${Val} ', $ret);
	//$ret = preg_replace('/p\([^\)]*\)/',' ${phase} ', $ret);
	//$ret = preg_replace('/s\([^\)]*\)/',' ${step} ', $ret);
	//$ret = preg_replace('/l\([^\)]*\)/',' ${loc} ', $ret);
	//$ret = preg_replace('/t\([^\)]*\)/',' ${target} ', $ret);	
	//$ret = preg_replace('/t\(v\([^\)\)]*\)/',' ${target} ', $ret);
	//$ret = preg_replace('/\s\([^\)]*\)/','',$ret); 
	*/
	$ret=str_replace('  ', ' ', $ret);
	return $ret;
/*	
	if(trim(preg_replace('/\$\{ability\}[\.,\s]?/','',$ret))!=''){
		return $ret;
	}else{
		return '';
	}
 */
}

function parseOutputText($text){
	$ret = preg_replace('/[^[:print:]]/', '', $text);
	$ret = str_replace(chr(226) , '-', $ret);
	$ret = str_replace(chr(195), 'AE', $ret);
	//$ret = iconv("UTF-8", "ISO-8859-1//IGNORE",$ret); 
	return $ret; 
}

function parseFunctionArgs(&$m,$rown){
    
    $ret = '{';
    $i=0;
    foreach ($m as $k => &$mm){
	if(!is_numeric($k)){
	    if($i>0) $ret.=',';
	    $mm[$rown]=trim($mm[$rown]);
	    if($mm[$rown]){
		if(substr($mm[$rown],0,1) != '{'){
		    $mm[$rown] = '\''.$mm[$rown].'\'';
		}
		if(preg_match_all('/\}\s\{/', $mm[$rown],$p)){
		    $ret.=$k.':['.preg_replace('/\}\s\{/','},{',$mm[$rown]).']';
		}else{
		    $ret.=$k.':'.$mm[$rown];
		}
	    }else{
		$ret.=$k.':null';
	    }
	    $i++;
	}
    }
    $ret.='}';
    return $ret;
}

function parseFunctions(&$text){
    $ns='MTG.cardAbilities';
    $tappo='[\s\.,;:]';
    $ret = &$text;
    $funcs_ar=array(
	// \{type:\'Selector\'[^\}]*\}
	//gets (?p<turnStructure>\{type:\'TurnStructure\'[^\}]*\})?
	'gets'=>array(
	    //'/(Target)?\s?(?P<target>\$Me|\{type:\'Type\'[^\}]*\})\s*gets?\s*(?P<fc>\{type:\'FC\'[^\}]*\})\s?(?P<timeEvent>until)?\s?(?P<turnStructure>\{type:\'TurnStructure\'[^\}]*\})?'.$tappo.'/i'
	    '/(?P<selector>{type:\'Selector\'[^\}]*\})?\s?(Target)?\s?(?P<target>\$Me|(\{type:\'(Type|Player)\'[^\}]*\}\s?)*)\s?gets?\s*(?P<fc>\{type:\'FC\'[^\}]*\})\s?(?P<timeEvent>until)?\s?(?P<turnStructure>\{type:\'TurnStructure\'[^\}]*\})?'.$tappo.'/i'
	),
	'has'=>array(
	    '/(?P<selector>{type:\'Selector\'[^\}]*\})?\s?(Target)?\s?(?P<target>\$Me|(\{type:\'(Type|Player|Status)\'[^\}]*\}\s?)*)\s?(has|have)\s?(?P<ability>\{type:\'Ability\'[^\}]*\})\s?(?P<timeEvent>until)?\s?(?P<turnStructure>\{type:\'TurnStructure\'[^\}]*\})?'.$tappo.'/i'
	),
	'pay'=>array(
	    '/(?P<target>(\{type:\'Player\'[^\}]*\}\s)*)?\s?Pay\s?(?P<howMany>\$Me|\{type:\'(Number|Mana)\'[^\}]*\})\s?(?<what>life|mana cost)?'.$tappo.'/i'
	),
	'putCounters'=>array(
	    /*
	     * Remove {type:'Number',value:'1'} {type:'FC',value:'-1/-1'} counter from target {type:'Type',value:'creature'} .
	     */
	    '/(puts?)\s?(?P<selector>{type:\'Selector\'[^\}]*\})?\s?(?P<howMany>\{type:\'Number\'[^\}]*\})?\s?(?P<what>((\{type:\'(FC|Type|Counter)\'[^\}]*\}\s?)*))?\s?(counters?|tokens?)?\s?(with|onto|on|from)\s?(the|for)?\s?(?P<with>\{type:\'Ability\'[^\}]*\})?\s?(?P<target>\$Me|\{type:\'Type\'[^\}]*\})?(?P<where>\{type:\'Zone\'[^\}]*\})?'.$tappo.'/i'
	),
	//(?P<selector>{type:\'Selector\'[^\}]*\})?
	//	remove {type:'Selector',value:'all'} {type:'FC',value:'+1/+1'} counters from $Me
	'removeCounters'=>array(
	    '/remove\s?(?P<selector>{type:\'Selector\'[^\}]*\})?\s?(?P<howMany>\{type:\'Number\'[^\}]*\})?\s?(?P<what>((\{type:\'(FC|Type|Counter)\'[^\}]*\}\s?)*))?\s?(counters?|tokens?)?\s?(with|onto|on|from)\s?(the|for)?\s?(?P<with>\{type:\'Ability\'[^\}]*\})?\s?(?P<target>\$Me|\{type:\'Type\'[^\}]*\})?(?P<where>\{type:\'Zone\'[^\}]*\})?'.$tappo.'/i'
	),
	'counterSpell'=>array(
	    '/Counter target (?P<target>\$Me|(\{type:\'(Type)\'[^\}]*\}\s?)*)'.$tappo.'/i'
	)
    );
    if(preg_match('/ remove.*counters?/i', $ret)){
    	$a=true;
	//$ret="Whenever \$Me or another {type:'Type',value:'Ally'} enters the {type:'Zone',value:'battlefield'} under {type:'Player',value:'your'} control, {type:'Player',value:'you'} may have {type:'Type',value:'Ally'} {type:'Type',value:'creatures'}  {type:'Player',value:'you'} control get {type:'FC',value:'+1/+0'} until {type:'TurnStructure',value:'end of turn'} .";
	//$ret="Target {type:'Type',value:'creature'} {type:'Player',value:'you control'} gets {type:'FC',value:'+2/-2'} until {type:'TurnStructure',value:'end of turn'} .";
    }
    foreach ($funcs_ar as $fname=> &$func){	
	foreach ($func as &$rfunc){
	    if(preg_match_all($rfunc, $ret,$f)){
		for($i=0;$i<count($f[0]);$i++){
		    //foreach($m as $k=>&$mm){
			//if(!is_numeric($k)){
			    $ret=str_replace($f[0],'\n'. $ns.'.'. $fname.'(/*card*/$this,'.parseFunctionArgs($f, $i).");\n", $ret);
			//}
		    //}
		}
	    }
	}
    }
}

function parseEvents(&$text){
    //$ns='MTG.cardAbilities';
    $tappo='[\s\.,;:]';
    $ret = &$text;
    $evs_ar=array(
	//gets (?p<turnStructure>\{type:\'TurnStructure\'[^\}]*\})?
	'on'=>array(
	    '/zzz'.$tappo.'/i'
	),
    );
    if(preg_match('/ pay /i', $ret)){
    	$a=true;
    }
    foreach ($funcs_ar as $fname=> &$func){	
	foreach ($func as &$rfunc){
	    if(preg_match_all($rfunc, $ret,$m)){
		for($i=0;$i<count($m[0]);$i++){
		    //$ret=str_replace($m[0],' '. $ns.'.'. $fname.parseFunctionArgs($m, $i).'; ', $ret);
		
		}
	    }
	}
    }
}

function parseDuration($text){
    $ret=&$text;
    $ret=preg_replace('/until ([\$sp][\(\{][^\}^\)]*[\}\)])/i','duration_until :$1',$ret);
    return $ret;
}

function parser($type,$regExp,$value,&$text,$useTappo = true){
    $ret=&$text;
    if(preg_match('/'.$regExp.'/i', $ret)){
	//reSpace($ret);
	if($useTappo){
	    $tappo='[\s\.,;:]';
	    $valueTappo=preg_replace_callback('/\$[0-9][0-9]?/', "reposRegExpValues_Callback", $value);
	    preg_match_all('/[^\)]?\(/', $regExp,$m);
	    $ret=preg_replace('/^'.$regExp.'$/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret );
	    reSpace($ret);
	    $ret=preg_replace('/^('.$tappo.')?'.$regExp.'('.$tappo.')/i', '$1 {type:\''.$type.'\',value:\''.$valueTappo.'\'} $'.(count($m[0])+2), $ret);
	    reSpace($ret);
	    $ret=preg_replace('/('.$tappo.')'.$regExp.'('.$tappo.')?$/i', '$1 {type:\''.$type.'\',value:\''.$valueTappo.'\'} $'.(count($m[0])+2), $ret );
	    reSpace($ret);
	    while (preg_match('/('.$tappo.')'.$regExp.'('.$tappo.')/i', $ret)){
		$ret=preg_replace('/('.$tappo.')'.$regExp.'('.$tappo.')/i', '$1 {type:\''.$type.'\',value:\''.$valueTappo.'\'} $'.(count($m[0])+2), $ret );
		reSpace($ret);
	    }
	}else{
	    $ret=preg_replace('/'.$regExp.'/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret );
	}
	$ret = preg_replace('/\}\{/', '} {', $ret);
    }
    
    
    //return $ret;
}

function reSpace(&$text){
     while (preg_match('/\s\s/', $text)){
	$text = str_replace('  ', ' ', $text);
    }
}

function reposRegExpValues_Callback($m){
    $v=str_replace("$", '', $m[0]);
    $ret = '$'.($v+1);
    return $ret;
}
?> 