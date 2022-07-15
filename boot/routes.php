<?php

use App\Controllers\Home;
use App\Controllers\Translations;
use App\Controllers\Langs;
// use App\Controllers\Upload;
// use App\Controllers\Download;
use App\Controllers\Configuration;
use App\Controllers\Sandbox;

use App\Controllers\Api\Langs as LangsApi;
use App\Controllers\Api\Translations as TranslationsApi;

Flight::route('/',[Home::class, 'index']);
Flight::route('/translations',[Translations::class, 'index']);
Flight::route('/langs',[Langs::class, 'index']);

// Flight::route('/upload',[Upload::class, 'index']);
// Flight::route('/download',[Download::class, 'index']);

Flight::route('/configuration',[Configuration::class, 'index']);
// Flight::route('/configuration/langs',[Configuration::class, 'langs']);
Flight::route('/configuration/paths',[Configuration::class, 'paths']);

// api
Flight::route('PUT /api/translations',[TranslationsApi::class, 'put']);
Flight::route('PUT /api/langs',[LangsApi::class, 'put']);
Flight::route('PUT /api/langs/order',[LangsApi::class, 'order']);

Flight::route('/sandbox',[Sandbox::class, 'index']);