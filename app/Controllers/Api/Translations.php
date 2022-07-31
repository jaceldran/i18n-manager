<?php namespace App\Controllers\Api;

use Flight;

use App\Models\Translation;
use App\Models\Lang;
use ZipArchive;

class Translations
{
	const FORM_VIEW = 'translations.form';

	public static function sanitizeKey(string $key): string
	{
		$key = strtolower($key);
		$key = str_replace(' ', '-', $key);
		$parts = explode('.', $key);

		$parts = array_filter($parts, function ($value){
			return !empty($value);
		});

		return implode('.', $parts);
	}

	public static function normalizeKey(string $key): string
	{
		$key = self::sanitizeKey($key);

		if (substr_count($key, '.')===0) {
			$key = "app.$key";
		}

		return $key;
	}

	public static function updateOrCreate()
	{
		$translations = [];
		$request_values = Flight::request()->data;

		$key = self::normalizeKey($request_values->key);
		$translation = Translation::find($key);

		$group = $translation['group'];

		foreach($request_values as $k => $v) {
			$translation[$k] = $v;
		}

		Translation::updateOrCreate($key, $translation);

		$response = self::groupResponse($group);

		Flight::json($response);
	}

	private static function groupResponse(string $group): array
	{
		$group_translations = Translation::getGroup($group);

		$group_content = [
			'visible_langs' => Lang::count(Lang::VISIBLE),
			'group' => $group,
			'translations' => $group_translations,
			'langs' => Lang::all(),
			'open' => true,
		];

		return [
			'group_header_id' => 'header-' . str_replace('.', '-', $group),
			'group_content_id' => 'content-' . str_replace('.', '-', $group),
			'group_is_empty' => empty($group_translations),
			'render_group_content' => Flight::render(
				'translations.group-content',
				$group_content,
				true
			)
		];
	}

	public static function put()
	{
		self::updateOrCreate();
	}

	public static function post()
	{
		self::updateOrCreate();
	}

	public static function delete()
	{
		$values = Flight::request()->data;

		$key = self::sanitizeKey($values->key);
		$group = self::sanitizeKey($values->group);

		Translation::delete($key);

		$response = self::groupResponse($group);

		Flight::json($response);
	}

	public static function export()
	{
		Flight::render('translations.export', [
			'title' => 'Exported files',
			'exports' => Translation::export()
		]);
	}

	public static function import()
	{
		$errors = [];
		$response = [];
		$file = Flight::request()->files['file-input'];

		if ($file['error']) {
			$errors[] = 'Error loading file';
		} else {
			$path = pathinfo($file['name']);

			if ($path['extension'] !== 'csv') {
				$errors[] = "Only CSV files are allowed to upload";
			}

			if (empty($errors)) {
				$response['result'] = Translation::importCsv($file['tmp_name']);
			}
		}

		$response['success'] = empty($errors);
		$response['errors'] = $errors;

		Flight::json($response);
	}

	public static function download()
	{
		$errors = [];
		$response = [];

		$dir = APP_PATH . '/export';
		$path = APP_PATH . '/.tmp/translations.zip';

		unlink($path);
		$scandir = self::scandir($dir);

		$zip = new ZipArchive;
		if ($zip->open($path, ZipArchive::CREATE) === TRUE) {
			foreach($scandir as $folder => $files) {
				$zip->addEmptyDir($folder);
				foreach($files as $file) {
					$fullpath = "$dir/$folder/$file";
					$zip->addFile($fullpath, "$folder/$file");
				}
			}
		}

		$zip->close();

		$response['success'] = empty($errors);
		$response['errors'] = $errors;
		$response['scandir'] = $scandir;

		Flight::json($response);
	}

	public static function scandir($dir): array
	{
		$result = [];

		$cdir = scandir($dir);

		foreach ($cdir as $key => $value) {
			$fullpath = "$dir/$value";

			if (in_array($value, ['.', '..'])) {
				continue;
			}

			if (is_file($fullpath)) {
				$result[] = $value;
			}

			if (is_dir($fullpath)) {
				$result[$value] = self::scandir($fullpath);
			}
		}

		return $result;
	}

	public static function renderImport(): void
	{
		Flight::render('translations.import', [
			'title' => 'Import CSV file'
		]);
	}

	public static function renderCreate(): void
	{
		$group = Flight::request()->query['group'];

		Flight::render(self::FORM_VIEW, [
			'title' => "New translation in group [$group]",
			'action' => 'create',
			'button' => 'Create translation',
			'button_icon' => '<i class="fas fa-plus"></i>',
			'group' => $group,
			'langs' => Lang::keys()
		]);
	}

	public static function renderUpdate(): void
	{
		$key = Flight::request()->query['key'];
		$key = self::sanitizeKey($key);
		$translation = Translation::find($key);

		Flight::render(self::FORM_VIEW, [
			'title' => "Edit [$key]",
			'action' => 'update',
			'button' => "Update",
			'button_icon' => '<i class="fas fa-check"></i>',
			'translation' => $translation,
			'langs' => Lang::keys(),
		]);
	}

	public static function renderDelete()
	{
		$key = Flight::request()->query['key'];
		$key = self::sanitizeKey($key);
		$translation = Translation::find($key);

		Flight::render(self::FORM_VIEW, [
			'title' => "Delete [$key]",
			'action' => 'delete',
			'button' => 'Delete translation',
			'button_apply' => 'bg-red-700 text-white',
			'button_icon' => '<i class="fas fa-trash"></i>',
			'translation' => $translation,
			'langs' => Lang::keys(),
		]);
	}
}