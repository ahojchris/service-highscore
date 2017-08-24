<?

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helper;
use App\Models;
use App\Core\Validator;
use \DateTime;

/**
 * Class SeederController
 * @package App\Controllers
 */
class SeederController extends Controller
{

    private function resetDB()
    {
        $this->model = new Models\ScoreModel;
        $this->model->truncate();
    }

    /**
     * @param array $params
     *
     * @return bool
     */
    public function generateTestData($params = ['num' => 1000000])
    {
        //validate  user_score defined
        if (!isset($params['num']) || !Validator::notEmpty($params['num'])) {
            $this->view->error('num is required');

            return false;
        }

        if (!Validator::numbersOnly($params['num'])) {
            $this->view->error('num must be an interger');

            return false;
        } else {

            $num_rows = $params['num'];

            //TODO filter $params['num'] a bit more
            $this->model = new Models\ScoreModel;

            $this->resetDB();

            $chunk_size = 1000;
            $uid_limit  = $chunk_size / rand(30, 70);
            $uids       = $this->generateFbUserIdArray($uid_limit);

            $score['min'] = 1;
            $score['max'] = 1000000;

            $rows = [];
            for ($i = 0; $i < $num_rows; $i++) {

                if (count($rows) > $chunk_size - 1) {
                    $this->model->insertScoreMany($rows);
                    $rows      = [];
                    $uid_limit = $chunk_size / rand(30, 70);
                    $uids      = $this->generateFbUserIdArray($uid_limit);

                }

                $seconds     = rand(1, 90 * 24 * 60 * 60); //90 days
                $date_format = 'Y-m-d H:i:s';

                //more efficient but uses old date functions
                //$timestamp = mt_rand(time() - $seconds, time());
                //$rows[] = [$uids[rand(0, $uid_limit - 1)], $i + 1, date($date_format, $timestamp)];
                $date   = new DateTime("-$seconds seconds");
                $rows[] = [$uids[rand(0, $uid_limit - 1)], $this->generateRandomScore($score['min'], $score['max']), $date->format($date_format), $date->format($date_format)];
            }
            if (count($rows) > 0) {
                //final insert for remaining rows in final chunk
                $this->model->insertScoreMany($rows);
            }

            $this->view->data(true);

            return true;
        }

    }


    /**
     * @param $min
     * @param $max
     *
     * @return float
     */
    private function generateRandomScore($min, $max)
    {
        //skew a bit to the right
        $discounted_max = floor($max / (rand(1, 2)));

        return Helper::generatePureBellNumber($min, $discounted_max, $discounted_max / 10);
    }

    /**
     * @param $size
     *
     * @return array
     */
    private function generateFbUserIdArray($size)
    {
        $ids = [];
        for ($i = 0; $i < $size; $i++) {
            $ids[] = $this->generateFbUserId();
        }

        return $ids;
    }

    /**
     * @return string
     */
    private function generateFbUserId()
    {
        $num = rand(1, 999999999);

        return '1' . str_pad($num, 14, "0", STR_PAD_LEFT);
    }

}
