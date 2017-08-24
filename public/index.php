<?php

require __DIR__ . '/../app/bootstrap.php';

use App\Core\Request;
use App\Core\Router;


Router::route(new Request);


//////////////////////
// TODOS /////////////
//////////////////////

//TODO Create users table and integrate with scores

/*
README

POST /seeder num
POST /score signed_request, user_score

GET /report/totals
GET /report/top
GET /report/top/50
GET /report/improved
GET /report



 */