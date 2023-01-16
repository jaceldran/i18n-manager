<?php

namespace App\Controllers;

use Flight;

final class Home extends Controller
{
    public static function index()
    {
        $data = self::commonData();

        Flight::render('pages.home', $data);
    }
}
