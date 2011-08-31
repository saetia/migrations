<?
header('Content-type: text/html; charset=utf-8');

date_default_timezone_set("UTC");


set_exception_handler(function($Exception){

	if (class_exists('Console')){
		Console::error($Exception);
	} else {
		if (!headers_sent()) {
			header('Location: /@helm/views/uncaught_exception.html');
		}
	}
	
});


if (version_compare(PHP_VERSION, '5.3.0', '<')) exit('PHP '.PHP_VERSION.' is not compatible, upgrade to version 5.3 or better.');

#so we can use relative paths to this init file

$helm = __DIR__;

Class Root {
	public function getRoot(){
		#only wastes time when no server vars exist
		if (!empty($_SERVER['DOCUMENT_ROOT'])){ return $_SERVER['DOCUMENT_ROOT']; }
		$p = array();
		foreach (explode('/',__FILE__) as $e){
			$p[] = $e;
			if ($e === 'httpdocs'){ return join('/',$p); }
		}
	}
}


try {
	

	require_once($helm.'/models/config.php');
	require_once($helm.'/models/yaml.php');

	#run any dynamic configuration
	include_once($helm.'/config/dynamic.php');


	#load all of helm's yaml configurations
	foreach (glob($helm.'/config/*.yml') as $yml) Config::import_yaml($yml);

} catch (Exception $e){
	echo $e->getMessage();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", Config::get('path.root').'errors.log');

?>