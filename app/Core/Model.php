<?php

namespace App\Core;

use \PDO;

class Model
{

	protected $db;

	function __construct()
	{

		global $db_config; //TODO fix this

		$params = [
			PDO::ATTR_EMULATE_PREPARES   => false,
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

		$this->db = new PDO($db_config['dsn'], $db_config['username'], $db_config['password'], $params);

	}

//	function getStuff()
//	{
//
//		$sth = $this->db->prepare("SELECT * FROM scores");
//		$sth->execute();
//
//		/* Fetch all of the values of the first column */
//		$result = $sth->fetchAll();
//		var_dump($result);
//
//	}

}