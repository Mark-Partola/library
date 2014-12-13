<?php
require 'Model_databaseConnect.php';

abstract class Model_abstractDb{

	protected $db;

	public function __construct() {
		$this->db = Model_databaseConnect::connect();
	}

	public function all(/*$query*/){
		$res = $this->db->query("SELECT * FROM `lib_books`");
		$rows = $res->fetchAll(PDO::FETCH_ASSOC);
		/*print_arr($rows);*/

		return $rows;
	}

	public function one($name, $mark, $value) {
		$stmt = $this->db->prepare("SELECT * FROM `lib_books` WHERE `$name` $mark ?");
		$stmt->execute(array($value));
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		/*print_arr($rows);*/

		return $rows;
	}

}