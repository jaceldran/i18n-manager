<?php namespace App\Services;

use Flight;

class Navigation
{
	const URL = 'url';
	const LABEL = 'label';
	const ACTIVE = 'active';

	const TRANSLATIONS = '/translations';
	const CONFIG = '/configuration';
	const UPLOAD = '/upload';
	const DOWNLOAD = '/download';

	const CONFIG_LANGS = '/configuration/langs';
	const CONFIG_PATHS = '/configuration/paths';

	const MAIN_OPTIONS = [
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
			self::LABEL => 'Configuration',
			self::ACTIVE => false,
		],
	];

	const CONFIG_OPTIONS =  [
		self::CONFIG_LANGS => [
			self::URL => self::CONFIG_LANGS,
			self::LABEL => 'Langs',
			self::ACTIVE => false,
		],
		self::CONFIG_PATHS => [
			self::URL => self::CONFIG_PATHS,
			self::LABEL => 'Paths',
			self::ACTIVE => false,
		],
	];

	public static function main(): array
	{
		$request = Flight::request();


		foreach (self::MAIN_OPTIONS as $url => $values) {
			$data[$url] = (object) [
				self::URL => $url,
				self::LABEL => $values[self::LABEL],
				self::ACTIVE => substr_count($request->url, $url),
			];
		}

		return $data;
	}

	public static function config(): array
	{
		$request = Flight::request();

		foreach (self::CONFIG_OPTIONS as $url => $values) {
			$data[$url] = (object) [
				self::URL => $url,
				self::LABEL => $values[self::LABEL],
				self::ACTIVE => substr_count($request->url, $url),
			];
		}

		return $data;
	}
}