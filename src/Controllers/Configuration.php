<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;
use App\Models\Translation;

class Configuration extends Controller
{
	public static function index()
	{
		$data = self::commonData();

		Flight::render('config.index', $data);
	}

	public static function langs()
	{
		$data = self::commonData();
		$data['langs'] = Lang::all();
		$data['count'] = Translation::countByLang();

		Flight::render('config.langs', $data);
	}

	public static function paths()
	{
		$data = self::commonData();

		Flight::render('config.paths', $data);
	}
}