<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\FaceookSignedRequest;
use App\Models;
use App\Core\Validator;
use \DateTime;

class ScoreController extends Controller
{
	function index(Request $request)
	{
//		$this->model = new Models\ScoreModel;
//
//		$data['played_today'] = $this->model->getUniquePlayersSince(new DateTime("today"));
//		$data['played_all_time'] = $this->model->getUniquePlayersAllTime();
//		$data['top_players'] = $this->model->getTopPlayers(10);
//		$data['most_improved'] = $this->model->getMostImproved();
//
//
//		$this->view->data($data);
	}

	function store(Request $request)
	{
		$output = [];

		//validate  signed_request defined
		if (!isset($request->post_vars['signed_request']) || !Validator::notEmpty($request->post_vars['signed_request'])) {
			$this->view->error('signed_request is required');

			return false;
		}

		//validate  user_score defined
		if (!isset($request->post_vars['user_score']) || !Validator::notEmpty($request->post_vars['user_score'])) {
			$this->view->error('user_score is required');

			return false;
		}

		$fb_signed_req         = new FaceookSignedRequest($request->post_vars['signed_request']);
		$fb_signed_req_decoded = $fb_signed_req->parse();

		if (!($fb_signed_req_decoded !== null)) {
			$this->view->error('signed_request is invalid');

			return false;
		} else {
			$output['user_id'] = $fb_signed_req_decoded['user_id'];
		}

		if (!Validator::notEmpty($request->post_vars['user_score'])) {
			$this->view->error('user_score is required');

			return false;
		} else {
			if (!Validator::numbersOnly($request->post_vars['user_score'])) {
				$this->view->error('user_score must be an interger');

				return false;
			} else {
				$output['user_score'] = $request->post_vars['user_score'];
			}
		}

		$this->model = new Models\ScoreModel;
		$result      = $this->model->insertScore($output['user_id'], $output['user_score']);
		$this->view->data($result);

		return true;
	}


	function put(Request $request)
	{
		echo 'put()';
	}


	function delete(Request $request)
	{
		echo 'delete()';
	}


	function seed(Request $request)
	{
		//
	}

}
