<?php namespace App\Controllers;

use Flight;

use App\Services\Repo;
use App\Services\Navigation;

class Manage
{
	const ID = 'id';
	const GROUP = 'group';
	const LANG = 'lang';
	const VALUE = 'value';

	public static function index()
	{
		$data = [
			'langs' => Repo::readLangs(),
			'entries' => Repo::readEntries(),
			'navigation' => Navigation::main(),
		];

		Flight::render('manage.index', $data);
	}
}