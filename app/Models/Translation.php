<?php

namespace App\Models;

use App\Services\Datafile;
use App\Models\Lang;

final class Translation
{
    const DATABASE_PATH = APP_PATH . "/database";
    const PATH = self::DATABASE_PATH . "/translations.php";
    const KEY = 'key';

    public static function all(): array
    {
        $data = Datafile::readPhp(self::PATH);
        ksort($data);
        return self::compute($data);
    }

    public static function find(string $key): array
    {
        $data = Datafile::readPhp(self::PATH);

        if (isset($data[$key])) {
            $values = ['key' => $key] + $data[$key];
        } else {
            $data = self::compute([$key => []]);
            $values = array_pop($data);
        }

        $group = $key;
        $parts = explode('.', $key);
        if (count($parts) > 1) {
            array_pop($parts);
            $group = implode('.', $parts);
        }
        $values['group'] = $group;

        return $values;
    }

    public static function updateOrCreate(string $key, array $translations): void
    {
        $data = Datafile::readPhp(self::PATH);

        if (isset($data[$key])) {
            $translations = array_merge($data[$key], $translations);
        }

        $data[$key] = $translations;

        Datafile::writePhp(self::PATH, $data);
    }

    public static function delete(string $key): void
    {
        $data = Datafile::readPhp(self::PATH);

        if (!isset($data[$key])) {
            return;
        }

        unset($data[$key]);

        Datafile::writePhp(self::PATH, $data);
    }

    public static function compute(array $data): array
    {
        $rows = [];
        $keyLangs = array_fill_keys(Lang::keys(), '');

        foreach ($data as $key => $values) {
            $row = ['key' => $key];
            $translations = array_merge($keyLangs, $values);
            $row += $translations;
            $rows[$key] = $row;
        }

        return $rows;
    }

    public static function countByLang(): array
    {
        $count = [];
        $data  = Datafile::readPhp(self::PATH);
        $langs = Lang::all();

        foreach ($langs as $lang => $config) {
            $dictionary = array_column($data, $lang);
            $filled = array_filter($dictionary, function ($value) {
                return !empty($value);
            });
            $count[$lang] = count($filled);
        }

        return $count;
    }

    public static function getGroup(string $groupId): array
    {
        $data = self::byGroup(self::all());

        return $data[$groupId] ?? [];
    }

    public static function byGroup(array $data): array
    {
        $groups = [];

        foreach ($data as $code => $values) {
            $parts = explode('.', $code);
            $code = array_pop($parts);
            $group = implode('.', $parts);

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
            foreach ($values as $lang => $translation) {
                $groups[$lang][$key] = $translation;
            }
        }
        return $groups;
    }

    public static function export(): array
    {
        $exported = [];
        $paths = Path::all();
        $langs = Lang::keys();
        $translations = self::all();
        $translationsByLang = self::byLang($translations);

        $jsonPath = $paths->{Path::EXPORT_JSON};
        $phpPath = $paths->{Path::EXPORT_PHP};
        $csvPath = $paths->{Path::EXPORT_CSV};

        Datafile::writePhp("$phpPath/all.php", $translations);
        Datafile::writeJson("$jsonPath/all.json", $translations);
        Datafile::writeCsv("$csvPath/all.csv", $translations);

        $exported[$phpPath][] = "$phpPath/all.php";
        $exported[$jsonPath][] = "$phpPath/all.json";
        $exported[$csvPath][] = "$phpPath/all.csv";

        foreach ($translationsByLang as $lang => $data) {
            if (!in_array($lang, $langs)) {
                continue;
            }

            Datafile::writePhp("$phpPath/$lang.php", $data);
            Datafile::writeJson("$jsonPath/$lang.json", $data);
            $exported[$phpPath][] = "$phpPath/$lang.php";
            $exported[$jsonPath][] = "$phpPath/$lang.json";
        }

        return $exported;
    }

    public static function importCsv(string $path): array
    {
        // read csv and transform to key => translations[] format
        $rows = Datafile::readCsv($path);
        $keys = array_shift($rows);
        array_shift($keys);

        $countKeys = count($keys);
        foreach ($rows as $values) {
            $key = array_shift($values);

            if (count($values) !== $countKeys) {
                continue;
            }

            $csv[$key] = array_combine($keys, $values);
        }

        // update current data
        $data = self::all();

        // preserve previous version
        $copyPath = self::DATABASE_PATH . "/translations-" . date('Y-m-d-h-i-s') . ".php";
        Datafile::writePhp($copyPath, $data);

        array_walk($csv, function ($values, $key) use (&$data) {
            if (!isset($data[$key])) {
                $data[$key] = $values;
                return;
            }

            foreach ($values as $k => $v) {
                if (empty($v)) {
                    continue;
                }

                $concat = [$v => $v];

                $stored = $data[$key][$k] ?? '';
                if ($stored && !empty($stored)) {
                    $concat[$stored] = $stored;
                }

                $data[$key][$k] = implode(' / ', $concat);
            }

            unset($data[$key][self::KEY]);
        });

        // store updated data
        Datafile::writePhp(self::PATH, $data);

        return $data;
    }
}
