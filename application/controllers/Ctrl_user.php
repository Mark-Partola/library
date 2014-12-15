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

		if(!$_SESSION['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
		} else {
			$user = $this->model->getUserProfile($_SESSION['auth']);
			print_arr($user);
		}

	}

}