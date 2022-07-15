<?php namespace App\Controllers;

use Flight;

use App\Models\Lang;
use App\Models\Translation;
use App\Models\Path;

class Configuration extends Controller
{
	public static function index()
	{
		Flight::redirect('/configuration/paths');
	}

	public static function paths()
	{
		$data = self::commonData();

		Flight::render('config.paths', $data);
	}
}