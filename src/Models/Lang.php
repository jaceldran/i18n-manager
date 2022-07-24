<?php

namespace App\Models;

use App\Services\Datafile;

final class Lang // extends DatafileModel
{
	const PATH = APP_PATH . "/database/langs.php";
	const KEY = 'key';
	const VISIBLE = 'visible';
	const EDITABLE = 'editable';

	public static function all(): array
	{
		$data  = Datafile::read(self::PATH);

		return self::compute($data);
	}

	public static function keys(): array
	{
		return array_keys(self::all());
	}

	public static function compute($data): array
	{
		foreach ($data as $code => &$values) {
			$values['code'] = $code;
		}

		return $data;
	}

	public static function count(string $filter_by_status=self::VISIBLE): int
	{
		$langs = self::all();

		$filtered = array_filter($langs, function($lang) use ($filter_by_status) {
			return $lang[$filter_by_status];
		});

		return count($filtered);

	}

	public static function update(array $values): void
	{
		$langs  = Datafile::read(self::PATH);
		$id = $values[self::KEY];
		$lang = $langs[$id];
		unset ($values[self::KEY]);
		$langs[$id] = array_merge($lang, $values);

		Datafile::write(self::PATH, $langs);
	}

	public static function setOrder(array $order): void
	{
		$sorted = [];
		$langs  = Datafile::read(self::PATH);

		foreach($order as  $lang) {
			$sorted[$lang] = $langs[$lang];
		}

		Datafile::write(self::PATH, $sorted);
	}
}