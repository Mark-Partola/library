<?php

//require 'Model_abstractDb.php';

class Model_user extends Model_abstractDb {

	public function login($login, $pass) {

		$sql = "SELECT `id`
					FROM `lib_users`
						WHERE `login` = :login
							AND `password` = :pass";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetch();

		if($result['id']) {
			$_SESSION['auth'] = $result['id'];
			header('Location: '.ROUTE_ROOT."/profile/");
		} else {
			$_SESSION['auth'] = false;
			header('Location: '.ROUTE_ROOT.'/login');
		}

	}

	public function logout() {
		$_SESSION['auth'] = false;

		if(!isAjax()) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit();
		}
	}

	public function getUserProfile($id){

		$sql = "SELECT * 
					FROM `lib_users`
						WHERE `id` = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($id));

		return $stmt->fetch();

	}

}