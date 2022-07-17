<?php namespace App\Controllers;

use Flight;

use App\Models\Lang;
use App\Models\Translation;

class Translations extends Controller
{
	public static function index()
	{
		$translations = Translation::all();
		$langs = Lang::all();

		$data = self::commonData();
		$data['langs'] = $langs;
		$data['translations'] = Translation::byGroup($translations);

		Flight::render('translations.index', $data);
	}
}