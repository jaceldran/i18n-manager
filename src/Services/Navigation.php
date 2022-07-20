<?php namespace App\Services;

use Flight;

class Navigation
{
	const URL = 'url';
	const LABEL = 'label';
	const ACTIVE = 'active';

	const TRANSLATIONS = '/translations';
	const LANGS = '/langs';
	const SANDBOX = '/sandbox';
	const CONFIGURATION = '/configuration';

	const CONFIG_PATHS = '/configuration/paths';
	const CONFIG_ENV = '/configuration/env';

	const MAIN_OPTIONS = [
		self::TRANSLATIONS => [
			self::URL => self::TRANSLATIONS,
			self::LABEL => 'Translations',
			self::ACTIVE => false,
		],
		self::LANGS => [
			self::URL => self::LANGS,
			self::LABEL => 'Langs',
			self::ACTIVE => false,
		],
		self::CONFIGURATION => [
			self::URL => self::CONFIGURATION,
			self::LABEL => 'Configuration',
			self::ACTIVE => false,
		],
	];

	const CONFIG_OPTIONS =  [
		self::CONFIG_PATHS => [
			self::URL => self::CONFIG_PATHS,
			self::LABEL => 'Paths',
			self::ACTIVE => false,
		],
		self::CONFIG_ENV => [
			self::URL => self::CONFIG_ENV,
			self::LABEL => 'Env',
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