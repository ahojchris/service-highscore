<?php

namespace App\Models;

use App\Core\Model;

class MainModel extends Model
{
	public function get_data()
	{
		$data[] = ['one', 'two'];
		$data[] = ['three', 'four'];

		return $data;

	}
}