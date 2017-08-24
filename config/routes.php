<?php
use App\Core\Config;

Config::set('ROUTES', [
	'GET'    => [
		'player-report'         => ['controller' => 'ReportController', 'action' => 'index'],
		'player-report/index'   => ['controller' => 'ReportController', 'action' => 'index'],
		'player-report/totals'   => ['controller' => 'ReportController', 'action' => 'totals'],
		'player-report/top'   => ['controller' => 'ReportController', 'action' => 'top'],
		'player-report/improved'   => ['controller' => 'ReportController', 'action' => 'improved'],
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