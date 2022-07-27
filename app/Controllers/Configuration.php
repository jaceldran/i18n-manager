<?php

namespace App\Controllers;

use Flight;

use App\Models\Lang;
use App\Models\Translation;
use App\Models\Path;

class Configuration extends Controller
{
	public static function index()
	{
		Flight::redirect('/configuration/paths');
	}

	public static function paths()
	{
		$data = self::commonData();
		$data['paths'] = Path::all();

		Flight::render('config.paths', $data);
	}

	public static function env()
	{
		$data = self::commonData();
		$data['env'] = parse_ini_file(APP_PATH . '/.env', true);

		ob_start();
		phpinfo();
		$content = ob_get_contents();
		ob_end_clean();

		$phpinfo = str_replace([
			'<style',
			'</style>',
		], [
			'<!--<style',
			'</style> -->',
		], $content);

		$data['phpinfo'] = $phpinfo;


		Flight::render('config.env', $data);
	}
}
