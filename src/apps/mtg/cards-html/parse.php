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
$colors_ar=array('white','black','red','green','blue','basic','multicolored','monocolored','colorless','any colors?','all colors');
$colors_r=implode('|',$colors_ar);
$manas_ar=array('G','B','R','W','U','X','Y','Z');
$manas_r=implode('|',$manas_ar);
$abilities_ar = array(
    'Deathtouch','Defender','Double Strike','Enchant','Equip','First Strike','Flying','Haste','Intimidate','Landwalk','Lifelink','Protection','Reach','Shroud',
    'Trample','Vigilance','Banding','Rampage','Cumulative Upkeep','Flanking','Phasing','Buyback','Shadow','Cycling','Echo','Horsemanship','Fading','Kicker','Flashback','Flash',
    'Madness','Fear','Morph','Amplify','Provoke','Storm','Affinity','Entwine','Modular','Sunburst','Bushido','Soulshift','Splice','Offering','Ninjutsu','Epic','Convoke',
    'Dredge','Transmute','Bloodthirst','Haunt','Replicate','Forecast','Graft','Recover','Ripple','Split Second','Suspend','Vanishing','Absorb','Aura Swap','Delve',
    'Fortify','Frenzy','Gravestorm','Poisonous','Transfigure','Champion','Changeling','Evoke','Hideaway','Prowl','Reinforce','Conspire','Persist','Wither','Retrace',
    'Devour','Exalted','Unearth','Cascade','Annihilator','Level Up','Rebound','Totem Armor','Infect','Battle Cry','Living Weapon','mana ability'
);
$abilities_r=implode('|',$abilities_ar);
$types_ar = array(
    'Artifacts?','Creatures?','Enchantments?','Instants?','Lands?','Planeswalkers?','Sorceries?','Tribals?','Planes?','Vanguards?',
    'Schemes?','Spells?','Mana Abilities','Abilities','Sorcery','Wall','permanents?','Ability'
);
$types_r=implode('|',$types_ar);
$players_ar=array('Opponents?','Players?','he or she','Owners?'.'controllers?');
$players_r=implode('|', $players_ar);
$lands_ar=array('forests?','swamps?','islands?','plains?','mountains?','basic lands?');
$lands_r=implode('|',$lands_ar);
$zones_ar = array(
    'Librarys?','Hands?','Battlefields?','Graveyards?','Stacks?','Exiles?','Antes?','Mana Pools?'
);
$zones_r=implode('|',$zones_ar);
$turnStructures_ar = array(
    'Beginning Phases?','Untap Steps?','Upkeep Steps?','Draw Steps?','Main Phases?','Combat Phases?','Beginning of Combat Steps?','Declare Attackers Steps?',
    'Declare Blockers Steps?','Combat Damage Steps?','End of Combat Steps?','Ending Phases?','End Steps?','End Of Turns?','Turns?','Upkeeps?'
);
$turnStructures_r=implode('|',$turnStructures_ar);

$actions_ar = array(
  'Activates?','Attachs?','Attacks?','Blocks?','Casts?','NONFARLOCounter','Destroy','Exchange','Exile','Play','Regenerates?','Reveals?','Sacrifices?','Search','Shuffle',
  'Tapp,','Untapp','Taps?','Untaps?','Scry','Fateseal','Clashs?','Planeswalk','Set in Motions?','Abandon','Proliferates?','Discards?','Draws?'
);
$actions_r=implode('|',$actions_ar);



array_multisort($abilities_ar,SORT_DESC);
array_multisort($types_ar,SORT_DESC);
array_multisort($types_ar,SORT_DESC);
array_multisort($actions_ar,SORT_DESC);

$status_ar = array('Equiped','unblockable','Enchanted','Equipment\s?');
foreach ($actions_ar as &$action){
    array_push($status_ar,$action.'ed');
}
$status_r =implode('|',$status_ar );

$active_ar = array();
foreach ($actions_ar as &$action){
    array_push($active_ar,$action.'ing');
}
$active_r =implode('|',$active_ar );



$subtypes_ar=array('Urzas','Legendary','Zombie','snow','Spirits?','Vampire','Elf','Faerie','Eye');
$p = CardsQuery::create();
$subtypes_ar_tmp =$p->setFormatter(ModelCriteria::FORMAT_ARRAY)->groupBy('Typeen')->select(array('Typeen'))->find();
foreach($subtypes_ar_tmp as &$st){
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
		    if(strpos($st,'-') || strpos($st,' ')){
			$a=true;
		    }
		    array_push($subtypes_ar, $st);
		    $st='';
		}
	    }
	}else{
	    $st='';
	}
    }   
}
unset($subtypes_ar_tmp);
$subtypes_ar=array_unique($subtypes_ar);
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
	parseManas($action);
	parsePlayers($action);
	parseStatus($action);
	parseActive($action);
	parseZones($action);
	
	parseTypes($action);
	parseAbilitys($action);	
	parseTurnStructures($action);
	parseAction($action);
	
	//parseTargets($action);
	$parsers_ar=array('FC','Number','Mana','Status','Active','TurnStructure','Zone','Ability','Type','Action');
	foreach($parsers_ar as $pa){
	    $rx='/\{type:\\\''.$pa.'\\\',\s?value:\\\'([^\\\']*)\\\'\}\s?(and)\s?{type:\\\''.$pa.'\\\',\s?value:\\\'([^\\\']*)\\\'\}/i'; 
	    if(preg_match($rx, $action)){
		$action = preg_replace($rx, '{type:\''.$pa.'\',value:\'$1,$3\'}', $action);
	    }
	}
	foreach($parsers_ar as $pa){
	    $rx='/\{type:\\\''.$pa.'\\\',\s?value:\[?([^\}^\]]*)\]?\}\s?,?\s?(or)\s?(the)?\s?{type:\\\''.$pa.'\\\',\s?value:\[?([^\}^\]]*)\]?\}/i'; 
	    if(preg_match($rx, $action)){
		$action = preg_replace($rx, '{type:\''.$pa.'\',value:[$1,$4]}', $action);
	    }
	}
	
	//parseFunctions($action);
	
	insertSingleAbility($action,$cost);
	$text.='doActiveCardAbility('.$cost.','.$action .')';
	
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
    $ret = &$text;
    $ret = preg_replace('/^@\[([^\]]*)\],?/', '$1', $ret);
    $ret = preg_replace('/\([^\)]*\)\s?$/','',$ret);
    $ret=preg_replace('/(draws?) a card/i','$1 one card',$ret);
    $ret=preg_replace('/(discards?) a card/i','$1 one card',$ret);
    $ret=str_replace('Urza-s', '$Urzas', $ret);
    return $ret;
}

function parsePlayers(&$text){
    global
	$players_r;
    $ret = &$text;
    //$ret = preg_replace('/(each)?\s?('.$players_r.')/i',' {type:\'Player\',value:\'$1$2\'}) ',$ret);
    parser('Player', '('.$players_r.')', '$1$2', $ret);
}

function parseAction(&$text){
    global 
	$actions_r;
    $ret = &$text;
    
    //$ret = preg_replace('/^[\s\.,]?('.$actions_r.')[\s\.,]/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret);
    //$ret = preg_replace('/[\s\.,]('.$actions_r.')[\s\.,]?$/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret);
    //$ret = preg_replace('/[\s\.,]('.$actions_r.')[\s\.,]/i',' {type:\'Action\',value:\'$1 $2\'}) ',$ret); 
    parser('Action', '('.$actions_r.')', '$1 $2', $ret);
    
    return $ret;
}

function parseActive(&$text){
    global 
	$active_r;
    $ret = &$text;
    $ret = preg_replace('/('.$active_r.')/i','{type:\'Active\',value:\'$1\'}) ',$ret);
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
    parser('Type', '(this|isnt|is|non)?-?\s?a?\s?('. $types_r.'|'. $subtypes_r .'|'.$lands_r.'|'.$colors_r.')', '$1$2', $ret);
}

function parseFC(&$text){
    $ret=&$text;    
    //F/C
    //$ret = preg_replace('/([+-]?[0-9XYZ]*\/[+-]?[0-9XYZ])/', ' {type:\'FC\',value:\'$1\'} ', $ret);
    parser('FC', "([+\-]?[0-9XYZ]*\\/[+\\-]?[0-9XYZ]*)", '$1', $ret);
}

function parseManas(&$text){
    global
	$manas_r;
    $ret=&$text;
    //Mana
    //$ret = preg_replace('/\{([0-9]?['. implode('',$manas_ar) .']?)\}/i', ' {type:\'Mana\',value:[\'$1\']} ', $ret);
    parser('Mana', '\{([0-9]?['. $manas_r .']?)\}', '$1', $ret);
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
    parser('Number', '([+\-]?[0-9XYZ])', '$1', $ret);
    
    
}

function parseCost(&$text){
    $ret=&$text;
    
    if(preg_match('/Add one mana of any color to your mana pool\./',$ret) ){
	$ret=&$ret;
    }
    

    if(preg_match('/^\{[^:]*:/',$ret)){
	$cost = preg_replace('/^([^:]*): .*/','$1', $ret);
	$cost = str_replace('{tap}','{TAP}',$cost);
	$cost = str_replace('{', '\'', $cost);
	$cost = str_replace('}', '\'', $cost);
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
    
    $rx='(this|isnt|is|non)?-?\s?a?\s?('.$abilities_r.')\s?(from)?\s?(the)?\s?('.$colors_r.')?';
    
    //$ret=preg_replace('/^'.$rx.'/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    //$ret=preg_replace('/'.$rx.'$/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    //$ret=preg_replace('/[\s,\.;^:]'.$rx.'[\s,\.;]/i',' {type:\'Ability\',value:\'$1$5$2\'} ' , $ret);
    parser('Ability', '(this|isnt|is|non)?-?\s?a?\s?('.$abilities_r.')\s?(from)?\s?(the)?\s?('.$colors_r.')?', '$1$5$2', $ret);
    
    
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
    parser('TurnStructures','('.$turnStructures_r.')','$1',$ret);
    
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
    parser('Status', '(this|isnt|is|non)?-?\s?a?\s?('.$status_r.')', '$1 $2', $ret);
}

function insertSingleAbility($text,$cost){
    $ab=$text;
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

function parseFunctions(&$text){
       $ret = &$text;   
    
/*    
    if(preg_match('/deals? /i', $ret)){
	echo $ret."\n";
    }
*/
    
    //'Add one mana of any color to your mana pool\.'
//(\{type:\'Player\',[^\}]*\})
    $ret=preg_replace('/(target |that )?\s?(\{type:\'Player\',[^\}]*\})\s*draw\s*(\{type:\'Number\',[^\}]*\})\s*(additionals?)?\s?cards?/i',' drawCards({target:$2,howmany:$3}); ',$ret);   
    
    $ret=preg_replace('/draw\s*(up to)?\s?(\{type:\'Number\',[^\}]*\})\s*cards?/i',' drawCards({target:null,howmany:$2}); ',$ret);
        
    //$ret=preg_replace('/deals? ([\$v][\(\{][^\}^\)]*[\}\)]) (damage)?\s?to ([\$t][\(\{][^\}^\)]*[\}\)])/i','func_dealDamagesTo:$1 :$3',$ret);
    
    //FATTA A META $ret=preg_replace('/deals? v\(([^\)]*)\) (combat damage|damage)?\s?to ([\$t][\(\{][^\}^\)]*[\}\)])/i','func_dealDamagesTo:$1 :$3',$ret);
    
    //$ret=preg_replace('/deals? ([\$v][\(\{][^\}^\)]*[\}\)]) (combat damage)?\s?to ([\$t][\(\{][^\}^\)]*[\}\)])/i','func_dealCombatDamagesTo:$1 :$3',$ret);  
    
    //DA FARE $ret=preg_replace('/([\$t][\(\{][^\}^\)]*[\}\)])?\s?discards? ([\$v][\(\{][^\}^\)]*[\}\)]) cards?\s?(at)?\s?(random)?/i','func_discardCards:$2 :$1 :$4',$ret);
    
    
    
    //$ret=preg_replace('/ gains? ([\$a][\(\{][^\}^\)]*[\}\)])/i','func_gains:$1',$ret);
    
    //$ret=preg_replace('/ gets? ([\$@][\(\{][^\}^\)]*[\}\)])/i','func_gets:$1',$ret);
    
    //$ret=preg_replace('/skip (your) (next) ([\$s][\(\{][^\}^\)]*[\}\)])/i','func_skyp:$1 :$2 :$3',$ret);
   
/*    
    if(preg_match('/deals? /i', $ret)||preg_match('/func_deal/i', $ret)){
	echo $ret."\n";
    }
*/
    //return $ret;
}

function parseEvents($text){
    global
	$act_ar;
    $ret=&$text;
    
    $ret=preg_replace('/at the (beginning|end) of (your|opponents?|players?) ([\$][\(\{][^\}^\)]*[\}\)])/i','event_$1:\${target} :$3',$ret);
    $ret=preg_replace('/at the (beginning|end) of (your|opponents?|players?) ([\sp][\(\{][^\}^\)]*[\}\)])/i','event_$1:t($2) :$3',$ret);
    $ret=preg_replace('/whenever ([\$sp][\(\{][^\}^\)]*[\}\)]) ('.implode('|', $act_ar).')/i','event_whenever:$1 :$2',$ret);
    $ret=preg_replace('/As an additional cost to cast ([\$][\(\{][^\}^\)]*[\}\)]),([^\.]*)/i','event_toCast:$1 :${$2}',$ret);
    //$ret=preg_replace('/(When)?\s?([\$t][\(\{][^\}^\)]*[\}\)]) enters? the ([\$l][\(\{][^\}^\)]*[\}\)]) /i','event_enter:$2 :$3 :$4',$ret);
    
    return $ret;
}

function parseDuration($text){
    $ret=&$text;
    $ret=preg_replace('/until ([\$sp][\(\{][^\}^\)]*[\}\)])/i','duration_until :$1',$ret);
    return $ret;
}

function parser($type,$regExp,$value,&$text){
    $tappo="[\s\.\-,;:]";
    $ret=&$text;
    
    $ret=preg_replace('/^'.$tappo.'?'.$regExp.$tappo.'/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret);
    $ret=preg_replace('/'.$tappo.$regExp.$tappo.'?$/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret );
    $ret=preg_replace('/'.$tappo.$regExp.$tappo.'/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret );
    $ret=preg_replace('/^'.$regExp.'$/i', ' {type:\''.$type.'\',value:\''.$value.'\'} ', $ret );
    //return $ret;
}
?>