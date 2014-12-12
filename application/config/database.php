<?php

define('HOST', 'localhost');
define('DRIVER', 'mysql');
define('USER', 'root');
define('PASS', '123');
define('DBNAME', 'library');
define('CHARSET', 'utf8');

$dsn = DRIVER.':host='.HOST.';dbname='.DBNAME;

try {
	$db = new PDO($dsn, USER, PASS);
} catch (PDOException $e) {
	Application::triggerError();
}


?>