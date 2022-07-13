<?php

namespace App\Models;

use App\Services\DataFile;

final class Lang // extends DataFileModel
{
	const PATH = APP_PATH . "/database/langs.php";

	public static function all(): array
	{
		$data  = DataFile::read(self::PATH);

		return self::compute($data);
	}

	public static function compute($data): array
	{
		foreach ($data as $code => &$values) {
			$values['code'] = $code;
		}

		return $data;
	}
}