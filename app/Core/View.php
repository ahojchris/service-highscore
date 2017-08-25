<?php

namespace App\Core;

/**
 * Class View
 * @package App\Core
 */
abstract class View
{

    /**
     * @param null $data
     *
     * @return mixed
     */
    abstract public function output($data = null);

    /**
     * @param null $data
     */
    protected function outputJson($data = null)
    {
        header('Content-Type: application/json');
        $json_data = json_encode($data);
        echo $json_data;
        exit;
    }

    /**
     * @param null $data
     */
    protected function outputHtml($data = null)
    {
        header('Content-Type: text/html');
        echo $data;
        exit;
    }

}