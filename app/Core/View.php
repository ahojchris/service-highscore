<?php

namespace App\Core;

/**
 * Class View
 * @package App\Core
 */
class View
{
    /**
     * @param null $data
     */
    function outputJson($data = null)
    {
        header('Content-Type: application/json');
        $json_data = json_encode($data);
        echo $json_data;
        exit;
    }

    /**
     * @param null $data
     */
    function data($data = null)
    {
        $this->outputJson(['data' => $data]);
    }

    /**
     * @param null $error
     */
    function error($error = null)
    {
        $this->outputJson(['error' => $error]);
    }
}