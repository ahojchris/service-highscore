<?php

namespace App\Core;

use App\Controllers;
use App\Core\Request;
use App\Core\Config;

class Route
{
	static function connect(Request $request)
	{
		$routes = Config::get('ROUTES');
		$controller_namespace = 'App\Controllers\\';

		// defailt controller and actiom
		$controller_classname = 'DefaultController';
		$controller_action    = 'index';

		//var_dump($routes[$request->method][$request->path]);

		// get controller
		if (isset($routes[$request->method][$request->path]['controller'])) {
			$controller_classname = $routes[$request->method][$request->path]['controller'];
		}

		$controller_classname_ns = $controller_namespace . $controller_classname;
		if (class_exists($controller_classname_ns)) {
			$controller = new $controller_classname_ns;
		} else {
			Route::Error404();
			log_error("Controller not found: $controller_classname_ns");
		}

		// get action
		if (isset($routes[$request->method][$request->path]['action'])) {
			$controller_action = $routes[$request->method][$request->path]['action'];
		}
		if (method_exists($controller_classname_ns, $controller_action)) {

			//TODO implement better argument handling https://stackoverflow.com/questions/1422652/how-to-pass-variable-number-of-arguments-to-a-php-function
			$controller->$controller_action($request);
		} else {
			Route::Error404();
			log_error("Action not found: $controller_action in: $controller_classname_ns");
		}

	}

	static function Error404()
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		exit;
	}
}