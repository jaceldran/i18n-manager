<?php

namespace App\Controllers;

use Flight;

use App\Models\Lang;
use App\Models\Translation;

class Langs extends Controller
{
    public static function index()
    {
        $data = self::commonData();
        $data['langs'] = Lang::all();
        $data['count'] = Translation::countByLang();

        Flight::render('langs.index', $data);
    }
}
