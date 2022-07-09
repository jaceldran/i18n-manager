<?php namespace App\Controllers;

use Flight;

use App\Services\Repo;

class Entries
{
	const ID = 'id';
	const GROUP = 'group';
	const LANG = 'lang';
	const VALUE = 'value';

	public static function put()
	{
		$req = Flight::request()->data;

		$entries = Repo::readEntries();

		$entries[$req[self::GROUP]][$req[self::ID]][$req[self::LANG]] = $req[self::VALUE];

		Repo::saveEntries($entries);

		Flight::json($entries);
	}
}