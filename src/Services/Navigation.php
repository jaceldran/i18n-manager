<?php namespace App\Services;

use Flight;

class Navigation
{
	const URL = 'url';
	const LABEL = 'label';
	const ACTIVE = 'active';

	const MANAGE = '/manage';
	const CONFIG = '/config';
	const UPLOAD = '/upload';
	const DOWNLOAD = '/download';
	const SANDBOX = '/sandbox';

	const MAIN = [
		self::MANAGE => [
			self::URL => self::MANAGE,
			self::LABEL => 'Manage',
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

		self::SANDBOX => [
			self::URL => self::SANDBOX,
			self::LABEL => 'Sandbox',
			self::ACTIVE => false,
		],
	];

	public static function main()
	{
		$data = self::MAIN;
		$request = Flight::request();

		foreach($data as $key => &$values) {
			$values['active'] = substr_count($request->url, $key);
		}

		return $data;
	}
}