<?php

namespace App\Models;

use App\Services\DataFile;

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
		$data  = DataFile::read(self::PATH);
		$langs = Lang::all();

		return self::compute($data, $langs);
	}

	public static function compute(array $data, array $langs): array
	{
		$key_langs = [];
		$visible_langs = array_filter($langs, function(array $values): bool {
			return $values['visible'];
		});

		foreach($visible_langs as $key=>$value) {
			$key_langs[$key] = null;
		}

		$groups = [];
		foreach($data as $code => $values) {
			$parts = explode('.', $code);
			$code = array_pop($parts);
			$group = implode('.',$parts);
			$translations = array_merge($key_langs, $values);

			$entry = [
				'code' => $code,
				'group' => $group,
				'translations' => $translations
			];

			$groups[$group][$code] = $entry;
		}

		return $groups;
	}
}
