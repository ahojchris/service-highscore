<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\FaceookSignedRequest;
use App\Models;
use App\Core\Validator;

class ScoreController extends Controller
{

    function store($params)
    {
        //$params = ['signed_request' => 'SIGNED_REQUEST', user_score => 'SCORE']

        $output = [];

        //validate  signed_request defined
        if (!isset($params['signed_request']) || !Validator::notEmpty($params['signed_request'])) {
            $this->view->error('signed_request is required');

            return false;
        }

        //validate  user_score defined
        if (!isset($params['user_score']) || !Validator::notEmpty($params['user_score'])) {
            $this->view->error('user_score is required');

            return false;
        }

        $fb_signed_req         = new FaceookSignedRequest($params['signed_request']);
        $fb_signed_req_decoded = $fb_signed_req->parse();

        if (!($fb_signed_req_decoded !== null)) {
            $this->view->error('signed_request is invalid');

            return false;
        } else {
            $output['user_id'] = $fb_signed_req_decoded['user_id'];
        }

        if (!Validator::notEmpty($params['user_score'])) {
            $this->view->error('user_score is required');

            return false;
        } else {
            if (!Validator::numbersOnly($params['user_score'])) {
                $this->view->error('user_score must be an interger');

                return false;
            } else {
                $output['user_score'] = $params['user_score'];
            }
        }

        $this->model = new Models\ScoreModel;
        $result      = $this->model->insertScore($output['user_id'], $output['user_score']);
        $this->view->data($result);

        return true;
    }

}
