<?php

//require 'Model_abstractDb.php';

class Model_user extends Model_abstractDb {

	public function auth($login, $pass) {

		$sql = "SELECT `id`
					FROM `lib_users`
						WHERE `login` = :login
							AND `password` = :pass";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetch();

		if($result) {
			$_SESSION['auth'] = $result['id'];
			header('Location: '.ROUTE_ROOT."/user/{$result['id']}");
		} else {
			$_SESSION['auth'] = false;
			header('Location: '.ROUTE_ROOT.'/login');
		}

	}

}