<?php

require __DIR__ . '/../app/bootstrap.php';

use App\Core\Request;
use App\Core\Router;


Router::route(new Request);
