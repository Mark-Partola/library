<?php


class Ctrl_client extends Ctrl_base {

	private $model;

	public function addBook($book_id){

		if(!isAjax())	return false;

		if(!isset($_SESSION['user']['auth'])) {
			echo 'Для этого действия нужно авторизоваться!';
			return true;
		}

		$this->model = new Model_user();

		$result = $this->model->addBook($book_id, $_SESSION['user']['id']);

		if($result === true) echo 'Успешно добавлено!';
		elseif($result === 0) echo 'Уже было добавлено!';
		else echo 'Произошла ошибка!';

	}

	public function delBook($book_id){

		if(!isAjax())	return false;

		if(!isset($_SESSION['user'])) return false;

		$this->model = new Model_user();

		$result = $this->model->delBook($book_id, $_SESSION['user']['id']);

		if($result === true) echo 'Успешно удалено!';
		elseif($result === 0) echo 'Нет такого заказа!';
		else echo 'Произошла ошибка!';

	}

}