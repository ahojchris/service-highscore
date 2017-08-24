<?php
use App\Core\Config;

Config::set('ROUTES', [
	'GET'    => [
		'report'          => ['controller' => 'ReportController', 'action' => 'index'],
		'report/index'    => ['controller' => 'ReportController', 'action' => 'index'],
		'report/totals'   => ['controller' => 'ReportController', 'action' => 'totals'],
		'report/top'      => ['controller' => 'ReportController', 'action' => 'top'],
		'report/improved' => ['controller' => 'ReportController', 'action' => 'improved'],
	],
	'POST'   => [
		'score'        => ['controller' => 'ScoreController', 'action' => 'store'],
		'score/index'  => ['controller' => 'ScoreController', 'action' => 'store'],
		'seeder'       => ['controller' => 'SeederController', 'action' => 'generateTestData'],
		'seeder/index' => ['controller' => 'SeederController', 'action' => 'generateTestData'],
	],
	'PUT'    => [],
	'DELETE' => [],

]);