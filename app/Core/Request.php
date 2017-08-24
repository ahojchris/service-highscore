<?php

namespace App\Core;

class Request
{
    var $method;
    var $parsed_url;
    var $path;
    var $path_params;
    var $post_vars;

    function __construct()
    {
        $this->method     = $_SERVER['REQUEST_METHOD'];
        $this->parsed_url = parse_url($_SERVER['REQUEST_URI']);
        $this->path       = trim($this->parsed_url['path'], '/');

        $this->path_params = explode('/', $this->path);
        array_walk($this->path_params, [$this, 'filterPath']);

        $this->post_vars = $_POST;
        array_walk($this->post_vars, [$this, 'filterSanitizeString']);
    }

    private function filterPath(&$string)
    {
        return preg_replace("/[^A-Za-z0-9_\-\/]/", '', $string);
    }

    private function filterSanitizeString(&$string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

}