<?php namespace App\Controllers;

use Flight;

use App\Models\Lang;
use App\Models\Translation;

class Translations extends Controller
{
	public static function index()
	{
		$data = self::commonData();
		$data['langs'] = Lang::all();
		$data['translations'] = Translation::all();

		Flight::render('translations.index', $data);
	}
}