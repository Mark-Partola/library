<?php

class Ctrl_user extends Ctrl_base {

	public function login() {

		echo $this->getTemplate('users/login', null, 'Авторизация');

	}

}