<?php
require_once 'inc/public.functions.inc.php';

	function createUpdateStatement($table,$fields,$unique,$obj){	
		foreach($fields as $i=>$field){
			$unq = in_array($field,$unique); 
			
			if($i == 0){
				$f = "(";
				$v = "(";
				$u = "";
				$w = "";
			}else{
				$f .= ", ";
				$v .= ", ";
			}
			$vtmp = mysql_escape_string($obj[$field]);
			$f .= $field;
			$v .= "'" . $vtmp . "'";
			if($unq){
				if($w) $w .= " and ";
				$w .= $field . " = '" . $vtmp . "'";
			}else{
				if($u) $u .= ", ";
				$u .= $field . " = '" . $vtmp . "'";
			}
		}
		
		$f .= ")";
		$v .= ")";
		
		$w = iif($w, " where " . $w,"");
		//per sicurezza;
		if($w){
			$ret["insert"] = "insert into " . $table . " " . $f . " values " . $v;
			$ret["select"] = "select * from " . $table . $w;
			$ret["update"] = "update " . $table . " set " . $u . $w;
		}
		return $ret;
	}
	
	function insertOrUpdate($sql,$db){
		$rs = $db->Execute($sql["select"]);
		if(count($rs->GetArray())){
			 $db->Execute($sql["update"]);
		}else{
			$db->Execute($sql["insert"]);
		}
	}
	
	function createUpdateFunction($table,$varname,$db){
		$rs = $db->Execute("SHOW COLUMNS FROM " . $table);
		$fields=$rs->GetArray();
		$rs->close();
		
		$f = "";
		$v = "";
		$u = "";
		foreach($fields as $i=>$field){
			print_r($field);
			echo "<br/>";
			 
			
			if($f){
				$f .= ", ";
				$v .= ", ";
			}

			$f .= "'" . $field["Field"] . "'";
			$v .= "'" . $field["Field"] . "' => " . $varname . "['" . $field["Field"] . "']";
			if($field["Key"]=="PRI"){
				if($u) $u .= ", ";	
				$u .= "'" . $field["Field"] . "'";
			}
		}
		
		$f .= ")";
		$v .= ")";
		$u .= ")";
		
		return "\$sql = createUpdateStatement('" . $table . "', array(" . $f . ", array(" . $u . ", array(" . $v .");<br/>".
				"insertOrUpdate(\$sql,\$this->db);<br/>";
	}
?>