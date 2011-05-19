<?php
/**
 * *** BEGIN LICENSE BLOCK *****
 * 
 * Software License Agreement (New BSD License)
 * 
 * Copyright (c) 2008, Christoph Dorn
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 * 
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 * 
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 * 
 *     * Neither the name of Christoph Dorn nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * ***** END LICENSE BLOCK *****
 * 
 * @copyright   Copyright (C) 2008 Christoph Dorn
 * @author      Christoph Dorn <christoph@christophdorn.com>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 */

require_once('FirePHPCore/fb.php');

class Debug
{
  
  protected static $firephp = null;
  protected static $enabled = false;
  protected static $state = null;
  protected static $messages = array();
  protected static $startTime = null;
  
  public static function init()
  {
    self::$firephp = FirePHP::getInstance(true);
    self::$state = (array)json_decode(str_replace('\\"','"',$_COOKIE['FirePHP']));
    register_shutdown_function(array('Debug','finalize'));
    ob_start();
    self::$startTime = microtime(true);
  }
  
  public static function finalize()
  {
    if(!self::$enabled ||
       !self::getOption('_Enabled')) return;
  
    $endTime = microtime(true);
  
    $executionInfo = array();  
    
    if(self::getOption('ExecutionTime')) {
      $executionInfo[] = array(round($endTime-self::$startTime,5), 'Execution Time');
    }
    if(self::getOption('IncludedFiles')) {
      $executionInfo[] = array(get_included_files(), 'Included Files');
    }
    if(self::getOption('ServerInfo')) {
      $executionInfo[] = array($_SERVER, 'Server Info');
    }
    if(self::getOption('Cookies')) {
      $executionInfo[] = array($_COOKIE, 'Cookies');
    }
    
    foreach( self::$messages as $group => $messages ) {

      self::$firephp->group($group);
    
      foreach( $messages as $message ) {
        
        switch($message[2]) {
          case 'group':
            self::$firephp->group($message[1]);
            break;
          case 'groupEnd':
            self::$firephp->groupEnd();
            break;
          case 'info':
            self::$firephp->info($message[0], $message[1]);
          break;
          case 'log':
          default:
            self::$firephp->log($message[0], $message[1]);
            break;
        }
      }

      self::$firephp->groupEnd();
    }
    
    if($executionInfo) {
	    self::$firephp->group('Execution Information');
	    
	    foreach( $executionInfo as $message ) {
	      self::$firephp->log($message[0], $message[1]);
	    }
	
	    self::$firephp->groupEnd();
    }
  }
  
  public static function setEnabled($Enabled)
  {
    self::$enabled = $Enabled;
  }
  
  public static function log($Group, $Label, $Value)
  {
    if(!self::$enabled) return false;
  
    if(!self::getOption($Group)) return false;
    
    self::$messages[$Group][] = array($Value, $Label, 'log');
  }
  
  public static function info($Group, $Label, $Value)
  {
    if(!self::$enabled) return false;
  
    if(!self::getOption($Group)) return false;
    
    self::$messages[$Group][] = array($Value, $Label, 'info');
  }
  
  public static function group($Group, $Label)
  {
    if(!self::$enabled) return false;
  
    if(!self::getOption($Group)) return false;
    
    self::$messages[$Group][] = array('', $Label, 'group');
  }
    
  public static function groupEnd($Group)
  {
    if(!self::$enabled) return false;
  
    if(!self::getOption($Group)) return false;
    
    self::$messages[$Group][] = array('', '', 'groupEnd');
  }
  
  public static function getOption($name)
  {
    if(!self::$enabled) return false;
  
    if(!self::$state
      || !is_array(self::$state)
      || !isset(self::$state[$name])
      || !self::$state[$name]) return false;
    
    return true;
  }

}
