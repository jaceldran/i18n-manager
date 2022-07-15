<?php namespace App\Services;

final class DataFile
{
	const WRITE_PHP = 1;
	const WRITE_JSON = 2;

	public static function read(string $path): array
	{
		return require $path;
	}

	public static function write(string $path, array $data, int $write_as = self::WRITE_PHP): void
	{
		if ($write_as === self::WRITE_PHP) {
			$content = '<?php return ' . var_export($data, true) . ';';
		}

		if ($write_as === self::WRITE_JSON) {
			$content = json_encode($data, JSON_PRETTY_PRINT);
		}

		file_put_contents($path, $content);
	}
}