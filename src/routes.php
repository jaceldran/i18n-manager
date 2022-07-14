<?php

use App\Controllers\Home;
use App\Controllers\Translations;
use App\Controllers\Upload;
use App\Controllers\Download;
use App\Controllers\Config;
use App\Controllers\Entries;
use App\Controllers\Langs;
use App\Controllers\Sandbox;

Flight::route('/',[Home::class, 'index']);
Flight::route('/translations',[Translations::class, 'index']);
Flight::route('/upload',[Upload::class, 'index']);
Flight::route('/download',[Download::class, 'index']);

Flight::route('/config',[Config::class, 'index']);
Flight::route('/config/langs',[Config::class, 'langs']);

Flight::route('/sandbox',[Sandbox::class, 'index']);


// api
Flight::route('PUT /api/entries',[Entries::class, 'put']);
Flight::route('PUT /api/langs',[Langs::class, 'put']);
Flight::route('PUT /api/langs/order',[Langs::class, 'order']);
