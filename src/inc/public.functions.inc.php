<?php
function direct_getDirect($className,$appname){
	
	if(is_array($className)){
		$classes=$className;
	}else{
		$appname=$className;
		$classes=array($className);
	}
	session_start();
	require_once('inc/ExtDirect/API.php');
	require_once('inc/ExtDirect/CacheProvider.php');
	
	$cache = new ExtDirect_CacheProvider('tmp/cache/'.$_SESSION["usr"] . '_' . $appname .  'api_cache.txt');
	$api = new ExtDirect_API();
	$api->setRouterUrl('?op=getRouter'); // default
	$api->setCacheProvider($cache);
	$api->setNamespace('Vault'); 
	$api->setDescriptor('Vault.'.$appname. '._APIDesc');
	$api->setDefaults(array(
	    'autoInclude' => false,
	    'basePath' => 'inc'
	));
	
	foreach($classes as $className){
		if(strlen($className)<=3){
			$className = strtoupper($className);
		}else{
			$className = ucwords(strtolower($className));
		}
		// Include ExtDirect PHP Helpers
		
		$api->add(
		    array(
			$className => array('prefix' => 'Direct_')
		    )
		);
	}
	$api->output();
	$_SESSION['ext-direct-state'] = $api->getState();
}
function direct_getRouter($className,$appname){
	if(is_array($className)){
		$classes=$className;
	}else{
		$appname=$className;
		$classes=array($className);
	}
	session_start();

	require_once('inc/ExtDirect/API.php');
	require_once('inc/ExtDirect/Router.php');
	if(!isset($_SESSION['ext-direct-state'])) {
	    direct_getDirect($appname);
	}
	$api = new ExtDirect_API();
	$api->setState($_SESSION['ext-direct-state']);
	  
	$router = new ExtDirect_Router($api);
	$router->dispatch();
	$router->getResponse(true); // true to print the response instantly
}

function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
}

function iif($if,$true,$false){
	if($if){
		return $true;
	}else{
		return $false;
	}
}

function removeln($str){
	return str_replace("\n","",$str);
}

function clientGetVar($name){
	global $render;
	if($render=="html"){
		return $_COOKIE[$name];
	}
}
function clientSetVar($name,$value){
	global $render;
	if($render=="html"){
		setcookie($name,$value,null,null,$HTTP_SERVER_VARS['HTTP_HOST'],true);
	}	
}

function _getopt ( ) {

/* _getopt(): Ver. 1.2      2008/08/19
   My page: http://www.ntu.beautifulworldco.com/weblog/?p=526

Usage: _getopt ( [$flag,] $short_option [, $long_option] );

Note that another function split_para() is required, which can be found in the same
page.

_getopt() fully simulates getopt() which is described at
http://us.php.net/manual/en/function.getopt.php , including long options for PHP
version under 5.3.0. (Prior to 5.3.0, long options was only available on few systems)

Besides legacy usage of getopt(), I also added a new option to manipulate your own
argument lists instead of those from command lines. This new option can be a string
or an array such as 

$flag = "-f value_f -ab --required 9 --optional=PK --option -v test -k";
or
$flag = array ( "-f", "value_f", "-ab", "--required", "9", "--optional=PK", "--option" );

So there are four ways to work with _getopt(),

1. _getopt ( $short_option );

  it's a legacy usage, same as getopt ( $short_option ).

2. _getopt ( $short_option, $long_option );

  it's a legacy usage, same as getopt ( $short_option, $long_option ).

3. _getopt ( $flag, $short_option );

  use your own argument lists instead of command line arguments.

4. _getopt ( $flag, $short_option, $long_option );

  use your own argument lists instead of command line arguments.

*/

  if ( func_num_args() == 1 ) {
     $flag =  $flag_array = $GLOBALS['argv'];
     $short_option = func_get_arg ( 0 );
     $long_option = array ();
  } else if ( func_num_args() == 2 ) {
     if ( is_array ( func_get_arg ( 1 ) ) ) {
        $flag = $GLOBALS['argv'];
        $short_option = func_get_arg ( 0 );
        $long_option = func_get_arg ( 1 );
     } else {
        $flag = func_get_arg ( 0 );
        $short_option = func_get_arg ( 1 );
        $long_option = array ();
     }
  } else if ( func_num_args() == 3 ) {
     $flag = func_get_arg ( 0 );
     $short_option = func_get_arg ( 1 );
     $long_option = func_get_arg ( 2 );
  } else {
     exit ( "wrong options\n" );
  }

  $short_option = trim ( $short_option );

  $short_no_value = array();
  $short_required_value = array();
  $short_optional_value = array();
  $long_no_value = array();
  $long_required_value = array();
  $long_optional_value = array();
  $options = array();

  for ( $i = 0; $i < strlen ( $short_option ); ) {
     if ( $short_option{$i} != ":" ) {
        if ( $short_option{$i+1} != ":" ) {
          $short_no_value[] = $short_option{$i};
          $i++;
          continue;
        } else if ( $short_option{$i+1} == ":" && $short_option{$i+2} != ":" ) {
          $short_required_value[] = $short_option{$i};
          $i += 2;
          continue;
        } else if ( $short_option{$i+1} == ":" && $short_option{$i+2} == ":" ) {
          $short_optional_value[] = $short_option{$i};
          $i += 3;
          continue;
        }
     } else {
        continue;
     }
  }

  foreach ( $long_option as $a ) {
     if ( substr( $a, -2 ) == "::" ) {
        $long_optional_value[] = substr( $a, 0, -2);
        continue;
     } else if ( substr( $a, -1 ) == ":" ) {
        $long_required_value[] = substr( $a, 0, -1 );
        continue;
     } else {
        $long_no_value[] = $a;
        continue;
     }
  }

  if ( is_array ( $flag ) )
     $flag_array = $flag;
  else {
     $flag = "- $flag";
     $flag_array = split_para( $flag );
  }

  for ( $i = 0; $i < count( $flag_array ); ) {

     if ( $i >= count ( $flag_array ) )
        break;

     if ( ! $flag_array[$i] || $flag_array[$i] == "-" ) {
        $i++;
        continue;
     }

     if ( $flag_array[$i]{0} != "-" ) {
        $i++;
        continue;

     }

     if ( substr( $flag_array[$i], 0, 2 ) == "--" ) {

        if (strpos($flag_array[$i], '=') != false) {
          list($key, $value) = explode('=', substr($flag_array[$i], 2), 2);
          if ( in_array ( $key, $long_required_value ) || in_array ( $key, $long_optional_value ) )
             $options[$key][] = $value;
          $i++;
          continue;
        }

        if (strpos($flag_array[$i], '=') == false) {
          $key = substr( $flag_array[$i], 2 );
          if ( in_array( substr( $flag_array[$i], 2 ), $long_required_value ) ) {
             $options[$key][] = $flag_array[$i+1];
             $i += 2;
             continue;
          } else if ( in_array( substr( $flag_array[$i], 2 ), $long_optional_value ) ) {
             if ( $flag_array[$i+1] != "" && $flag_array[$i+1]{0} != "-" ) {
                $options[$key][] = $flag_array[$i+1];
                $i += 2;
             } else {
                $options[$key][] = FALSE;
                $i ++;
             }
             continue;
          } else if ( in_array( substr( $flag_array[$i], 2 ), $long_no_value ) ) {
             $options[$key][] = FALSE;
             $i++;
             continue;
          } else {
             $i++;
             continue;
          }
        }

     } else if ( $flag_array[$i]{0} == "-" && $flag_array[$i]{1} != "-" ) {

        for ( $j=1; $j < strlen($flag_array[$i]); $j++ ) {
          if ( in_array( $flag_array[$i]{$j}, $short_required_value ) || in_array( $flag_array[$i]{$j}, $short_optional_value )) {

             if ( $j == strlen($flag_array[$i]) - 1  ) {
                if ( in_array( $flag_array[$i]{$j}, $short_required_value ) ) {
                  $options[$flag_array[$i]{$j}][] = $flag_array[$i+1];
                  $i += 2;
                } else if ( in_array( $flag_array[$i]{$j}, $short_optional_value ) && $flag_array[$i+1] != "" && $flag_array[$i+1]{0} != "-" ) {
                  $options[$flag_array[$i]{$j}][] = $flag_array[$i+1];
                  $i += 2;
                } else {
                  $options[$flag_array[$i]{$j}][] = FALSE;
                  $i ++;
                }
                $plus_i = 0;
                break;
             } else {
                $options[$flag_array[$i]{$j}][] = substr ( $flag_array[$i], $j + 1 );
                $i ++;
                $plus_i = 0;
                break;
             }

          } else if ( in_array ( $flag_array[$i]{$j}, $short_no_value ) ) {

             $options[$flag_array[$i]{$j}][] = FALSE;
             $plus_i = 1;
             continue;

          } else {
             $plus_i = 1;
             break;
          }
        }

        $i += $plus_i;
        continue;

     }

     $i++;
     continue;
  }

  foreach ( $options as $key => $value ) {
     if ( count ( $value ) == 1 ) {
        $options[ $key ] = $value[0];

     }

  }

  return $options;

}

function split_para ( $pattern ) {

/* split_para() version 1.0      2008/08/19
   My page: http://www.ntu.beautifulworldco.com/weblog/?p=526

This function is to parse parameters and split them into smaller pieces.
preg_split() does similar thing but in our function, besides "space", we
also take the three symbols " (double quote), '(single quote),
and \ (backslash) into consideration because things in a pair of " or '
should be grouped together.

As an example, this parameter list

-f "test 2" -ab --required "t\"est 1" --optional="te'st 3" --option -v 'test 4'

will be splited into

-f
t"est 2
-ab
--required
test 1
--optional=te'st 3
--option
-v
test 4

see the code below,

$pattern = "-f \"test 2\" -ab --required \"t\\\"est 1\" --optional=\"te'st 3\" --option -v 'test 4'";

$result = split_para( $pattern );

echo "ORIGINAL PATTERN: $pattern\n\n";

var_dump( $result );

*/

  $begin=0;
  $backslash = 0;
  $quote = "";
  $quote_mark = array();
  $result = array();

  $pattern = trim ( $pattern );

  for ( $end = 0; $end < strlen ( $pattern ) ; ) {

     if ( ! in_array ( $pattern{$end}, array ( " ", "\"", "'", "\\" ) ) ) {
        $backslash = 0;
        $end ++;
        continue;
     }

     if ( $pattern{$end} == "\\" ) {
        $backslash++;
        $end ++;
        continue;
     } else if ( $pattern{$end} == "\"" ) {
        if ( $backslash % 2 == 1 || $quote == "'" ) {
          $backslash = 0;
          $end ++;
          continue;
        }

        if ( $quote == "" ) {
          $quote_mark[] = $end - $begin;
          $quote = "\"";
        } else if ( $quote == "\"" ) {
          $quote_mark[] = $end - $begin;
          $quote = "";
        }

        $backslash = 0;
        $end ++;
        continue;
     } else if ( $pattern{$end} == "'" ) {
        if ( $backslash % 2 == 1 || $quote == "\"" ) {
          $backslash = 0;
          $end ++;
          continue;
        }

        if ( $quote == "" ) {
          $quote_mark[] = $end - $begin;
          $quote = "'";
        } else if ( $quote == "'" ) {
          $quote_mark[] = $end - $begin;
          $quote = "";
        }

        $backslash = 0;
        $end ++;
        continue;
     } else if ( $pattern{$end} == " " ) {
        if ( $quote != "" ) {
          $backslash = 0;
          $end ++;
          continue;
        } else {
          $backslash = 0;
          $cand = substr( $pattern, $begin, $end-$begin );
          for ( $j = 0; $j < strlen ( $cand ); $j ++ ) {
             if ( in_array ( $j, $quote_mark ) )
                continue;

             $cand1 .= $cand{$j};
          }
          if ( $cand1 ) {
             eval( "\$cand1 = \"$cand1\";" );
             $result[] = $cand1;
          }
          $quote_mark = array();
          $cand1 = "";
          $end ++;
          $begin = $end;
          continue;
       }
     }
  }

  $cand = substr( $pattern, $begin, $end-$begin );
  for ( $j = 0; $j < strlen ( $cand ); $j ++ ) {
     if ( in_array ( $j, $quote_mark ) )
        continue;

     $cand1 .= $cand{$j};
  }

  eval( "\$cand1 = \"$cand1\";" );

  if ( $cand1 )
     $result[] = $cand1;

  return $result;
}

function array_mix() {
    $array = array();
    $arrays = func_get_args();
   
    foreach($arrays as $array_i) if(is_array($array_i))
        $array = array_mixer($array, $array_i);

    return $array;
}

function array_mix_recursive() {
    $array = array();
    $arrays = func_get_args();
   
    foreach($arrays as $array_i) if(is_array($array_i))
        $array = array_mixer($array, $array_i, true);

    return $array;
}

function array_mixer($array_o, $array_i, $recursive=false) {
    foreach($array_i as $k => $v) {
        if(! isset($array_o[$k])) {
            $array_o[$k] = $v;
        } else {
            if(is_array($array_o[$k])) {
                if(is_array($v)) {
                    if($recursive) $array_o[$k] = array_mixer($array_o[$k], $v);
                    else $array_o[$k] = $v;
                } else $array_o[$k][] = $v;
            } else {
                if(! isset($array_o[$k])) {
                    $array_o[$k] = $v;
                } else {
                    $array_o[$k] = array($array_o[$k]);
                    $array_o[$k][] = $v;
                }
            }
        }
    }
   
    return $array_o;
}

function mime_header_encode($string) {
  if (preg_match('/[^\x20-\x7E]/', $string)) {
    $chunk_size = 47; // floor((75 - strlen("=?UTF-8?B??=")) * 0.75);
    $len = strlen($string);
    $output = '';
    while ($len > 0) {
      $chunk = truncate_utf8($string, $chunk_size);
      $output .= ' =?UTF-8?B?'. base64_encode($chunk) ."?=\n";
      $c = strlen($chunk);
      $string = substr($string, $c);
      $len -= $c;
    }
    return trim($output);
  }
  return $string;
}


//if (!function_exists('str_getcsv')) {
 
function str_rowgetcsv($input, $delimiter=',', $enclosure='"', $escape=null, $eol=null) {
  $temp=fopen("php://memory", "rw");
  fwrite($temp, $input);
  fseek($temp, 0);
  $r = array();
  while (($data = fgetcsv($temp, 4096, $delimiter, $enclosure)) !== false) {
    $r[] = $data;
  }
  fclose($temp);
  return $r;
}
 
//}
?>