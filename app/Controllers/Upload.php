<?php

namespace App\Controllers;

use Flight;

final class Upload extends Controller
{
    public static function index()
    {
        $data = self::commonData();

        Flight::render('upload', $data);
    }
}
