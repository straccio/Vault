<?php
require_once 'inc/cacheClass.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PropelHelper
 *
 * @author ambrosini_c
 */
class PropelHelper {
    //put your code here
    public function __construct($appName,$appRoot,$propelApps) {
	global 
            $root;
        
        $include_path=get_include_path();
        $include_path.=PATH_SEPARATOR . $root . '/'.$appRoot.'/propel/build/classes/';
        foreach ($propelApps as $app){
            $include_path.=PATH_SEPARATOR . $root . '/apps/'.$app.'/propel/build/classes/';
        }
        set_include_path($include_path);
        Propel::init($appRoot.'/propel/build/conf/'.  strtolower($appName) .'-conf.php');
    }

    function search($obj,$query,$start,$limit,$sort,$dir,$fields){
			//global $pnMapper,$pnObject;
			$preLevel=0;
			$preJ='';
			$preOp='';
			$preUse='';
			if (class_exists($obj)){
				eval('$q='.$obj.'Query::create();');
				$frmt = ModelCriteria::FORMAT_ARRAY;// new PropelObjectFormatter();
				$q->setFormatter($frmt);
				
				foreach($query as $qq){
				    $field=$qq->field;
				    $fields=explode('.', $field);
				    foreach($){
					
				    }
				}
				return;

	/* METADATI NON SUPPORTATI DA Ext.Direct				
					$ret['metadata']=$this->getMetadata($obj);
					$ret['metadata']['root']='data';
					$ret['metadata']['totalProperty']='count';
					$ret['metadata']['successProperty']='success';
	*/				
					
					$this->parseQueryObjectAndSetToQuery($q,$query,$obj);
					
					$this->setJoinsToQuery($q);
					
					if($start){
//	// METADATI NON SUPPORTATI DA Ext.Direct					$ret['metadata']['start']=$start;
						$q->offset($start);
					}
					if($limit){
//	// METADATI NON SUPPORTATI DA Ext.Direct					$ret['metadata']['limit']=$limit;
						$q->limit($limit);
					}
					if($sort){
//	// METADATI NON SUPPORTATI DA Ext.Direct					$ret['metadata']['sortInfo']['field']=$sort;
//	// METADATI NON SUPPORTATI DA Ext.Direct					$ret['metadata']['sortInfo']['direction']=$dir;
						$q->orderBy($sort,$dir);
					}		
					
//					$ret['sql']=$q->toString();
					//$ret['query']=&$query;
					
					$p=$q->find();

					$ret["data"]=array();
					
					if(count($fields)){
						$fs=array();
						foreach($fields as &$field){
							$field=explode(',', $field);
							foreach ($field as $f){
								array_push($fs,'["'. str_replace('.', '"]["', $f).'"]');
							}
						}
						
						foreach($p as &$itm){
							$itmTMP=&$this->populateItemsWithRelationsObjects($q,$itm);
							$itm=array();
							foreach($fs as $field){
								eval('$itm'.$field.'=$itmTMP'.$field.';');
							}
							unset($itmTMP);
							array_push($ret["data"],$itm);
						}
					}else{
						foreach($p as &$itm){
							array_push($ret["data"],$this->populateItemsWithRelationsObjects($q,$itm));
						}
					}
					
					
					$ret['count']=$q
						->offset(0)
						->limit(0)
						->count();
					$ret['success']=true;
//				}catch(Exception $e){
					
//				}
				return $ret;
				
			}
		}
			
    function setJoinsToQuery(&$q){
	    $rs=$q->getTableMap()->getRelations();
	    $i=1;
	    foreach($rs as $r){
		    if($r->getType()==1){
			    $tname=$r->getForeignTable()->getName();
			    eval('$q->use'.$r->getName().'Query(\'j_'.$tname.$i.'\',Criteria::LEFT_JOIN);');
			    $q->with('j_'.$tname.$i);
			    $i++;
		    }
	    }
    }

    function parseQueryObjectAndSetToQuery(&$q,$query,$obj){
	    global $pnMapper,$pnObject;

	    $i=1;
	    $i2=1;
	    $preJ='';
	    $preJs='';
	    $preJre='';
	    $preI=1;
	    $preCond='';
	    $allconds=array();
	    $renderLevel=array();
	    $preRenderLevel=array();
	    $combines=array();
	    $levelConds=array();
	    //$preLevelCond=array();

	    eval('$map= new '.$pnObject[$obj].'TableMap();');

	    $last=count($query);
	    foreach($query as $w){
		    $where=$w->field;
		    //$map = new ReferencesTableMap();
		    $where = $map->getName() .".".$map->getColumn($w->field)->getName();
		    switch ($w->operator){	
			    case 'eq':
				    $w->operator=Criteria::EQUAL;
				    //$where .=' = ';
				    //$where .=' ? ';
			    break;
			    case 'neq':
				    $w->operator=Criteria::NOT_EQUAL;
				    //$where .=' <> ';
				    //$where .=' ? ';
			    break;
			    case 'gt':
				    $w->operator=Criteria::GREATER_THAN;
				    //$where .=' > ';
				    //$where .=' ? ';
			    break;
			    case 'lt':
				    $w->operator=Criteria::LESS_THAN;
				    //$where .=' < ';
				    //$where .=' ? ';
			    break;
			    case 'in':
				    $w->operator=Criteria::IN;
				    //$where .=' in ';
				    //$w->value = '('.$w->value.')';
				    $w->value=explode(',',$w->value);
			    break;
			    case 're':
				    $w->operator=' REGEXP ';
				    //$where.= ' REGEXP ';
				    //$where .=' ? ';
			    break;
			    default:
				    $w->value=str_replace('*','%',$w->value);
				    if( strpos($w->value)===false && is_numeric($w->value)){
					    $w->operator=Criteria::EQUAL;
				    }else{
					    $w->operator=Criteria::LIKE;
				    }
			    break;
		    }


		    if(1==$last){
			    //$q=ReferencesQuery::create();
			    $q->addCond('where',$where,$w->value ,$w->operator);
			    $q->combine(array('where'));
			    //if(is_array($w->value)){
			    //	$q->addCond('cond',$where,$w->value ,Criteria::IN);
			    //}else{
			    //	$q->where($where,$w->value);
			    //}
			    break;
		    }else{
			    $cond = array('cond'.$i,$where,$w->value,$w->operator);
			    array_push($allconds,$cond);
			    if($i==1){
				    $preJ=$w->junction;
				    $preLevel=$w->level;
			    }
			    if($w->level == $preLevel){
				    array_push($levelConds,$cond);
				    if($i==$last){
					    $cnames=array();
					    foreach($levelConds as $c){
						    array_push($cnames,$c[0]);
					    }
					    array_push($combines,
						    array(
							    'conds'.$i2,
							    $cnames,
							    $preJ
						    )
					    );
					    unset($cnames);		
					    array_push($renderLevel,'conds'.$i2);	
				    }
			    }else{
				    $preJs=$query[$i-2]->junction;
				    if(count($levelConds)>1){
					    $cnames=array();
					    foreach($levelConds as $c){
						    array_push($cnames,$c[0]);
					    }
					    array_push($combines,
								    array(
									    'conds'.$i2,
									    $cnames,
									    $preJ
								    )
							    );
					    unset($cnames);		
					    array_push($renderLevel,'conds'.$i2);
					    $i2++;
					    unset($levelConds);
					    $levelConds=array();
					    array_push($levelConds,$cond);
					    $preJ=$w->junction;
				    }else{
					    array_push($renderLevel,'cond'.($i-1));
					    unset($levelConds);
					    $levelConds=array();
					    array_push($levelConds,$cond);
				    }
				    $preJ=$w->junction;						
				    if($w->level < $preLevel){
					    if(count($renderLevel)){
						    $preJre=$query[$i-2]->junction;
						    array_push($combines,
							    array(
								    'conds'.$i2,
								    $renderLevel,
								    $preJs

							    )
						    );
						    unset($renderLevel);
						    $renderLevel=array();
						    array_push($preRenderLevel,'conds'.$i2);
						    $i2++;
						    if(count($preRenderLevel)>1){
							    array_push($combines,
								    array(
									    'conds'.$i2,
									    $preRenderLevel,
									    $preJre
								    )
							    );
							    unset($preRenderLevel);
							    $preRenderLevel=array();
							    array_push($preRenderLevel,'conds'.$i2);
							    $i2++;
						    }									
					    }
				    }
				    if($i==$last){
					    array_push($renderLevel,'cond'.$i);
				    }		
			    }

			    $preLevel=$w->level;
			    $i++;
		    }
	    }
	    foreach($allconds as $cond){
		    $q->addCond($cond[0],$cond[1],$cond[2] ,$cond[3]);
		    //$q=ReferencesQuery::create()->addCond($name, $p1)
		    //if(is_array($cond[2])){
		    //	$q->addCond($cond[0],$cond[1],$cond[2] ,Criteria::IN);
		    //}else{
		    //	$q->condition($cond[0],$cond[1],$cond[2]);
		    //}

	    }
	    foreach($combines as $cond){
		    $q->combine($cond[1],$cond[2],$cond[0]);
	    }
	    if(1!=$last && $last){
		    if(count($preRenderLevel)){
			    if(count($renderLevel)==1){
				    array_push($preRenderLevel,$renderLevel[0]);
			    }else{
				    $q->combine($renderLevel,$preJs,'conds'.$i2);
				    array_push($renderLevel,'conds'.$i2);
			    }
			    $preJs=$preJre;
			    $renderLevel = $preRenderLevel;					
		    }

		    $q->where($renderLevel,$preJs,'latest');
	    }
    }

    function parseQueryObjectAndSetToQueryREFACT(&$q,$query,$obj){
	    global $pnMapper,$pnObject;

	    $iCond=1;
	    $iComb=1;
	    $last=count($query);
	    $preJRender='';
	    $preJLevel='';
	    $preLevel='';
	    $allconds=array();
	    $levelConds=array();
	    $combines=array();
	    $renderLevel=array();

	    eval('$map= new '.$pnObject[$obj].'TableMap();');

	    foreach($query as $w){
		    $where = $pnObject[$obj].".".$map->getColumn($w->field)->getPhpName();
		    switch ($w->operator){
			    case 'eq':
				    $where .=' = ';
			    break;
			    case 'neq':
				    $where .=' <> ';
			    break;
			    case 'gt':
				    $where .=' > ';
			    break;
			    case 'lt':
				    $where .=' < ';
			    break;
			    case 'in':
				    $where .=' in ';
				    $w->value=explode(',',$w->value);
			    break;
			    default:
				    $where.= ' like ';
				    $w->value=str_replace('*','%',$w->value);

			    break;
		    }
		    $where .=' ? ';

		    //C'� solo una condizione
		    if(1==$last){
			    $q->where($where,$w->value);
			    break;
		    }else{
			    //Mi salvo le condizioni
			    $cond = array('cond'.$iCond,$where,$w->value);
			    array_push($allconds,$cond);
			    //Se � la prima condizione
			    //mi salvo la Junction e il livello attuali
			    //ogni livello condivide le stesse Junction
			    if($iCond==1){
				    $preJLevel=$w->junction;
				    $preLevel=$w->level;
			    }
			    //Se � lo stesso livello di quello precedente (o il primo)
			    //Aggiungo la condizione al livello attuale.
			    if($w->level == $preLevel){
				    array_push($levelConds,$cond);
				    //Se � l'ultima condizione
				    if($iCond==$last){
					    $cnames=array();
					    foreach ($levelConds as $c){
						    array_push($cnames, $c[0]);
					    }
					    //Li combino con la prima Junction del livello.
					    array_push($combines, array(
						    'conds'.$iComb,
						    $cname,
						    $preJLevel
					    ));
					    //Aggiungo ai livelli da "Renderizzare" quello appena combinato
					    array_push($renderLevel,'conds'.$iComb);
					    $iComb++;
					    unset($cnames);
				    }
			    }else{
				    //La Junction tra i livelli successivi 
				    //� la Junction dell'ultima condizione del livello precendete
				    //Tutti i livelli che crescono condividono la prima Junction.
				    if(!$preJRender){
					    $preJRender=$query[$iCond-1]->junction;
				    }
				    //Se il livello cambia
				    //Se il livello precedente ha pi� di una condizione le combino
				    if(count($levelConds)>1){
					    $cnames=array();
					    foreach ($levelConds as $c){
						    array_push($cnames, $c[0]);
					    }
					    //Li combino con la prima Junction del livello.
					    array_push($combines, array(
						    'conds'.$iComb,
						    $cname,
						    $preJLevel
					    ));
					    //Aggiungo ai livelli da "Renderizzare" quello appena combinato
					    array_push($renderLevel,'conds'.$iComb);
					    $iComb++;
					    unset($cnames);
				    }else{
					    //Il livello essendo composto da una sola condizione e come se fosse gi� combinato
					    //aggiungo ai Livelli da "Renderizzare" la condizione semplice.
					    array_push($renderLevel,'cond'.($i-1));

				    }
				    unset($levelConds);
				    $levelConds=array();
				    //Mi salvo la prima Junction del livello
				    $preJLevel=$w->juction;
				    //Aggiungo al livello attuale la prima condizione
				    array_push($levelConds, $cond);
				    //Il livello attuale � minore del precedente
				    //RenderLevel diventa un livello che si combina con il livello corrente
				    if ($w->level < $preLevel){
					    if(count($renderLevel)){
						    array_push($combines, array(
							    'conds'.$iComb,
							    $renderLevel,
							    $preJRender
						    ));
						    unset($renderLevel);
						    $renderLevel=array();
						    array_push($renderLevel, 'conds'.$iComb);
						    $iComb++;
						    $preJRender=$query[$iCond-1]->junction;
					    }
				    }
			    }
		    }
		    $iCond++;
	    }
	    foreach($allconds as $cond){
		    $q->condition($cond[0],$cond[1],$cond[2]);
	    }
	    foreach($combines as $cond){
		    $q->combine($cond[1],$cond[2],$cond[0]);
	    }
	    if(1!=$last && $last){
		    if(count($renderLevel)>1){
			    $q->where($renderLevel,$preJRender,'latest');
		    }else{
			    $q->where($renderLevel);
		    }
	    }
    }

    function _populateItemsWithRelationsObjects($sourceTable,&$relations,&$itm,&$whichRelations=array()){
	    global 
		    $pnMapper,
		    $pnObject;
	    $manageRelations=count($whichRelations)>0;
	    $ret=&$itm->toArray(BasePeer::TYPE_PHPNAME,false,true);
	    //$ret=&$itm->toArray(BasePeer::TYPE_PHPNAME);
	    $as=null;
	    //$r = PnprimenoteQuery::create()->getTableMap()->getRelation($name)->getForeignTable()->getName()
	    foreach($relations as $r){
//			$ret['relations'][$r->getName()]['l']=$r->getLocalTable()->getName();
//			$ret['relations'][$r->getName()]['f']=$r->getForeignTable()->getName();
		    if(strtolower($r->getName()) != strtolower($r->getLocalTable()->getName())) {
			    if($r->getType()==RelationMap::ONE_TO_MANY){
				    if( $sourceTable == $r->getLocalTable()->getName()){
					    if($manageRelations){
						    if($whichRelations[$r->getName()]){
							    if(method_exists($itm,'get'.$r->getName().'s')){
								    eval('$as=&$itm->get'.$r->getName().'s();');
							    }
						    }
					    }else{
						    if(method_exists($itm,'get'.$r->getName().'s')){
							    eval('$as=&$itm->get'.$r->getName().'s();');
						    }
					    }
				    }else{

				    }
			    }else{
				    if($manageRelations){
					    if($whichRelations[$r->getName()]){
						    eval('$as=&$itm->get'.$r->getName().'();');
					    }	
				    }else{
					    eval('$as=&$itm->get'.$r->getName().'();');
				    }
			    }

			    if($as){
				    if($manageRelations){
					    $propName=$whichRelations[$r->getName()];
				    }else{
					    $propName=$r->getName();
				    }

				    $objName=array_keys($pnObject  , ucwords($sourceTable));
//					$ret[$propName.'_Exp']= $r->getName() . ' - ' . ucwords($sourceTable).' - ';
				    if(count($objName)){
					    $objName = $objName[0];
//						$ret[$propName.'_Exp'].=$propName . ' - ' . in_array($propName, $pnMapper[$objName]['_expand']) . ' - ' . $objName;
					    if(in_array($propName, $pnMapper[$objName]['_expand'])){

//							$ret[$propName.'_Exp'].=' - ' . $as->getPeer()->getTableMap()->getName();
						    $val=$this->_populateItemsWithRelationsObjects(
							    $as->getPeer()->getTableMap()->getName(),
							    $as->getPeer()->getTableMap()->getRelations(), 
							    $as
						    );
					    }else{
						    $val=$as->toArray(BasePeer::TYPE_PHPNAME,false,true);
					    }
				    }else{
					    $val=$as->toArray(BasePeer::TYPE_PHPNAME,false,true);
				    }
				    $ret[$propName]=$val;

				    $ret[$propName]=$val;
			    }
			    unset($as);
		    }
	    }
	    return $ret;
    }

    function populateItemsWithRelationsObjects(&$q,&$itm,&$whichRelations=array()){
	    $rs=$q->getTableMap()->getRelations();
	    $firstTable= $q->getTableMap()->getName();
	    $ret = &$this->_populateItemsWithRelationsObjects($firstTable, $rs, $itm, $whichRelations);
	    return $ret;
    }

    function getMetadata($obj){
		    global $pnMapper,$pnObject;
		    $ret = '';

		    if ($pnMapper[$obj]){
			    $q="";
			    eval('$q= '.$pnObject[$obj].'Query::create();');
			    $map =  $q->getTableMap();
			    $ret['fields']= array();

			    $rels = $map->getRelations();
			    foreach($rels as $rel){
				    $f=array();
				    $f['name']=$rel->getName();
				    $f['type']='auto';
				    array_push($ret['fields'],$f);
				    unset($f);
			    }

			    foreach($pnMapper[$obj] as $field){
				    if($field['extern']) continue;
				    $col = $map->getColumn($field['name']);
				    $f['name']=$col->getPhpName();
				    if($field['index']){
					    $ret['idProperty']=$f['name'];
				    }					

				    if(!$field['type']){
					    switch ($col->getType()){
						    case PropelColumnTypes::INTEGER:
							    switch($col->getSize()){
								    case 1:
									    $f['type']='bool';
									    $f['editor']['xtype']='checkbox';
								    break;
								    case 8:
									    $f['type']='date';
									    $f['dateFormat']='Ymd';
									    $f['editor']['xtype']='datefield';
								    break;	
								    case 6:
									    $f['type']='date';
									    $f['dateFormat']='His';
									    $f['editor']['xtype']='timefield';
								    break;
								    default:
									    $f['type']='number';
									    $f['editor']['xtype']='textfield';
								    break;
							    }
						    break;
						    case PropelColumnTypes::TINYINT:
						    case PropelColumnTypes::NUMERIC:
						    case PropelColumnTypes::BIGINT:
						    case PropelColumnTypes::DECIMAL:
						    case PropelColumnTypes::SMALLINT:								
						    case PropelColumnTypes::DOUBLE:
						    case PropelColumnTypes::FLOAT:
							    $f['type']='number';
							    $f['editor']['xtype']='textfield';
						    break;
						    case PropelColumnTypes::VARCHAR:
						    case PropelColumnTypes::LONGVARCHAR:
						    case PropelColumnTypes::CHAR:
							    $f['type']='string';
							    $f['editor']['xtype']='textfield';
						    break;
						    default:
							    $f['type']='auto';
							    $f['editor']['xtype']='textfield';
						    break;
					    }
				    }else{
					    $f['type']='auto';//$field['type'];
					    $f['editor']['xtype']='combo';
				    }
				    array_push($ret['fields'],$f);
			    }

			    return $ret;
		    }
	}
}

?>
