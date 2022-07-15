<?php

namespace App\Models;

use App\Services\DataFile;

final class Path
{
	const PATH = APP_PATH . "/database/paths.php";
	const EXPORT_JSON = 'export_json';
	const EXPORT_PHP = 'export_php';

	public static function all(): object
	{
		$data  = DataFile::read(self::PATH);

		foreach($data as &$path) {
			$path = APP_PATH . $path;
			$parts = explode('/', $path);
			$stack = [];

			foreach($parts as $part) {
				$stack[] = $part;
				$current = implode('/', $stack);
				if (!is_dir($current)) {
					mkdir($current);
				}
			}
		}

		return (object) $data;
	}
}