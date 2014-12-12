<?php

/*require __DIR__.'/../models/IndexModel.php';*/

class Ctrl_index extends BaseController {

	private $template; // сгенерированный шаблон

	public function __construct() {/*
		$this->model = new IndexModel();*/
	}

	public function index(){/*
		$test = $this->model->select("SELECT * FROM `users` WHERE `id` = 1");

		//когда одна строка, все равно приходит двумерный массив, поэтому обращаемся так.
		$title = $test[0]['name'];
*/
		//генерация, сначала загружаем хедер и футер, потом их передаем в индекс
		$title = "тест";
		$header = $this->generateTemplate('header', array('title' => $title));
		$footer = $this->generateTemplate('footer');
		$this->template = $this->generateTemplate('index', array('header' => $header, 'footer' => $footer));

		echo $this->template;
	}

	public function post(){
		//добавить что-то типа фильтра с какой страницы пришел
		var_dump($_POST);
	}

	public function getNew() {
		$header = $this->generateTemplate('header', array('title' => 'Тест'));
		$footer = $this->generateTemplate('footer');
		$this->template = $this->generateTemplate('test', array('header' => $header, 'footer' => $footer));

		echo $this->template;
	}

	public function err() {

		$this->template = $this->generateTemplate('errors/error');

		echo $this->template;
	}

/*	public function hi(){
		$args = func_get_args()[0];
		echo 'hello ' . $args['name'];
		echo 'hello ' . $args['id'];
	}*/
}