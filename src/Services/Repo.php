<?php namespace App\Services;

class Repo
{
	public static function readLangs()
	{
		return require PATH_DATA_LANGS;
	}

	public static function readEntries()
	{
		return require PATH_DATA_ENTRIES;
	}

	public static function saveEntries(array $entries): void
	{
		$content = '<?php return ' . var_export($entries, true) . ';';

		file_put_contents(PATH_DATA_ENTRIES, $content);
	}
}