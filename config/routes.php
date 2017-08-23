<?php
use App\Core\Config;

Config::set('ROUTES', [
	'GET'    => [
		'default'       => ['controller' => 'DefaultController', 'action' => 'index'],
		'default/index' => ['controller' => 'DefaultController', 'action' => 'index'],
		'score'         => ['controller' => 'ScoreController', 'action' => 'index'],
		'score/index'   => ['controller' => 'ScoreController', 'action' => 'index'],
	],
	'POST'   => [
		'score'       => ['controller' => 'ScoreController', 'action' => 'store'],
		'score/index' => ['controller' => 'ScoreController', 'action' => 'store'],
		'seeder'      => ['controller' => 'SeederController', 'action' => 'generateTestData'],
	],
	'PUT'    => [
		'score' => ['controller' => 'ScoreController', 'action' => 'put'],
	],
	'DELETE' => [
		'score' => ['controller' => 'ScoreController', 'action' => 'delete'],
	],

]);