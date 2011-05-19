<?php
require_once('inc/AppDefault/appdefault.inc.php');
/**
 * Description of AppDefault
 *
 * @author straccio
 */
class AppDefault {
    var 
        $noAuth,
        $appname,
        $approot,
        $directClasses,
        $directClassName,
        $propelApps,
        $debug;
    
    //put your code here
    
    private function initApp(){
        $this->appname=  get_class($this) ;
        $this->approot='apps/'.strtolower($this->appname);
        $this->propelApps=array();
    }
    
    public function __construct($useDirect,$usePropel) {        
        $this->initApp();
        if($useDirect==true){
            $this->initDirect();
        }
        if($usePropel){
            $this->initPropel($this->propelApps);
        }		
    }
    
    private function initDirect($directApps=array()){
        $this->directClasses=array_merge(array($this->appname),$directApps);//`,'sheller');
        $this->directClassName = $this->appname;
    }
    
    private function initPropel($propelApps=array()){
        global 
            $root;
        
        $include_path=get_include_path();
        $include_path.=PATH_SEPARATOR . $root . '/'.$this->approot.'/propel/build/classes/';
        foreach ($propelApps as $app){
            $include_path.=PATH_SEPARATOR . $root . '/apps/'.$app.'/propel/build/classes/';
        }
        set_include_path($include_path);
        Propel::init($this->approot.'/propel/build/conf/'.  strtolower($this->appname) .'-conf.php');
    }
    
    
    
    public function execute($params){
        $this->onBeforeExecute(&$params);
        if($params['op']){
            include $this->approot.'/inc/acts/'.$params['op'].'act.php';
        }
        $this->onAfterExecute(&$params);
    }


    public function render($type){
        global
            $smarty;

        $this->onBeforeRender();
        $this->assignSmartyDefaults();  
        if(!$type) return false;
        
        $p = &$this->params;
        $tpl='';
        switch ($type) {
            case 'mobile':
            case 'web':
                $tpl='web';

                break;
            case 'sh':
                $tpl='sh';
                break;
            default:
                break;
        }
        
        switch ($params['op']) {
            case "getDirect":
                    $this->getDirect();
                    
            break;
            case "getRouter":
                    $this->getRouter();
                    
            break;

            default:
                if($this->debug){
                        $content .=$smarty->fetch($this->approot.'/tpl/'.$tpl.'/index.tpl');
                }else{
                        $content .=$smarty->fetch($this->approot.'/tpl/'.$tpl.'/build-index.tpl');
                }
                echo $content;
            break;
        }
        $this->onAfterRender();
    }
    
    
    function auth(){
        return true;
    }
    
    private function isDebug(){
        if($this->params['debug']){
                $this->debug=true;
        }else{
                $this->debug=false;
        }
        return $this->debug;
    }
    
    private function requireDirect(){
        foreach($this->directClasses as $className){
            require_once 'apps/'.$className.'/inc/' . strtolower($className).'.direct.php';
        }
    }
    private function getDirect(){
        direct_getDirect($this->directClasses,$this->directClassName);
    }
    private function getRouter(){
        direct_getRouter($this->directClasses ,$this->directClassName );
    }
    private function assignSmartyDefaults(){
        global
            $smarty;
        $smarty->assign('appname',$this->appname);
        $smarty->assign('approot',$this->approot);
    }
    
    
    //Event onAuth
    function onAuth($user){
        
    }
    
    //Event Before Render
    function onBeforeRender(){
        
    }
    
    //Event Before Render
    function onAfterRender(){
        
    }
    
    //Event After Execute
    function onAfterExecute($params){
        
    }
    
    //Event Before Execute
    public function onBeforeExecute($params){
        if(!$this->noAuth) {
            if(!$this->auth()){
                    header('HTTP/1.1 403 Forbidden');
                    exit;
                    return null;
            }
        }
        $this->params = $params;
        
        $this->isDebug();
    }
    
}

?>
