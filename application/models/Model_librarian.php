<?


class Model_librarian extends Model_user {


	public function getActionsById($id, $active=null) {

		$sql = "SELECT	`b`.`id`,
						`b`.`title`,
						`b`.`isbn`,
						`b`.`author`,
						`b`.`publisher`,
						`b`.`pub_year`,
						`b`.`description` as `book_desc`,
						`b`.`image_preview`,
						`u`.`fname`,
						`u`.`lname`,
						`u`.`patronymic`,
						`u`.`phone`,
						`u`.`passport`,
						`a`.`expiration_date` as `exp`
					FROM `lib_actions` as `a`
					INNER JOIN `lib_books` as `b`
						ON `a`.`book_id` = `b`.`id`
					INNER JOIN `lib_users` as `u`
						ON `a`.`user_id` = `u`.`id`
					WHERE `a`.`libr_id` = :id ";

		if($active === true) {
			$sql .= "AND `status` = 1";
		} else if($active === false){
			$sql .= "AND `status` = 0";
		}

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll();
		}catch(Exception $e){
			return false;
		}

	}

	public function getExpBooks() {

		$sql = "SELECT	`b`.`id`,
						`b`.`title`,
						`b`.`image_preview`,
						`b`.`author`,
						`b`.`pub_year`,
						`u`.`fname`,
						`u`.`lname`,
						`e`.`id` as `exp_id`
					FROM `lib_expectations` as `e`
						INNER JOIN `lib_users` as `u`
							ON `e`.`user_id` = `u`.`id`
						INNER JOIN `lib_books` as `b`
							ON `e`.`book_id` = `b`.`id`";

		try{
			$res = $this->db->query($sql);

			return $res->fetchAll();
		}catch(Exception $e){
			return false;
		}

	}

	public function acceptBook($id_exp, $libr_id, $confirm = false) {

		try{
			$sql = "SELECT `user_id`, `book_id` FROM `lib_expectations`
						WHERE `id` = :id_exp";

			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':id_exp', $id_exp, PDO::PARAM_INT);
			$stmt->execute();

			$res = $stmt->fetch();

			$sql = "SELECT `id` 
						FROM `lib_actions`
							WHERE `user_id` = :user_id
								AND `book_id` = :book_id";

			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':book_id', $res['book_id'], PDO::PARAM_INT);
			$stmt->bindValue(':user_id', $res['user_id'], PDO::PARAM_INT);
			$stmt->execute();

			$row = $stmt->fetch();
			if(!$confirm['have'] && !empty($row)) return -1;

			/*ограничения по лимиту*/
			if(!$confirm['limit']) {
				$sql = "SELECT count(`id`) as `books`
							FROM `lib_actions`
								WHERE `user_id` = :user_id";

				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':user_id', $res['user_id'], PDO::PARAM_INT);
				$stmt->execute();

				$userBooks = $limit = $stmt->fetch()['books'];

				$sql = "SELECT `limit` 
							FROM `lib_users`
								WHERE `id` = :user_id";

				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':user_id', $res['user_id'], PDO::PARAM_INT);
				$stmt->execute();

				$limit = $stmt->fetch()['limit'];

				if($userBooks >= $limit) return -2;
			}

		}catch(Exception $e){
			return false;
		}

		try{

			$this->db->beginTransaction();

			$sql = "INSERT INTO `lib_actions` (`book_id`, `user_id`, `libr_id`)
						VALUES(:book_id, :user_id, :libr_id)";

			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':book_id', $res['book_id'], PDO::PARAM_INT);
			$stmt->bindValue(':user_id', $res['user_id'], PDO::PARAM_INT);
			$stmt->bindValue(':libr_id', $libr_id, PDO::PARAM_INT);
			$stmt->execute();

			if($stmt->rowCount() !== 1) throw new Exception("Error");

			$sql = "DELETE FROM `lib_expectations`
						WHERE `id` = :id_exp";

			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':id_exp', $id_exp, PDO::PARAM_INT);
			$stmt->execute();

			if($stmt->rowCount() !== 1) throw new Exception("Error");

			$this->db->commit();

			return true;

		} catch(Exception $e) {
			$this->db->rollBack();
			return false;
		}

	}


	public function delBook($book_id) {

		$sql = "DELETE FROM `lib_expectations`
					WHERE `book_id` = :book";

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':book', $book_id, PDO::PARAM_INT);
			$stmt->execute();
		} catch(Exception $e) {
			return false;
		}

		if($stmt->rowCount() === 1) return true;
		else return 0;

	}

	public function createUser($fname, $lname, $passport, $email, $patr, $limit=null, $role=0, $phone=null) {

		$sql = "";

		$sql = "INSERT INTO 
			`lib_users` (
						`login`,
						`password`,
						`fname`,
						`lname`,
						`passport`,
						`patronymic`,
						`email`,
						`phone`,
						`role`
					)
			VALUES	(
						:login,
						:password,
						:fname,
						:lname,
						:passport,
						:patronymic,
						:email,
						:phone,
						:role
					)";

		$password = uniqid();
		$hashPassword = md5(uniqid());
		$login = substr($hashPassword,1,5);

		try{

			$stmt = $this->db->prepare($sql);

			$stmt->bindValue(':login', 		$login,								PDO::PARAM_STR);
			$stmt->bindValue(':password', 	$hashPassword,						PDO::PARAM_STR);
			$stmt->bindValue(':fname', 		$fname,								PDO::PARAM_STR);
			$stmt->bindValue(':lname', 		$lname,								PDO::PARAM_STR);
			$stmt->bindValue(':passport',	$passport,							PDO::PARAM_STR);
			$stmt->bindValue(':patronymic',	empty($patr) ? null : $patr,		PDO::PARAM_STR);
			$stmt->bindValue(':email', 		$email,								PDO::PARAM_STR);
			$stmt->bindValue(':phone', 		empty($phone) ? null : $phone,		PDO::PARAM_STR);
			$stmt->bindValue(':role', 		$role,								PDO::PARAM_INT);

			$stmt->execute();

			if($stmt->rowCount() === 1) return true;
			else return false;

		} catch(Exception $e) {

			return false;

		}

	}

}