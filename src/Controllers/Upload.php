<?php namespace App\Controllers;

use Flight;

use App\Services\Repo;
use App\Services\Navigation;

class Upload
{
	public static function index()
	{
		$data = [
			'navigation' => Navigation::main(),
		];

		Flight::render('upload', $data);
	}
}