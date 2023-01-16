<?php

namespace App\Controllers\Api;

use Flight;

use App\Models\Translation;
use App\Models\Lang;
use ZipArchive;

final class Translations
{
    const FORM_VIEW = 'translations.form';

    public static function sanitizeKey(string $key): string
    {
        $key = strtolower($key);
        $key = str_replace(' ', '-', $key);
        $parts = explode('.', $key);

        $parts = array_filter($parts, function ($value) {
            return !empty($value);
        });

        return implode('.', $parts);
    }

    public static function normalizeKey(string $key): string
    {
        $key = self::sanitizeKey($key);

        if (substr_count($key, '.') === 0) {
            $key = "app.$key";
        }

        return $key;
    }

    public static function updateOrCreate()
    {
        $requestValues = Flight::request()->data;

        $key = self::normalizeKey($requestValues->key);
        $translation = Translation::find($key);

        $group = $translation['group'];

        foreach ($requestValues as $k => $v) {
            $translation[$k] = $v;
        }

        Translation::updateOrCreate($key, $translation);

        $response = self::groupResponse($group);

        Flight::json($response);
    }

    private static function groupResponse(string $group): array
    {
        $groupTranslations = Translation::getGroup($group);

        $groupContent = [
            'visible_langs' => Lang::count(Lang::VISIBLE),
            'group' => $group,
            'translations' => $groupTranslations,
            'langs' => Lang::all(),
            'open' => true,
        ];

        return [
            'group_header_id' => 'header-' . str_replace('.', '-', $group),
            'group_content_id' => 'content-' . str_replace('.', '-', $group),
            'group_is_empty' => $groupTranslations === [],
            'render_group_content' => Flight::render(
                'translations.group-content',
                $groupContent,
                true
            ),
            '__group_content' => $groupContent,
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
            $path = pathinfo((string) $file['name']);

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
        $exportPaths = [
            Flight::env('EXPORT_JSON'),
            Flight::env('EXPORT_PHP'),
            Flight::env('EXPORT_CSV'),
        ];

        $zipArchivePath = APP_PATH . '/.tmp/translations.zip';

        @unlink($zipArchivePath);
        $zipArchive = new ZipArchive;
        if ($zipArchive->open($zipArchivePath, ZipArchive::CREATE) === true) {
            foreach ($exportPaths as $exportPath) {
                $scandir = $data[$exportPath] = Translations::scandir($exportPath);
                foreach ($scandir as $file) {
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $filepath = "{$exportPath}/$file";
                    $entryname = "$extension/$file";
                    $zipArchive->addFile($filepath, $entryname);
                }
            }
        }

        $zipArchive->close();

        $response['success'] = $errors === [];
        $response['errors'] = $errors;
        // $response['export_paths'] = $exportPaths;
        // $response['files'] = $files;
        // $response['zip'] = $zipArchivePath;

        Flight::json($response);
    }

    public static function scandir($dir): array
    {
        $result = [];

        $cdir = scandir($dir);

        foreach ($cdir as $value) {
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
            'translation' => [],
            'group' => $group,
            'langs' => Lang::all()
        ]);
    }

    public static function renderUpdate(): void
    {
        $key = Flight::request()->query['key'];
        $key = self::sanitizeKey($key);
        $translation = Translation::find($key);

        Flight::render(self::FORM_VIEW, [
            'title' => "Edit \"$key\"",
            'action' => 'update',
            'button' => "Update",
            'button_icon' => '<i class="fas fa-check"></i>',
            'translation' => $translation,
            'langs' => Lang::all(),
        ]);
    }

    public static function renderDelete()
    {
        $key = Flight::request()->query['key'];
        $key = self::sanitizeKey($key);
        $translation = Translation::find($key);

        Flight::render(self::FORM_VIEW, [
            'title' => "Delete \"$key\"",
            'action' => 'delete',
            'button' => 'Delete translation',
            'button_apply' => 'bg-red-700 text-white',
            'button_icon' => '<i class="fas fa-trash"></i>',
            'translation' => $translation,
            'langs' => Lang::all(),
        ]);
    }
}
