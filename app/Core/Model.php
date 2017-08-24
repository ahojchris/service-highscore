<?php

namespace App\Core;

use \PDO;

/**
 * Class Model
 * @package App\Core
 */
class Model
{

    protected $db;

	/**
	 * Model constructor.
     */
	function __construct()
    {

        $params = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

        $dsn      = 'mysql:host=' . Config::get('DB_HOST') . ';dbname=' . Config::get('DB_NAME') . ';charset=utf8mb4';
        $this->db = new PDO($dsn, Config::get('DB_USER'), Config::get('DB_PASSWORD'), $params);

    }

}