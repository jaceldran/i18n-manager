<?php namespace App\Controllers;

use Flight;

class Download extends Controller
{
	public static function index()
	{
		$data = self::commonData();

		Flight::render('download', $data);
	}
}