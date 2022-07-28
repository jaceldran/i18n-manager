<?php namespace App\Controllers;

use Flight;


class Pages extends Controller
{
	public static function home()
	{
		$data = self::commonData();

		Flight::render('pages.home', $data);
	}

	public static function about()
	{
		$data = self::commonData();

		$parsedown = new \Parsedown();

		$data['readme'] = $parsedown->text(
			file_get_contents(APP_PATH.'/README.md')
		);

		Flight::render('pages.about', $data);
	}
}