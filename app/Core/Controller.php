<?php

namespace App\Core;

/**
 * Class Controller
 * @package App\Core
 */
class Controller
{

    public $model;
    public $view;

	/**
	 * Controller constructor.
     */
	function __construct()
    {
        $this->view = new View();
    }

    function index()
    {
    }


}