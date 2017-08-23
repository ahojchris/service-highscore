<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Request;
use App\Core\Route;

require __DIR__ . '/../config/common.php';
$routes  = include(__DIR__ . '/../config/routes.php'); //TODO do this a better way
$db_config  = include(__DIR__ . '/../config/db.php'); //TODO do this a better way

Route::connect(new Request, $routes);


//////////////////////
// TODOS /////////////
//////////////////////

//TODO Fix how we handle handle controller args
//TODO Create bootstrap file that loads configs and autoloader
//TODO Create users table and integrate with scores
//TODO getMostImproved wire up dates
//TODO spin up RDS instance
//TODO spin up elastic-beanstalk instance
