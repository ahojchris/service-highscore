<?

namespace App\Controllers;

use App\Core\Controller;


/**
 * Class DefaultController
 * @package App\Controllers
 */
class DefaultController extends Controller
{
    function index()
    {
        echo 'High-score service';
        //var_dump(func_num_args());
        //var_dump(func_get_args());

    }
}