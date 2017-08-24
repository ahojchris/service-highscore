<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\FaceookSignedRequest;
use App\Models;
use App\Core\Validator;

class ScoreController extends Controller
{
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

}
