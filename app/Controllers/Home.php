<?php namespace App\Controllers;

use Flight;

use App\Services\Navigation;
use App\Models\Lang;

class Home extends Controller
{
	public static function index()
	{
		$data = self::commonData();

		Flight::render('pages.home', $data);
	}
}