<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\FaceookSignedRequest;
use App\Models;
use App\Core\Validator;
use \DateTime;

class ReportController extends Controller
{
	function index(Request $request)
	{
		$this->model = new Models\ScoreModel;
		$data['players_today'] = $this->model->getUniquePlayersSince(new DateTime("today"));
		$data['players_total'] = $this->model->getUniquePlayersAllTime();
		$data['players_top'] = $this->model->getPlayersTop(10);
		$data['players_improved'] = $this->model->getPlayersMostImproved();

		$this->view->data($data);
	}

	function totals(Request $request)
	{
		$this->model = new Models\ScoreModel;
		$data['players_today'] = $this->model->getUniquePlayersSince(new DateTime("today"));
		$data['players_total'] = $this->model->getUniquePlayersAllTime();

		$this->view->data($data);
	}
	
	function top(Request $request)
	{
		$limit = 10;
		$this->model = new Models\ScoreModel;
		$data['players_top'] = $this->model->getPlayersTop($limit);

		$this->view->data($data);
	}

	function improved(Request $request)
	{
		$limit = 10;
		$this->model = new Models\ScoreModel;
		$data['players_improved'] = $this->model->getPlayersMostImproved(new DateTime("last sunday - 7 days"), new DateTime("last sunday"), $limit);

		$this->view->data($data);
	}

}
