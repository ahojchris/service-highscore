<?php

Namespace App\Core;

/**
 * Class Config
 * @package App\Core
 */
class Config
{

    protected static $config = [];

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param $key
     * @param $val
     */
    public static function set($key, $val)
    {
        self::$config[$key] = $val;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public static function get($key)
    {
        return self::$config[$key];
    }

}