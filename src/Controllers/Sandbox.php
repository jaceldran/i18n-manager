<?php namespace App\Controllers;

use App\Models\Translation;
use Flight;

use App\Services\Navigation;

class Sandbox extends Controller
{
	public static function index()
	{
		$data = self::commonData();

		$data['all']['export'] = 'Translation::export()';


		// $data['all']['php-version'] = phpversion();
		// $data['all']['pdo-drivers'] = \PDO::getAvailableDrivers();
		// $data['all']['env'] = Flight::get('env');
		// $data['all']['navigation_config'] = Navigation::config();
		// $data['all']['navigation_main'] = Navigation::main();
		// $data['all']['theme'] = Flight::get('theme');

		Flight::render('sandbox', $data);
	}
}