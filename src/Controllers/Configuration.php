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
		$data['paths'] = Path::all();

		Flight::render('config.paths', $data);
	}

	public static function env()
	{
		$data = self::commonData();
		$data['env'] = parse_ini_file(APP_PATH.'/.env', true);

		Flight::render('config.env', $data);
	}
}