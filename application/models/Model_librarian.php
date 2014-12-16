<?


class Model_librarian extends Model_abstractDb {

	private $model;

	public function getActionsById($id) {

		$sql = "SELECT * FROM `lib_actions` WHERE `libr_id` = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}

}