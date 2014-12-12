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
			if($done) {
				RequestLogger::log('Request', $request->method, $request->path);
				return true;
			}
		}

		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
		header('Location:'.ROUTE_ROOT.'/errors?status=404');
	}

	public static function run() {
		return Application::getInstance()->i_run();
	}

	public static function triggerError($status = 1000){
		$_GET['status'] = $status;
		include(DOCUMENT_ROOT.'/public/tpl/errors/error.php');
		exit;
	}

}

class Logger{

	/*private static $instance = null;

	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}
/*
	public static function init(){
		if(!self::$instance){
			self::$instance = new self;
		}
		return self::$instance;
	}
*/
	public function all($message, $file=null, $line=null){

		$arr = array();

		$arr[] = date("F-j-Y g:i:s a",time()) . "\t|\t";
		$arr[] = $message . "\t\t|\t";
		//$arr[] = 'File = '.$file . "\t\t\t|\t";
		//$arr[] = 'Line = '.$line . "\t\n";

		return $arr;
		//file_put_contents(DOCUMENT_ROOT.'/application/logs/all.log', $arr, FILE_APPEND);

	}
}

class RequestLogger extends Logger{
	public static function log($message, $method, $path){
		$arr = parent::all($message);
		$arr[] = $method."\t|\t";
		$arr[] = $path."\t|\t";
		$arr[] = $_SERVER['REMOTE_ADDR']."\n";

		//print_arr($arr);

		file_put_contents(DOCUMENT_ROOT.'/application/logs/request.log', $arr, FILE_APPEND);
	}
}