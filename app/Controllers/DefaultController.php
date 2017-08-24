<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;


class DefaultController extends Controller
{
	function index(Request $request)
	{
		echo 'DefaultController';
	}
}