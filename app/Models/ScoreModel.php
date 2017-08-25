<?php

namespace App\Models;

use App\Core\Model;
use \PDO;
use \DateTime;

/**
 * Class ScoreModel
 * @package App\Models
 */
class ScoreModel extends Model
{

    /**
     * @param $fb_user_id
     * @param $score
     *
     * @return mixed
     */
    function insertScore($fb_user_id, $score)
    {
        $handle = $this->db->prepare('INSERT INTO scores (fb_user_id, score, created_at, updated_at) VALUES (:fb_user_id, :score, NOW(), NOW())');
        $handle->bindValue(':fb_user_id', $fb_user_id, PDO::PARAM_INT);
        $handle->bindValue(':score', $score, PDO::PARAM_STR);
        $handle->execute();

        $score_id = $this->db->lastInsertId();

        return $this->getScoreById($score_id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function getScoreById($id)
    {
        $handle = $this->db->prepare("SELECT * FROM scores WHERE id=:id");
        $handle->bindValue(':id', $id, PDO::PARAM_INT);
        $handle->execute();

        return $handle->fetchObject();
    }

    /**
     * @param $rows
     *
     * @return bool
     */
    function insertScoreMany($rows)
    {
        $sql       = "INSERT INTO scores (fb_user_id, score, created_at, updated_at) VALUES ";
        $param_arr = [];
        $sql_arr   = [];
        foreach ($rows as $row) {
            $sql_arr[] = '(' . implode(',', array_fill(0, count($row), '?')) . ')';
            foreach ($row as $element) {
                $param_arr[] = $element;
            }
        }
        $sql .= implode(',', $sql_arr);
        $handle = $this->db->prepare($sql);

        return $handle->execute($param_arr);
    }


    /**
     * @param DateTime|null $date
     *
     * @return string
     */
    function getUniquePlayersSince(DateTime $date = null)
    {
        $sql = "SELECT COUNT(DISTINCT fb_user_id) FROM scores";
        if ($date !== null) {
            $sql .= " WHERE created_at > :date";
        }
        $date_format = 'Y-m-d H:i:s';

        $handle = $this->db->prepare($sql);
        if ($date !== null) {
            $handle->bindValue(':date', $date->format($date_format), PDO::PARAM_STR);
        }
        $handle->execute();

        return $handle->fetchColumn();
    }

    /**
     * @return string
     */
    function getUniquePlayersAllTime()
    {
        return $this->getUniquePlayersSince();
    }

    /**
     * @param $limit
     *
     * @return array
     */
    function getPlayersTop($limit)
    {
        $sql    = "SELECT fb_user_id, MAX(score) AS highscore FROM scores GROUP BY fb_user_id ORDER BY highscore DESC LIMIT :limit";
        $handle = $this->db->prepare($sql);
        $handle->bindValue(':limit', $limit, PDO::PARAM_INT);
        $handle->execute();

        return $handle->fetchAll();
    }

    /**
     * @param DateTime $date_earlier
     * @param DateTime $date_later
     * @param          $limit
     *
     * @return array
     */
    function getPlayersMostImproved(DateTime $date_earlier, DateTime $date_later, $limit)
    {
        $date_format = 'Y-m-d H:i:s';

        $subquery_1 = "SELECT fb_user_id, MAX(score) AS highscore FROM scores WHERE created_at > :date_later_a GROUP BY fb_user_id ORDER BY highscore DESC";
        $subquery_2 = "SELECT fb_user_id, MAX(score) AS highscore FROM scores WHERE created_at > :date_earlier AND created_at < :date_later_b GROUP BY fb_user_id ORDER BY highscore DESC";

        $sql = "SELECT Later.fb_user_id, Earlier.highscore AS highscore_last_week, Later.highscore AS highscore_this_week, (Later.highscore - Earlier.highscore) AS delta ";
        $sql .= "FROM ($subquery_1) Later ";
        $sql .= "INNER JOIN ($subquery_2) Earlier ";
        $sql .= "ON Later.fb_user_id = Earlier.fb_user_id ORDER BY delta DESC LIMIT :limit";

        $handle = $this->db->prepare($sql);
        $handle->bindValue(':date_earlier', $date_earlier->format($date_format), PDO::PARAM_STR);
        $handle->bindValue(':date_later_a', $date_later->format($date_format), PDO::PARAM_STR);
        $handle->bindValue(':date_later_b', $date_later->format($date_format), PDO::PARAM_STR);
        $handle->bindValue(':limit', $limit, PDO::PARAM_INT);
        $handle->execute();

        return $handle->fetchAll();
    }


    function truncate()
    {
        $handle = $this->db->prepare("TRUNCATE TABLE scores");
        $handle->execute();
    }
}