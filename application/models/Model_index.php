<?php

require 'Model_abstractDb.php';

class Model_index extends Model_abstractDb {

	private function books($field = null){

		$sql = "SELECT 	`b`.`id`,
						`b`.`title`,
						`b`.`author`,
						`b`.`pub_year`,
						`g`.`genre`,
						`b`.`image_preview`
			FROM `lib_books` AS `b`
				LEFT JOIN `lib_genres` AS `g` 
					ON `b`.`genre_id` = `g`.`id`";

		if($field) {
			$sql .= "WHERE `b`.`$field` = ?";
		}

		return $sql;
	}

	public function getBooks(){

		$sql = $this->books();
		$result = $this->db->query($sql);
		
		return $result->fetchAll();
	}

/*	public function getBook($id) {

		$sql = $this->books('id');

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

	}
*/
	public function getDetailBook($id_book) {

		$sql = "SELECT	`b`.`isbn`,
						`b`.`id`,
						`b`.`title`,
						`b`.`author`,
						`b`.`pub_year`,
						`g`.`genre`,
						`b`.`image`,
						`b`.`description`,
						`b`.`publisher`,
						`b`.`volume`
			FROM `lib_books` AS `b`
				LEFT JOIN `lib_genres` AS `g` 
					ON `b`.`genre_id` = `g`.`id`
			WHERE `b`.`id` = :id_book";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue('id_book', $id_book, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch();
		} catch(Exception $e) {
			return false;
		}

	}

}