<?php

namespace App\Models;

use App\Services\Datafile;

final class Lang // extends DatafileModel
{
	const PATH = APP_PATH . "/database/langs.php";
	const KEY = 'key';
	const ALL = 'all';
	const VISIBLE = 'visible';
	const EDITABLE = 'editable';

	public static function all(string $filter = self::ALL): array
	{
		$data  = Datafile::readPhp(self::PATH);

		if ($filter === self::EDITABLE) {
			$data = array_filter($data, function ($lang) {
				return $lang['editable'];
			});
		}

		if ($filter === self::VISIBLE) {
			$data = array_filter($data, function ($lang) {
				return $lang['visible'];
			});
		}

		return self::compute($data);
	}

	public static function keys(string $filter = self::ALL): array
	{
		$langs = self::all($filter);

		return array_keys($langs);
	}

	public static function compute($data): array
	{
		$default = [
			self::VISIBLE => true,
			self::EDITABLE => true,
		];

		foreach ($data as $key => &$values) {
			$values['key'] = $key;
			$values = array_merge($default, $values);
		}

		return $data;
	}

	public static function count(string $filterByStatus=self::VISIBLE): int
	{
		$langs = self::all();

		$filtered = array_filter($langs, function($lang) use ($filterByStatus) {
			return $lang[$filterByStatus];
		});

		return count($filtered);

	}

	public static function update(array $values): void
	{
		$langs  = Datafile::readPhp(self::PATH);
		$id = $values[self::KEY];
		$lang = $langs[$id];
		unset ($values[self::KEY]);
		$langs[$id] = array_merge($lang, $values);

		Datafile::write(self::PATH, $langs);
	}

	public static function setOrder(array $order): void
	{
		$sorted = [];
		$langs  = Datafile::readPhp(self::PATH);

		foreach($order as  $lang) {
			$sorted[$lang] = $langs[$lang];
		}

		Datafile::write(self::PATH, $sorted);
	}

	public static function find(string $key): array
	{
		$data = Datafile::readPhp(self::PATH);

		$values = [];

		if (isset($data[$key])) {
			$values = ['key' => $key] + $data[$key];
		}

		return $values;
	}

	public static function updateOrCreate(string $key, array $values): void
	{
		$data = Datafile::readPhp(self::PATH);

		if (isset($data[$key])) {
			$values = array_merge($data[$key], $values);
		}

		$data[$key] = $values;

		Datafile::writePhp(self::PATH, $data);
	}

	public static function delete(string $key): void
	{
		$data = Datafile::readPhp(self::PATH);

		if (!isset($data[$key])) {
			return;
		}

		unset ($data[$key]);

		Datafile::writePhp(self::PATH, $data);
	}
}