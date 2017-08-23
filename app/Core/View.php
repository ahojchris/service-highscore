<?php

namespace App\Core;

class View
{
	function output_json($data = null)
	{
		header('Content-Type: application/json');
		$json_data = json_encode($data);
		echo $json_data;
		exit;

	}

	function data($data = null)
	{
		$this->output_json(['data' => $data]);
	}

	function error($error = null)
	{
		$this->output_json(['error' => $error]);
	}
}