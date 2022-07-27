<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Path;

class Controller
{
	public static function commonData()
	{
		$data['theme'] = Flight::get('theme');
		$data['navigation_main'] = Navigation::main();
		$data['navigation_config'] = Navigation::config();
		return $data;
	}
}