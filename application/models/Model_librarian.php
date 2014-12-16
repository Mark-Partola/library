<?


class Model_librarian extends Model_abstractDb {

	private $model;

	public function getActionsById($id, $active=null) {

		$sql = "SELECT	`b`.`title`,
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
						`u`.`passport`
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

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}

}