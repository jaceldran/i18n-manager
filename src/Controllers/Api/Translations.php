<?php namespace App\Controllers\Api;

use Flight;

use App\Services\Datafile;
use App\Models\Translation;

class Translations
{
	const ID = 'id';
	const LANG = 'lang';
	const VALUE = 'value';

	// TODO: llevar a método Translation::save
	public static function put()
	{
		$req = Flight::request()->data;
		$response['request'] = $req;
		$data = Datafile::read(Translation::PATH);
		$data[$req[self::ID]][$req[self::LANG]] = $req[self::VALUE];
		Datafile::write(Translation::PATH, $data);
		Flight::json($response);
	}

	public static function export()
	{
		Flight::render('translations.export', [
			'title' => 'Exported files',
			'exports' => Translation::export()
		]);
	}

	public static function import()
	{
		Flight::render('translations.import', [
			'title' => 'Import CSV file'
		]);
	}

	public static function uploadCsv()
	{
		$errors = [];
		$response = [];
		$file = Flight::request()->files['file-input'];

		if ($file['error']) {
			$errors[] = 'Error loading file';
		} else {
			$path = pathinfo($file['name']);

			if ($path['extension'] !== 'csv') {
				$errors[] = "Only CSV files are allowed to upload";
			}

			if (empty($errors)) {
				$response['result'] = Translation::importCsv($file['tmp_name']);
			}
		}

		$response['success'] = empty($errors);
		$response['errors'] = $errors;

		Flight::json($response);
	}
}