<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models;
use \DateTime;

class ReportController extends Controller
{
    function index()
    {
        $limit                    = 10;
        $this->model              = new Models\ScoreModel;
        $data['players_today']    = $this->model->getUniquePlayersSince(new DateTime("today"));
        $data['players_total']    = $this->model->getUniquePlayersAllTime();
        $data['players_top']      = $this->model->getPlayersTop($limit);
        $data['players_improved'] = $this->model->getPlayersMostImproved(new DateTime("last sunday - 7 days"), new DateTime("last sunday"), $limit);

        $this->view->data($data);
    }

    function totals()
    {
        $this->model           = new Models\ScoreModel;
        $data['players_today'] = $this->model->getUniquePlayersSince(new DateTime("today"));
        $data['players_total'] = $this->model->getUniquePlayersAllTime();

        $this->view->data($data);
    }

    function top($limit = 10)
    {
        //$limit               = 10;
        $this->model         = new Models\ScoreModel;
        $data['players_top'] = $this->model->getPlayersTop($limit);

        $this->view->data($data);
    }

    function improved()
    {
        $limit                    = 10;
        $this->model              = new Models\ScoreModel;
        $data['players_improved'] = $this->model->getPlayersMostImproved(new DateTime("last sunday - 7 days"), new DateTime("last sunday"), $limit);

        $this->view->data($data);
    }

}
