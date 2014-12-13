<?php

require 'Model_abstractDb.php';

class Model_index extends Model_abstractDb {

	public function getBooks(){

		$result = $this->db->query("SELECT `b`.`title` , `b`.`author` , `b`.`pub_year` , `g`.`genre`, `b`.`image_preview`
			FROM `lib_books` AS `b`
				LEFT JOIN `lib_genres` AS `g` 
					ON `b`.`genre_id` = `g`.`id`");

		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

}