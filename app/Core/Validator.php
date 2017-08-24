<?php

Namespace App\Core;

class Validator
{

    static function numbersOnly($value)
    {
        return preg_match('/^([0-9]+)$/', $value);
    }

    static function notEmpty($value)
    {
        return ($value !== '');
    }

}