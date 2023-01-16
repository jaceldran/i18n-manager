<?php

namespace App\Controllers;

use Flight;

final class Download extends Controller
{
    public static function index()
    {
        $data = self::commonData();

        Flight::render('download', $data);
    }
}
