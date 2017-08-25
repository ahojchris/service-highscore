<?

namespace App\Controllers;

use App\Core\Controller;
use App\Views\HomeView;


/**
 * Class DefaultController
 * @package App\Controllers
 */
class DefaultController extends Controller
{

    /**
     * DefaultController constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->view = new HomeView();
    }

    function index()
    {
        //var_dump(func_num_args());
        //var_dump(func_get_args());
        $this->view->templateHomePage();

    }
}