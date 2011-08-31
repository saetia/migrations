<?
Config::set('path.root',(!empty($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : dirname(dirname(dirname(__FILE__)))).'/');
?>