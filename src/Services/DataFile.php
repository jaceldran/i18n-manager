<?php namespace App\Services;

final class DataFile
{
	public static function read(string $path): array
	{
		return require $path;
	}

	public static function write(string $path, array $data): void
	{
		$content = '<?php return ' . var_export($data, true) . ';';

		file_put_contents($path, $content);
	}
}