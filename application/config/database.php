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
	Logger::all('тестовый лог3', __FILE__, __LINE__);
} catch (PDOException $e) {
	Application::triggerError();
}


?>