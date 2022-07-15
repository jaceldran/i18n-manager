<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;

class Home
{
	public static function index()
	{
		$data['navigation_main'] = Navigation::main();
		$data['langs'] = Lang::all();
		Flight::render('home', $data);
	}
}