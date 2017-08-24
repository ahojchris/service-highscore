<?php

Namespace App\Core;

/**
 * Class Validator
 * @package App\Core
 */
class Validator
{

	/**
	 * @param $value
	 *
	 * @return int
     */
    static function numbersOnly($value)
    {
        return preg_match('/^([0-9]+)$/', $value);
    }

	/**
	 * @param $value
	 *
	 * @return bool
     */
    static function notEmpty($value)
    {
        return ($value !== '');
    }

}