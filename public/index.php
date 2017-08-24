<?php

require __DIR__ . '/../app/bootstrap.php';

use App\Core\Request;
use App\Core\Route;


Route::connect(new Request);


//////////////////////
// TODOS /////////////
//////////////////////

//TODO Fix how we handle handle controller args
//TODO Create users table and integrate with scores



/*
README

POST /seeder num
POST /score signed_request, user_score




 */