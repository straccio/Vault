<?php

class BogusAction {
    public $action;
    public $method;
    public $data;
    public $tid;
}

class ExtDirect_Router {
        public $data = null;
        public $isForm = false;
        public $isUpload = false;
        
        private $_response = null;
        
        public function __construct($api) {
            $this->setAPI($api);
            $this->parseRequest();
        }
        
        public function setAPI($api) {
            if(!($api instanceof ExtDirect_API)) {
                throw new Exception('setAPI expects an instance of ExtDirect_API');
            }
            
            $this->_api = $api;
        }
        
        public function parseRequest() {
            if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){
                $this->data = json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
            }
            else if(isset($_POST['extAction'])){ // form post
                $this->isForm = true;
                $this->isUpload = $_POST['extUpload'] == 'true';
                
                $data = new BogusAction();
                $data->action = $_POST['extAction'];
                $data->method = $_POST['extMethod'];
                $data->tid = $_POST['extTID'];
                $data->data = array($_POST, $_FILES);
                
                $this->data = $data;
            }
            else {
                die('Invalid request.');
            }
        }
        
        public function dispatch() {
            if(isset($this->_response)) return;
            
            $response = null;
            $output = '';
            if(is_array($this->data)){
                $response = array();
                foreach($this->data as $d){
                        $response[] = $this->rpc($d);
                }
            }else{
                $response = $this->rpc($this->data);
            }
            
            if($this->isForm && $this->isUpload){
                //$json = json_encode($this->json_fix_charset($response));
                $json = json_encode($response);
                $json = preg_replace("/&quot;/", '\\&quot;', $json);
                
                $output .= '<html><body><textarea>';
                $output .= $json;
                $output .= '</textarea></body></html>';
            }else{
                $output = json_encode($this->json_fix_charset($response));
                //$output = json_encode($response);
            }
            
            $this->_response = $output;                
            return $output;
        }
        
        public function rpc($cdata) {
        	global 
        		$currentUser;
        		
        	$doc="";
            $classes = $this->_api->getClasses();
            try {
                if(!isset($classes[$cdata->action])){
                    throw new Exception('Call to undefined class: ' . $cdata->action);
                }
                
                $class = $cdata->action;
                $method = $cdata->method;
                
                $cconf = $classes[$class];
                $mconf = null;
                
                $classPath = isset($cconf['fullPath']) 
                    ? $cconf['fullPath'] 
                    : $this->_api->getClassPath($class, $cconf);
                    
                require_once($classPath);
                $parsedAPI = $this->_api->getParsedAPI();

                if(!empty($parsedAPI) && isset($parsedAPI['actions'][$class])) {
                    foreach($parsedAPI['actions'][$class] as $m) {
                        if($m['name'] === $method) {                            
                            $mconf = $m;
                            $serverMethod = isset($m['serverMethod']) ? $m['serverMethod'] : $method;
                            $rClass = new ReflectionClass($cconf['prefix'] . $class);
                            $doc=$rClass->getMethod($serverMethod)->getDocComment();
                            break;
                        }
                    }
                }
                else {
                    // do some very simple reflection on the class to check if the method is allowed
                    $rClass = new ReflectionClass($cconf['prefix'] . $class);
                    if(!$rClass->hasMethod($method)) {
                        $rMethods = $rClass->getMethods();
                        foreach($rMethods as $rMethod) {
                            $doc = $rMethod->getDocComment();
                            if(
                                $rMethod->isPublic() &&
                                strlen($doc) > 0 &&
                                !!preg_match('/' . $this->_remoteAttribute . '/', $doc) &&
                                !!preg_match('/' . $this->_nameAttribute . ' ([w]+)/', $doc, $matches) &&
                                $method === $matches[1]
                            ) {
                                $serverMethod = $rMethod->getName();
                                $mconf = array(
                                    'name' => $method,
                                    'len' => $rMethod->getNumberOfRequiredParameters(),
                                );
                                if(!!preg_match('/' . $this->_api->getFormAttribute() . '/', $doc)) {
                                    $mconf['formHandler'] = true;
                                }                              
                            }
                        }
                        if(!$serverMethod) {
                            throw new Exception("Call to undefined method: $method on class $class");
                        }                        
                    } else {
                        $rMethod = $rClass->getMethod($method);
                        $doc = $rMethod->getDocComment();
                        if($rMethod->isPublic() && strlen($doc) > 0) {
                            if(!!preg_match('/' . $this->_api->getRemoteAttribute() . '/', $doc)) {
                                $serverMethod = $method;
                                $mconf = array(
                                    'name' => $method,
                                    'len' => $rMethod->getNumberOfRequiredParameters(),
                                );
                                if(!!preg_match('/' . $this->_api->getFormAttribute() . '/', $doc)) {
                                    $mconf['formHandler'] = true;
                                }
                            }            
                        }                        
                    }
                }
                
                if(!isset($mconf)) {
                    throw new Exception("Call to undefined or unallowed method: $method on class $class");
                }
                
                if($this->isForm && (!isset($mconf['formHandler']) || $mconf['formHandler'] !== true)) {
                    throw new Exception("Called method $method on class $class is not a form handler");
                }
                
                $params = isset($cdata->data) && is_array($cdata->data) ? $cdata->data : array();
                $params = $this->json_fix_charset($params,false);
                if(count($params) < $mconf['len']) {
                    throw new Exception("Not enough required params specified for method: $method on class $class");
                }
                
                preg_match('/' . '@acl' . ' ?([\w\.]*,?\ ?)?/', $doc, $matches);
                if(count($matches)==0 || $currentUser['directAuths'][$class . '.' . $matches[1] ]){
	                $response = array(
	                    'type' => 'rpc',
	                    'tid' => $cdata->tid,
	                    'action' => $class,
	                    'method' => $method
	                );
	                
	                $className = $cconf['prefix'] . $class;
	                $instance = new $className();
	                $response['result'] = call_user_func_array(array($instance, $serverMethod), $params);
                }else{
                	$response = array(
	                    'type' => 'exception',
	                    'tid' => $cdata->tid,
	                    'message' => 'NOAUTH',
                    	'where' =>''
	                );
                }
                
/*                
                if($instance.auth){
                	if(call_user_func_array(array($instance, 'auth'), false)!=false){
                		$response['result'] = call_user_func_array(array($instance, $serverMethod), $params);
                	}else{
                		$response=array(
                			'type'=>'rpc',
                			'tid'=>$cdata->tid,
                			'action' => $class,
                    		'method' => $method,
                			'result'=>array(
                				'success'=>false,
                				'failureCode'=>'AUTH'
                			)
                		);
                	}
                }
*/                
            } catch(Exception $e) {
                $response = array(
                    'type' => 'exception',                    
                    'tid' => $cdata->tid,
                    'message' => $e->getMessage(),
                    'where' => $e->getTraceAsString()
                );
            }
            
            return $response;
        }
        
		function json_fix_charset($var,$response=true)
		{
		    if (is_array($var)) {
		        $new = array();
		        foreach ($var as $k => $v) {
		            $new[$this->json_fix_charset($k)] = $this->json_fix_charset($v,$response);
		        }
		        $var = $new;
		    } elseif (is_object($var)) {
		        $vars = get_class_vars(get_class($var));
		        foreach ($vars as $m => $v) {
		            $var->$m = $this->json_fix_charset($v,$response);
		        }
		    } elseif (is_string($var)) {
		    	if($response){
		        	$var = iconv('ISO-8859-1','UTF-8//TRANSLIT',$var);
		    	}else{
		    		$var = iconv('UTF-8','ISO-8859-1//TRANSLIT',$var);
		    	} 
		    }
		    return $var;
		}
        
        public function getResponse($print = false) {
            if(!$this->_response) {
                $this->dispatch();
            }
            
            if($print !== false) $this->_print($this->_response);
            
            return $this->_response;
        }
        
        private function _print($response) {
            if(!$this->isForm) {
                header('Content-Type: text/javascript;');
            }
    
            echo $response;
        }
}