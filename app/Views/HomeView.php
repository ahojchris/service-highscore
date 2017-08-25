<?php

namespace App\Views;

use App\Core\View;

/**
 * Class HomeView
 * @package App\Core
 */
class HomeView extends View
{

    /**
     * @param null $data
     *
     * @return mixed|void
     */
    public function output($data = null)
    {
        $this->outputHtml($data);
    }

    public function templateHomePage()
    {
        $html = '';
        $html .= '<h1 style="font-family: sans-serif;">High-Score Service</h1>';
        $html .= '<img src="/assets/img/coin-box.jpg" style="height:300px; width:300px;" />';

        $this->output($html);

    }
}