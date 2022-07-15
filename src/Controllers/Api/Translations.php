<?php namespace App\Controllers\Api;

use Flight;

use App\Services\DataFile;
use App\Models\Translation;

class Translations
{
	const ID = 'id';
	const LANG = 'lang';
	const VALUE = 'value';

	public static function put()
	{
		$req = Flight::request()->data;
		$response['request'] = $req;
		$data = DataFile::read(Translation::PATH);
		$data[$req[self::ID]][$req[self::LANG]] = $req[self::VALUE];
		DataFile::write(Translation::PATH, $data);
		Flight::json($response);
	}
}