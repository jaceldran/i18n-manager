<?php

namespace App\Models;

use App\Services\Datafile;

final class Path
{
	const PATH = APP_PATH . "/database/paths.php";
	const EXPORT_JSON = 'export_json';
	const EXPORT_PHP = 'export_php';
	const EXPORT_CSV = 'export_csv';

	const NONE = 0;
	const COMPUTE = 1;

	public static function all(int $mode = self::NONE): object
	{
		$data  = Datafile::readPhp(self::PATH, true);

		if ($mode === self::COMPUTE) {
			$data = self::compute($data);
		}

		return (object) $data;
	}

	public static function compute(array $data): array
	{
		foreach ($data as &$path) {
			$path = str_replace([
				'{APP_PATH}'
			], [
				APP_PATH
			], $path);
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
