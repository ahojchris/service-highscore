<?

namespace App\Controllers;

use App\Core\Controller;
use App\Models;
use \DateTime;

/**
 * Class ReportController
 * @package App\Controllers
 */
class ReportController extends Controller
{
    function index()
    {
        $limit                    = 10;
        $this->model              = new Models\ScoreModel;
        //How many people played the game today?
        $data['players_today']    = $this->model->getUniquePlayersSince(new DateTime("today"));
        //How many total players are there?
        $data['players_total']    = $this->model->getUniquePlayersAllTime();
        //List the top 10 players (by score)
        $data['players_top']      = $this->model->getPlayersTop($limit);
        //List the top 10 players who improved their score over the course of the week
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

    /**
     * @param int $limit
     */
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
