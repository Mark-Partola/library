<?php

class DatabaseConnect{

	private static $instance;

	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}

	public static function connect() {

		if(!is_object(self::$instance)) {
			self::$instance = new PDO("mysql:host=localhost;dbname=newshopping", 'root', '123');
		}

		return self::$instance;
	}
}