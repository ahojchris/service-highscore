<?php

namespace App\Core;

use \PDO;

class Model
{

	protected $db;

	function __construct()
	{

		$params = [
			PDO::ATTR_EMULATE_PREPARES   => false,
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

		$config = ['dsn'      => 'mysql:host=' . Config::get('DB_HOST') . ';dbname=' . Config::get('DB_NAME') . ';charset=utf8mb4',
				   'username' => Config::get('DB_USER'),
				   'password' => Config::get('DB_PASSWORD'),
		];

		$this->db = new PDO($config['dsn'], $config['username'], $config['password'], $params);

	}

}