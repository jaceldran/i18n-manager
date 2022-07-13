<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;
use App\Models\Translation;

class Translations
{
	public static function index()
	{
		$data = [
			'navigation' => Navigation::main(),
		];

		// $data['all']['langs'] = Lang::all();
		// $data['all']['translations'] = Translation::all();
		// Flight::render('translations', $data);

		$data['langs'] = Lang::all();
		$data['translations'] = Translation::all();
		Flight::render('translations.index', $data);
	}
}