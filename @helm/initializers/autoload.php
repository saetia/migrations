<?
#don't waste time searching for these classics

if (function_exists('spl_autoload_register')){
	
  function __loadApps($class){
  	
  }
  
  spl_autoload_register('__loadApps');
  
} else {
	throw new Exception('spl_autoload_register does not exist.');
}
?>