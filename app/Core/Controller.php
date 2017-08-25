<?php

namespace App\Core;

use App\Views\JsonView;
/**
 * Class Controller
 * @package App\Core
 */
abstract class Controller
{

    public $model;
    public $view;

	/**
	 * Controller constructor.
     */
	function __construct()
    {
        $this->view = new JsonView();
    }


}