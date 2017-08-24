<?php
use App\Core\Config;

ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');

Config::set('DB_HOST', isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : 'localhost');
Config::set('DB_NAME', isset($_SERVER['DB_NAME']) ? $_SERVER['DB_NAME'] : 'service-highscore');
Config::set('DB_USER', isset($_SERVER['DB_USER']) ? $_SERVER['DB_USER'] : 'root');
Config::set('DB_PASSWORD', isset($_SERVER['DB_PASSWORD']) ? $_SERVER['DB_PASSWORD'] : 'root');
Config::set('FB_APP_SECRET', isset($_SERVER['FB_APP_SECRET']) ? $_SERVER['FB_APP_SECRET'] : '21db65a65e204cca7b5afcbad91fea59');

Config::set('controller_namespace', 'App\Controllers\\');
Config::set('default_controller', 'DefaultController');
Config::set('default_controller_action', 'index');
