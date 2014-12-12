<?php
require 'Model_databaseConnect.php';

abstract class Model_abstractDb{

	private $db;

	function __construct() {
		$this->db = Model_databaseConnect::connect();
	}

	function select($query){
		$res = $this->db->query($query); //инъекция

		$result = array();

		while($row = $res->fetch(PDO::FETCH_ASSOC))
			$result[] = $row;

		return $result;
	}

}