<?
$ruckusing_db_config = array(
	
  'development' => array(
	  'type'      => 'mysql',
	  'host'      => (!Config::get('db.development.host')) ? 
								'127.0.0.1' : Config::get('db.development.host'),
	  'port'      => Config::get('db.development.port'),
	  'database'  => Config::get('db.development.name'),
	  'user'      => Config::get('db.development.user'),
	  'password'  => Config::get('db.development.pw')
	),

	'test' 					=> array(
    'type'      => 'mysql',
    'host'      => (!Config::get('db.test.host')) ? 
										'127.0.0.1' : Config::get('db.test.host'),
    'port'      => Config::get('db.test.port'),
    'database'  => Config::get('db.test.name'),
    'user'      => Config::get('db.test.user'),
    'password'  => Config::get('db.test.pw')
	),
	
  'production' => array(
    'type'      => 'mysql',
    'host'      => (!Config::get('db.production.host')) ? 
										'127.0.0.1' : Config::get('db.production.host'),
    'port'      => Config::get('db.production.port'),
    'database'  => Config::get('db.production.name'),
    'user'      => Config::get('db.production.user'),
    'password'  => Config::get('db.production.pw')
  ),
	
);

?>