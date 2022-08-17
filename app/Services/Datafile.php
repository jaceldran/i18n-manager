<?php

namespace App\Services;

use Exception;

final class Datafile
{
	const PHP = 'php';
	const JSON = 'json';
	const CSV = 'csv';

	const READ = 'r';
	const WRITE = 'w';

	public static function readPhp(string $path, bool $force = false): array
	{
		if (!$force) {
			return require $path;
		}

		$content = file_get_contents($path);
		$content = str_replace('<?php', '', $content);
		return eval($content);
	}

	public static function readCsv(string $path): array
	{
		$rows = [];

		if (($handle = fopen($path, self::READ)) !== FALSE) {
			while (($row = fgetcsv($handle, 0, ',')) !== false) {
				$rows[] = $row;
			}
			fclose($handle);
		}

		return $rows;
	}

	public static function write(string $path, array $data, string $write_as = self::PHP): void
	{
		try {
			if ($write_as === self::PHP) {
				self::writePhp($path, $data);
			}

			if ($write_as === self::JSON) {
				self::writeJson($path, $data);
			}

			if ($write_as === self::CSV) {
				self::writeCsv($path, $data);
			}
		} catch (Exception $e) {
			throw new DatafileException($e->getMessage());
		}
	}

	public static function writePhp(string $path, array $data): void
	{
		$content = '<?php return ' . var_export($data, true) . ';';

		file_put_contents($path, $content);
	}

	public static function writeJson(string $path, array $data): void
	{
		$content = json_encode($data, JSON_PRETTY_PRINT);

		file_put_contents($path, $content);
	}

	public static function writeCsv(string $path, array $data): void
	{
		$copy = $data;
		$first = array_shift($copy);
		$header = array_keys($first);

		$file = fopen($path, 'w');

		fputcsv($file, $header);

		foreach ($data as $key => $row) {
			$row = array_merge(['key' => $key], $row);
			fputcsv($file, $row);
		}

		fclose($file);
	}
}
