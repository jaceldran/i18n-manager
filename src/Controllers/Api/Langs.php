<?php namespace App\Controllers\Api;

use Flight;

use App\Models\Lang;

class Langs
{
	const KEY = 'key';
	const VISIBLE = 'visible';
	const EDITABLE = 'editable';

	public static function order()
	{
		$req = Flight::request()->data;
		$order = [];

		foreach($req as $value) {
			$order[] = $value;
		}

		$response = Lang::setOrder($order);

		Flight::json( $response );
	}

	public static function put()
	{
		$req = Flight::request()->data;
		$values = [];

		foreach($req as $key=>$value) {
			$values[$key] = $value;
		}

		Lang::update($values);

		Flight::json($values);
	}
}