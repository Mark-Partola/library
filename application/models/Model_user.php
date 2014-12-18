<?php

//require 'Model_abstractDb.php';

class Model_user extends Model_abstractDb {

	public function login($login, $pass) {

		$sql = "SELECT `id`, `role`
					FROM `lib_users`
						WHERE `login` = :login
							AND `password` = :pass";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetch();

		if($result['id']) {
			$_SESSION['user']['auth'] = true;
			$_SESSION['user']['id'] = $result['id'];
			$_SESSION['user']['role'] = $result['role'];
			header('Location: '.ROUTE_ROOT."/profile/");
		} else {
			$_SESSION['user'] = false;
			header('Location: '.ROUTE_ROOT.'/login');
		}

	}

	public function logout() {

		$_SESSION['user'] = false;

		if(!isAjax()) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit();
		}
	}

	public function getUserProfile($id){

		$sql = "SELECT	`id`, 
						`fname`,
						`lname`,
						`birthday`,
						`phone`,
						`photo`,
						`limit`,
						`description`,
						`patronymic`,
						`email`
					FROM `lib_users`
					WHERE `id` = :id";

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch();
		} catch(Exception $e) {
			return false;
		}

	}

	public function getUserBooks($id) {

		$sql = "SELECT 	`b`.`id`,
						`b`.`title`,
						`b`.`author`,
						`b`.`pub_year`,
						`b`.`image_preview`,
						`a`.`expiration_date` as `exp`
					FROM `lib_actions` as `a`
					INNER JOIN `lib_books`as `b`
						ON `a`.`book_id` = `b`.`id`
					WHERE `a`.`user_id` = :id
						AND `a`.`status` = 1";

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll();
		} catch(Exception $e) {
			return false;
		}

	}

	public function addBook($book_id, $user_id) {

		$sql = "SELECT count(id) as `count`
					FROM `lib_expectations`
						WHERE `user_id` = :user
							AND `book_id` = :book";

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':user', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':book', $book_id, PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetch();
		} catch(Exception $e) {
			return false;
		}

		if($res['count'] != 0) return 0;

		$sql = "INSERT INTO `lib_expectations`
			VALUES(null,:user,:book)";

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':user', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':book', $book_id, PDO::PARAM_INT);
			$stmt->execute();
		} catch(Exception $e) {
			return false;
		}

		if($stmt->rowCount() === 1) return true;

	}

}