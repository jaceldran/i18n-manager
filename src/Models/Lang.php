<?php

namespace App\Models;

use App\Services\Datafile;

final class Lang // extends DatafileModel
{
	const PATH = APP_PATH . "/database/langs.php";
	const ID = 'id';
	const VISIBLE = 'visible';
	const EDITABLE = 'editable';

	public static function all(): array
	{
		$data  = Datafile::read(self::PATH);

		return self::compute($data);
	}

	public static function compute($data): array
	{
		foreach ($data as $code => &$values) {
			$values['code'] = $code;
		}

		return $data;
	}

	public static function update(array $values): void
	{
		$langs  = Datafile::read(self::PATH);
		$id = $values[self::ID];
		$lang = $langs[$id];
		unset ($values[self::ID]);
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