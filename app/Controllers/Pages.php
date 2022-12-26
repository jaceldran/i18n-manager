<?php namespace App\Controllers;

use Flight;


class Pages extends Controller
{
	public static function home()
	{
		$data = self::commonData();

		Flight::render('pages.home', $data);
	}

	public static function readme()
	{
		$data = self::commonData();

		$parsedown = new \Parsedown();

		$readme = $parsedown->text(
			file_get_contents(APP_PATH.'/README.md')
		);


		$data['readme'] = $readme;


		Flight::render('pages.readme', $data);
	}
}