<?


class Model_librarian extends Model_abstractDb {

	private $model;

	public function getActionsById($id, $active=null) {

		$sql = "SELECT *
					FROM `lib_actions`
					/*INNER JOIN `lib_books`*/
					WHERE `libr_id` = :id ";

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