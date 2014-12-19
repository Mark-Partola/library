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

	public function getExpBooks(){

		$sql = "SELECT *
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

}