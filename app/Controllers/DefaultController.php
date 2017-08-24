<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;


class DefaultController extends Controller
{
    function index()
    {
        echo 'DefaultController';
        //var_dump(func_num_args());
        //var_dump(func_get_args());

    }
}