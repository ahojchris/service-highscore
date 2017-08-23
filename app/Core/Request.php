<?php

namespace App\Core;

class Request
{

	var $method;
	var $parsed_url;
	var $path_raw;
	var $path;
	var $path_vars;
	var $post_vars;

	function __construct()
	{
		$this->method     = $_SERVER['REQUEST_METHOD'];
		$this->parsed_url = parse_url($_SERVER['REQUEST_URI']);
		$this->path_raw   = $this->parsed_url['path'];
		$this->path       = $this->filterPath(trim($this->path_raw, '/'));
		$this->path_vars  = $this->filterPathArray(explode('/', $this->path));
		$this->post_vars  = $_POST; //TODO sanitize this
	}

	private function filterPath($string)
	{
		return preg_replace("/[^A-Za-z0-9_\-\/]/", '', $string);
	}

	private function filterPathArray($vars_raw)
	{
		$vars_filtered = [];
		foreach ($vars_raw as $k => $var_raw) {
			$vars_filtered[$k] = $this->filterPath($var_raw);
		}

		return $vars_filtered;
	}

}