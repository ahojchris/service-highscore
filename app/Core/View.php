<?php

namespace App\Core;

class View
{
    function outputJson($data = null)
    {
        header('Content-Type: application/json');
        $json_data = json_encode($data);
        echo $json_data;
        exit;
    }

    function data($data = null)
    {
        $this->outputJson(['data' => $data]);
    }

    function error($error = null)
    {
        $this->outputJson(['error' => $error]);
    }
}