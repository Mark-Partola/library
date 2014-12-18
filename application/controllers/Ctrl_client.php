<?php


class Ctrl_client extends Ctrl_base {

	private $model;

	public function addBook($book_id){

		if(!isAjax())	return false;

		if(!isset($_SESSION['user'])) return false;

		$this->model = new Model_user();

		$result = $this->model->addBook($book_id, $_SESSION['user']['id']);

		if($result === true) echo 'Успешно добавлено!';
		elseif($result === 0) echo 'Уже было добавлено!';
		else echo 'Произошла ошибка!';

	}

}