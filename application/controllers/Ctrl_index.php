<?php

/*require __DIR__.'/../models/IndexModel.php';*/

class Ctrl_index extends Ctrl_base {

	private $template; // сгенерированный шаблон
	private $model;

	public function index(){

		$this->model = new Model_index();


		$books = $this->model->getBooks();

		//print_arr($books);

		//генерация, сначала загружаем хедер и футер, потом их передаем в индекс
		$title = "тест";
		$header = $this->generateTemplate('header', array('title' => $title));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('index', array('header' => $header, 'footer' => $footer, 'books' => $books));

		echo $this->template;
	}

	public function err() {

		$this->template = $this->generateTemplate('errors/error');

		echo $this->template;
	}

	public function getBook($args) {
		extract($args);

		$this->model = new Model_index();

		$book = $this->model->getBook($id);

		$title = "тест";
		$header = $this->generateTemplate('header', array('title' => $title));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('book', array('header' => $header, 'footer' => $footer, 'book' => $book));

		echo $this->template;
	}

/*	public function hi(){
		$args = func_get_args()[0];
		echo 'hello ' . $args['name'];
		echo 'hello ' . $args['id'];
	}*/
}