<?php

class Model_databaseConnect{

	private static $instance;

	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}

	public static function connect() {

		if(!is_object(self::$instance)) {

			$dsn = DRIVER.':host='.HOST.';dbname='.DBNAME;

			try {
				self::$instance = new PDO($dsn, USER, PASS);
				self::$instance->exec("SET NAMES utf8");
				//Logger::all('тестовый лог3', __FILE__, __LINE__);
			} catch (PDOException $e) {
				Application::triggerError();
			}

		}

		return self::$instance;
	}
}