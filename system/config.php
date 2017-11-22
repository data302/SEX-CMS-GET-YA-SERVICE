<?php

define('HOME', $_SERVER['DOCUMENT_ROOT']);
define('URL', 'http://'. $_SERVER['HTTP_HOST']);
require_once(HOME .'/system/db_connect.php');
mysql_connect($mysql['host'], $mysql['user'], $mysql['pass']) or die('Невозможно подключиться к MySQL серверу');
mysql_select_db($mysql['base']) or die('Невозможно подключиться к базе данных');
mysql_query("SET NAMES utf8");
ini_set('error_reporting', 7);


$dir = opendir(HOME .'/system/functions/');
while ($file = readdir($dir)) {
if (preg_match('/\.php$/i', $file)) require_once(HOME .'/system/functions/'. $file); 
}

?>