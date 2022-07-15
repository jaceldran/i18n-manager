<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;
use App\Models\Translation;

class Config
{
	public static function index()
	{
		$data['navigation_main'] = Navigation::main();
		$data['langs'] = Lang::all();
		$data['count'] = Translation::countByLang();

		Flight::render('config.index', $data);
	}

	public static function langs()
	{
		$data['langs'] = Lang::all();
		$data['count'] = Translation::countByLang();

		Flight::render('config.langs', $data);
	}
}