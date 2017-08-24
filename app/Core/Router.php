<?php

namespace App\Core;

use App\Controllers;

class Router
{
	static function route(Request $request)
	{
		$routes               = Config::get('routes');

		// defailt controller and actiom
		$controller_classname = Config::get('default_controller');
		$controller_action    = Config::get('default_controller_action');

		$func_params = [];
		if (isset($request->path_params[0])) {

			if (isset($request->path_params[1])) {
				//action is defined
				$vars = $request->path_params;
				array_shift($vars);
				array_shift($vars);

				$match_path = $request->path_params[0] . '/' . $request->path_params[1];
				$func_params = $vars;

			} else {
				//action not defined
				$match_path = $request->path_params[0];
			}

		} else {
			$match_path = '';

		}

		// get controller
		if (isset($routes[$request->method][$match_path]['controller'])) {
			$controller_classname = $routes[$request->method][$match_path]['controller'];
		}

		$controller_classname_ns = Config::get('controller_namespace') . $controller_classname;
		if (class_exists($controller_classname_ns)) {
			$controller = new $controller_classname_ns;
		} else {
			Router::Error404();
			log_error("Controller not found: $controller_classname_ns");
			exit;
		}

		// get action
		if (isset($routes[$request->method][$match_path]['action'])) {
			$controller_action = $routes[$request->method][$match_path]['action'];
		}
		if (method_exists($controller_classname_ns, $controller_action)) {
			switch ($request->method) {
				case 'GET':
				case 'DELETE':
					call_user_func_array(array($controller, $controller_action), $func_params);

				break;
				case 'POST':
				case 'PUT':
					$controller->$controller_action($request->post_vars);

				break;
				default:
				Router::Error404();
				log_error("Invalid request method: ". $request->method);
				exit;

				break;

			}

		} else {
			Router::Error404();
			log_error("Action not found: $controller_action in: $controller_classname_ns");
			exit;
		}

	}

	static function Error404()
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		exit;
	}
}