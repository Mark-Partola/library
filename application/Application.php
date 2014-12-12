<?php

class Application {

	public $requests = array();

	protected static $instance;

	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}

	public static function getInstance() {

		if(!is_object(self::$instance)) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function init() {
		self::getInstance();
	}

	//метод обработки всех запросов за один раз
	private function i_run() {
		foreach($this->requests as &$request) {

			$done = $request->run();
			if($done)	return true;
		}

		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
		header('Location: /library/public/errors?status=404');
	}

	public static function run() {
		return Application::getInstance()->i_run();
	}

}