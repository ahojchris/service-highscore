<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\MainModel;

class DefaultController extends Controller
{
	function index(Request $request)
	{
//		$this->model = new MainModel;
//		$data = $this->model->get_data();
//
//		$this->view->output_json($data);
		echo 'DefaultController';

	}
}