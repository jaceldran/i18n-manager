<?php namespace App\Controllers;

use Flight;

use App\Services\Repo;
use App\Services\Navigation;

class Download
{
	public static function index()
	{
		$data = [
			'navigation' => Navigation::main(),
		];

		Flight::render('download', $data);
	}
}