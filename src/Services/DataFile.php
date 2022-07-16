<?php

namespace App\Services;

use Exception;

final class Datafile
{
	const PHP = 'php';
	const JSON = 'json';
	const CSV = 'csv';

	public static function read(string $path): array
	{
		return require $path;
	}

	public static function write(string $path, array $data, string $write_as = self::PHP): void
	{
		try {
			if ($write_as === self::PHP) {
				$content = '<?php return ' . var_export($data, true) . ';';
			}

			if ($write_as === self::JSON) {
				$content = json_encode($data, JSON_PRETTY_PRINT);
			}

			file_put_contents($path, $content);
		} catch (Exception $e) {
			throw new DatafileException($e->getMessage());
		}
	}
}
