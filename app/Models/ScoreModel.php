<?php

namespace App\Models;

use App\Core\Model;
use \PDO;
use \DateTime;

class ScoreModel extends Model
{

	function insertScore($fb_user_id, $score)
	{
		$handle = $this->db->prepare('INSERT INTO scores (fb_user_id, score, created_at, updated_at) VALUES (:fb_user_id, :score, NOW(), NOW())');
		$handle->bindValue(':fb_user_id', $fb_user_id, PDO::PARAM_INT);
		$handle->bindValue(':score', $score, PDO::PARAM_STR);
		$handle->execute();

		$score_id = $this->db->lastInsertId();

		return $this->getScoreById($score_id);
	}

	function getScoreById($id)
	{
		$handle = $this->db->prepare("SELECT * FROM scores WHERE id=:id");
		$handle->bindValue(':id', $id, PDO::PARAM_INT);
		$handle->execute();

		return $handle->fetchObject();
	}

	function insertScoreMany($rows)
	{
		$sql       = "INSERT INTO scores (fb_user_id, score, created_at) VALUES ";
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


	//How many people played the game today?
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

//		return $result = $handle->fetchAll(PDO::FETCH_CLASS);
		return $handle->fetchColumn();
	}

	//How many total players are there?
	function getUniquePlayersAllTime()
	{
		return $this->getUniquePlayersSince();
	}

	//List the top 10 players (by score)
	function getPlayersTop($limit)
	{
		$sql    = "SELECT fb_user_id, MAX(score) AS highscore FROM scores GROUP BY fb_user_id ORDER BY score DESC LIMIT :limit";
		$handle = $this->db->prepare($sql);
		$handle->bindValue(':limit', $limit, PDO::PARAM_INT);
		$handle->execute();

		return $handle->fetchAll();
	}

	//List the top 10 players who improved their score over the course of the week
	//(the difference between the high score they posted last week and their high score this week).
	//You can assume the week ends Sunday at midnight.
	function getPlayersMostImproved(DateTime $date1, DateTime $date2, $limit)
	{
		$date_format = 'Y-m-d H:i:s';
		$subquery_1  = "SELECT fb_user_id, MAX(score) AS highscore FROM scores WHERE created_at > :d2a GROUP BY fb_user_id ORDER BY score DESC";
		$subquery_2  = "SELECT fb_user_id, MAX(score) AS highscore FROM scores WHERE created_at > :d1 AND created_at < :d2b GROUP BY fb_user_id ORDER BY score DESC";

		$sql = "SELECT Period1.fb_user_id, Period1.highscore AS highscore_last_week, Period2.highscore AS highscore_this_week, (Period2.highscore - Period1.highscore) AS delta ";
		$sql .= "FROM ($subquery_1) Period1 ";
		$sql .= "INNER JOIN ($subquery_2) Period2 ";
		$sql .= "ON Period1.fb_user_id = Period2.fb_user_id ORDER BY delta DESC LIMIT :limit";
		$handle = $this->db->prepare($sql);
		$handle->bindValue(':d1', $date1->format($date_format), PDO::PARAM_STR);
		$handle->bindValue(':d2a', $date2->format($date_format), PDO::PARAM_STR);
		$handle->bindValue(':d2b', $date2->format($date_format), PDO::PARAM_STR);
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