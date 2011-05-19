<?php
	class Propel_Helper{
		function search($obj,$query,$start,$limit,$sort,$dir){
			global $pnMapper,$pnObject;
			if ($pnMapper[$obj]){

					eval('$q='.$pnObject[$obj].'Query::create();');
	 
					eval('$map= new '.$pnObject[$obj].'TableMap();');
	/* METADATI NON SUPPORTATI DA Ext.Direct				
					$ret['metadata']=$this->getMetadata($obj);
					$ret['metadata']['root']='data';
					$ret['metadata']['totalProperty']='count';
					$ret['metadata']['successProperty']='success';
	*/				
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
					
					$this->setJoinsToQuery($q);
					
					$this->parseQueryObjectAndSetToQuery($q,$query,$obj);
												
					
					$ret['sql']=$q->toString();
					//$ret['query']=&$query;
					
					$p=$q->find();
					$ret["data"]=array();
					foreach($p as &$itm){
						array_push($ret["data"],$this->populateItemsWithRelationsObjects($q,$itm));	
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
			
			if(1==$last){
				$q->where($where,$w->value);
				break;
			}else{
				$cond = array('cond'.$i,$where,$w->value);
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
					//$preJ=$w->junction;
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
			$q->condition($cond[0],$cond[1],$cond[2]);
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
		
	function populateItemsWithRelationsObjects(&$q,&$itm,&$whichRelations=array()){
		$rs=$q->getTableMap()->getRelations();
		$ret=array();
		$manageRelations=count($whichRelations)>0;
		//foreach($data as &$itm){
			$topush=&$itm->toArray(BasePeer::TYPE_PHPNAME,false,true);
			foreach($rs as $r){
				$asd= new PnanacommittentiQuery();
				//$asd->getTableMap()
				if( $q->getTableMap()->getName() == $r->getLocalTable()->getName()){
					$as="";
					if($r->getType()==RelationMap::ONE_TO_MANY){
						if($manageRelations){
							if($whichRelations[$r->getName()]){
								if(method_exists($itm,'get'.$r->getName().'s')){
									eval('$as=&$itm->get'.$r->getName().'s();');
								}else{
									//eval('$as=&$itm->get'.str_replace('RelatedBy','sRelatedBy',$r->getName()).'();');
									$as='';
								}	
							}
						}else{
							if(method_exists($itm,'get'.$r->getName().'s')){
								eval('$as=&$itm->get'.$r->getName().'s();');
							}else{
								//eval('$as=&$itm->get'.str_replace('RelatedBy','sRelatedBy',$r->getName()).'();');
								$as='';
							}
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
							$topush[$whichRelations[$r->getName()]]=$as->toArray();
						}else{
							$topush[$r->getName()]=$as->toArray();
						}
						if($q->getTableMap()->getName()!=$r->getForeignTable()->getName()){
							$rrs=$r->getForeignTable()->getRelations();
							foreach($rrs as $rr){
								if($r->getForeignTable()->getName() == $rr->getLocalTable()->getName()){
									if(
										$q->getTableMap()->getName()!= $rr->getForeignTable()->getName() && 
										$q->getTableMap()->getName()!= $rr->getLocalTable()->getName()
									){
										$as2='';
										if($rr->getType()==RelationMap::ONE_TO_MANY){
											if(method_exists($as,'get'.$rr->getName().'s')){
												eval('$as2=$as->get'.$rr->getName().'s();');
											}else{
												$as2='';
											}
										}else{
											eval('$as2=$as->get'.$rr->getName().'();');
										}
										if($as2){
											if($manageRelations){
												$topush[$whichRelations[$r->getName()]][$rr->getName()]=$as2->toArray();
											}else{
												$topush[$r->getName()][$rr->getName()]=$as2->toArray();
											}
										}
									}
								}
							}
						}
						
					}
				}
			}
			//array_push($ret,$topush);

//		}
		return $topush;
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