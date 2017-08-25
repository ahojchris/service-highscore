<?php

namespace App\Views;

use App\Core\View;

/**
 * Class HomeView
 * @package App\Core
 */
class JsonView extends View
{

    /**
     * @param null $data
     *
     * @return mixed|void
     */
    public function output($data = null)
    {
        $this->outputJson($data);
    }

    /**
     * @param null $data
     */
    public function outputData($data = null)
    {
        $this->output(['data' => $data]);
    }

    /**
     * @param null $error
     */
    public function outputError($error = null)
    {
        $this->output(['error' => $error]);
    }

}