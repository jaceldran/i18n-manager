<?php namespace App\Services;

use Flight;

class Navigation
{
	const URL = 'url';
	const LABEL = 'label';
	const ACTIVE = 'active';

	const TRANSLATIONS = '/translations';
	const CONFIG = '/config';
	const UPLOAD = '/upload';
	const DOWNLOAD = '/download';

	const MAIN = [
		self::TRANSLATIONS => [
			self::URL => self::TRANSLATIONS,
			self::LABEL => 'Translations',
			self::ACTIVE => false,
		],

		self::UPLOAD => [
			self::URL => self::UPLOAD,
			self::LABEL => 'Upload',
			self::ACTIVE => false,
		],

		self::DOWNLOAD => [
			self::URL => self::DOWNLOAD,
			self::LABEL => 'Download',
			self::ACTIVE => false,
		],

		self::CONFIG => [
			self::URL => self::CONFIG,
			self::LABEL => 'Config',
			self::ACTIVE => false,
		],

		self::CONFIG => [
			self::URL => self::CONFIG,
			self::LABEL => 'Config',
			self::ACTIVE => false,
		],
	];

	public static function main(): array
	{
		$data = self::MAIN;
		$request = Flight::request();

		foreach($data as $key => &$values) {
			$values['active'] = substr_count($request->url, $key);
		}

		return $data;
	}
}