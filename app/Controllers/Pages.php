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

		$readme = $parsedown->text(
			file_get_contents(APP_PATH.'/README.md')
		);

		$composer = file_get_contents(APP_PATH.'/composer.json');

		$readme = str_replace('{composer.json}', $composer, $readme);

		$data['readme'] = $readme;


		Flight::render('pages.about', $data);
	}
}