<?php

namespace App\Models;

use Flight;

final class Path
{
	public const EXPORT_JSON = 'export_json';
	public const EXPORT_PHP = 'export_php';
	public const EXPORT_CSV = 'export_csv';

	public static function all(): object
	{
		return (object) self::compute([
			self::EXPORT_JSON => Flight::get('env')->EXPORT_JSON,
			self::EXPORT_PHP => Flight::get('env')->EXPORT_PHP,
			self::EXPORT_CSV => Flight::get('env')->EXPORT_CSV,
		]);
	}

	private static function compute(array $data): array
	{
		foreach ($data as $index=>$value) {
			$data[$index] = str_replace(['{APP_PATH}'], [APP_PATH], $value);
		}

		return $data;
	}

	public static function createFolders(string $path): void
	{
		$parts = explode('/', $path);
		$stack = [];
		foreach ($parts as $part) {
			$stack[] = $part;
			$current = implode('/', $stack);
			if (!is_dir($current)) {
				mkdir($current);
			}
		}
	}
}
