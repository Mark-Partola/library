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
		require_once __DIR__.'/bootstrap.php';
		self::getInstance();
	}

	//метод обработки всех запросов за один раз
	private function i_run() {
		foreach($this->requests as &$request) {

			$done = $request->run();
			if($done)	return true;
		}

		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
		header('Location:'.ROUTE_ROOT.'/errors?status=404');
	}

	public static function run() {
		return Application::getInstance()->i_run();
	}

	public static function triggerError($status = 1000){
		$_GET['status'] = $status;
		include($_SERVER['DOCUMENT_ROOT'].ROUTE_ROOT.'/tpl/errors/error.php');
		exit;
	}

}
/*
class Logger{
	public static function All($message){
		file_put_contents(filename, data)
	}
}*/