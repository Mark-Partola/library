<?php
require 'Model_databaseConnect.php';

abstract class Model_abstractDb{

	private $db;

	public function __construct() {
		$this->db = Model_databaseConnect::connect();
	}

	public function select(/*$query*/){
		$res = $this->db->query("SELECT * FROM `lib_books`");
		$rows = $res->fetchAll(PDO::FETCH_ASSOC);
		/*print_arr($rows);*/

		return $rows;
	}

}