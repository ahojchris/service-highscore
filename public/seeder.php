<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Request;
use App\Core\Route;

ini_set('display_errors', 1);

$db_config  = include(__DIR__ . '/../config/db.php'); //TODO do this a better way

Route::connect(new Request, $routes);
