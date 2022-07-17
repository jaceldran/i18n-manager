<?php

namespace App\Models;

use App\Services\Datafile;

final class Translation
{
	const PATH = APP_PATH . "/database/translations.php";
	const CODE = 'code';
	const GROUP = 'group';
	const KEYS = [
		self::CODE,
		self::GROUP
	];

	public static function all(): array
	{
		$data = Datafile::read(self::PATH);
		ksort($data);
		return self::compute($data);
	}

	public static function countByLang(): array
	{
		$count = [];
		$data  = Datafile::read(self::PATH);
		$langs = Lang::all();

		foreach ($langs as $lang => $config) {
			$count[$lang] = count(array_column($data, $lang));
		}

		return $count;
	}

	public static function compute(array $data): array
	{
		$langs = Lang::all();

		$rows = [];
		foreach ($langs as $key=>$lang) {
			$key_langs[$key] = '';
		}

		foreach($data as $key => $values) {
			$row = ['key' => $key];
			$translations = array_merge($key_langs, $values);
			ksort($translations);
			$row += $translations;
			$rows[$key] = $row;
		}

		return $rows;
	}

	public static function byGroup(array $data): array
	{
		$groups = [];

		foreach($data as $code => $values) {
			$parts = explode('.', $code);
			$code = array_pop($parts);
			$group = implode('.',$parts);

			$translations = $values;
			unset($translations['key']);

			$entry = [
				'code' => $code,
				'group' => $group,
				'translations' => $translations
			];

			$groups[$group][$code] = $entry;
		}

		return $groups;

	}

	public static function byLang(array $translations): array
	{
		$groups = [];

		foreach ($translations as $key => $values) {
			foreach($values as $lang => $translation) {
				$groups[$lang][$key] = $translation;
			}
		}
		return $groups;
	}

	public static function export(): array
	{
		$exported = [];
		$paths = Path::all(Path::COMPUTE);
		$translations = self::all();
		$translations_by_lang = self::byLang($translations);

		$json_path =  $paths->{PATH::EXPORT_JSON};
		$php_path = $paths->{PATH::EXPORT_PHP};
		$csv_path = $paths->{PATH::EXPORT_CSV};

		Datafile::writePhp("$php_path/all.php", $translations);
		Datafile::writeJson("$json_path/all.json", $translations);
		Datafile::writeCsv("$csv_path/all.csv", $translations);

		$exported['php'][] = "$php_path/all.php";
		$exported['json'][] = "$php_path/all.json";
		$exported['csv'][] = "$php_path/all.csv";

		foreach ($translations_by_lang as $lang => $data) {
			Datafile::writePhp("$php_path/$lang.php", $data);
			Datafile::writeJson("$json_path/$lang.json", $data);
			$exported['php'][] = "$php_path/$lang.php";
			$exported['json'][] = "$php_path/$lang.php";
		}

		return $exported;
	}
}
