<?php

namespace App\Controllers;

use Flight;
use App\Models\Lang;
use App\Models\Translation;

final class Translations extends Controller
{
    public static function index()
    {
        $translations = Translation::all();
        $langs = Lang::all();

        $data = self::commonData();
        $data['langs'] = $langs;
        $data['visible_langs'] = count(array_filter($langs, function ($lang) {
            return $lang['visible'];
        }));
        $data['translations'] = Translation::byGroup($translations);

        Flight::render('translations.index', $data);
    }

    public static function download()
    {
        Flight::download(APP_PATH . "/.tmp/translations.zip");
    }
}
