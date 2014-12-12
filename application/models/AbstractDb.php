<?php
require 'DatabaseConnect.php';

abstract class AbstractDb{

	private $db;

	function __construct() {
		$this->db = DatabaseConnect::connect();
	}

	function select($query){
		$res = $this->db->query($query); //инъекция

		$result = array();

		while($row = $res->fetch(PDO::FETCH_ASSOC))
			$result[] = $row;

		return $result;
	}

}