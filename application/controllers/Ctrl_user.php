<?php

class Ctrl_user extends Ctrl_base {

	private $model;

	public function login() {

		echo $this->getTemplate('users/login', null, 'Авторизация');

	}

	public function logout() {

		$this->model = new Model_user();
		$this->model->logout();

	}

	public function authorize() {

		$this->model = new Model_user();

		$login = clear_str($_POST['login']);
		$password = md5(clear_str($_POST['password']));

		$this->model->login($login, $password);

	}

	public function profile() {

		$this->model = new Model_user();

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		$user = $this->model->getUserProfile($_SESSION['user']['id']);

		$books = $this->model->getUserBooks($_SESSION['user']['id']);

		//$profile = array_merge($user, $books);

		$header = $this->generateTemplate('header', array('title' => 'Моя страница'));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('users/profile', array('header' => $header, 'footer' => $footer, 'books' => $books, 'user' => $user));

		echo $this->template;


		//echo $this->getTemplate('users/profile', array('profile' => $profile), 'Моя страница');

	}

}