<?php

require __DIR__ . '/../app/bootstrap.php';

use App\Core\Request;
use App\Core\Route;


Route::connect(new Request);


//////////////////////
// TODOS /////////////
//////////////////////

//TODO Fix how we handle handle controller args
//TODO Create bootstrap file that loads configs and autoloader
//TODO Create users table and integrate with scores
//TODO getMostImproved wire up dates
//TODO spin up RDS instance
//TODO spin up elastic-beanstalk instance
//TODO Fix how we handle environment vars for db, etc