<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;
use App\Models\Translation;

class Config
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

		Flight::render('config.index', $data);
	}

	public static function langs()
	{
		$data['navigation'] = Navigation::main();
		$data['langs'] = Lang::all();
		$data['count'] = Translation::countByLang();

		// print_r($data);
		// die(__METHOD__);

		Flight::render('config.langs', $data);
	}
}