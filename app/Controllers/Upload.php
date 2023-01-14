<?php

namespace App\Controllers;

use Flight;

class Upload extends Controller
{
    public static function index()
    {
        $data = self::commonData();

        Flight::render('upload', $data);
    }
}
