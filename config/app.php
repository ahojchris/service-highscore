<?php
use App\Core\Config;

ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');

Config::set('DB_HOST', isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : 'localhost');
Config::set('DB_NAME', isset($_SERVER['DB_NAME']) ? $_SERVER['DB_NAME'] : 'service-highscore');
Config::set('DB_USER', isset($_SERVER['DB_USER']) ? $_SERVER['DB_USER'] : 'root');
Config::set('DB_PASSWORD', isset($_SERVER['DB_PASSWORD']) ? $_SERVER['DB_PASSWORD'] : 'root');

