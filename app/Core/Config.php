<?php

Namespace App\Core;

class Config
{

	protected static $config = [];

	private function __construct() {}

	public static function set($key, $val)
	{
			self::$config[$key] = $val;
	}

	public static function get($key)
	{
		return self::$config[$key];
	}

}