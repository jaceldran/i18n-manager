<?php namespace App\Controllers\Api;

use Flight;

use App\Services\Datafile;
use App\Models\Translation;

class Translations
{
	const ID = 'id';
	const LANG = 'lang';
	const VALUE = 'value';

	// TODO: llevar a método Translation::save
	public static function put()
	{
		$req = Flight::request()->data;
		$response['request'] = $req;
		$data = Datafile::read(Translation::PATH);
		$data[$req[self::ID]][$req[self::LANG]] = $req[self::VALUE];
		Datafile::write(Translation::PATH, $data);
		Flight::json($response);
	}

	public static function export()
	{
		Flight::render('translations.export', [
			'title' => 'Exported files',
			'exports' => Translation::export()
		]);
	}
}