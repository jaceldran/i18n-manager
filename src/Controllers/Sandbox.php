<?php namespace App\Controllers;

use Flight;

use App\Services\Repo;
use App\Services\Navigation;

class Sandbox
{
	public static function index()
	{
		$data = [
			'navigation' => Navigation::main(),
		];

		$data['all']['php-version'] = phpversion();
		$data['all']['pdo-drivers'] = \PDO::getAvailableDrivers();
		$data['all']['env'] = Flight::get('env');
		$data['all']['phinx_config'] = Flight::get('phinx_config');

		Flight::render('sandbox', $data);
	}
}