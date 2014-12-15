<?php

class Ctrl_user extends Ctrl_base {

	private $model;

	public function login() {

		echo $this->getTemplate('users/login', null, 'Авторизация');

	}

	public function checkAuth() {

		$this->model = new Model_user();

		$login = clear_str($_POST['login']);
		$password = md5(clear_str($_POST['password']));

		$this->model->auth($login, $password);

	}

	public function account($id) {
		echo $id;
	}

}