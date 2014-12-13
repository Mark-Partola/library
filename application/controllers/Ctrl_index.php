<?php

/*require __DIR__.'/../models/IndexModel.php';*/

class Ctrl_index extends Ctrl_base {

	private $template; // сгенерированный шаблон
	private $model;

	public function __construct() {
		
	}

	public function index(){

		$this->model = new Model_index();


		$books = $this->model->select();

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