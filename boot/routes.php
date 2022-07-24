<?php

use App\Controllers\Home;
use App\Controllers\Translations;
use App\Controllers\Langs;
use App\Controllers\Configuration;
use App\Controllers\Sandbox;
use App\Controllers\Api\Langs as LangsApi;
use App\Controllers\Api\Translations as TranslationsApi;

// pages
Flight::route('/',[Home::class, 'index']);

Flight::route('/translations',[Translations::class, 'index']);
Flight::route('/translations/download',[Translations::class, 'download']);

Flight::route('/langs',[Langs::class, 'index']);

Flight::route('/configuration/paths',[Configuration::class, 'paths']);
Flight::route('/configuration/env',[Configuration::class, 'env']);
Flight::route('/configuration',[Configuration::class, 'index']);

// translations api

// renders
Flight::route('GET /api/translations/render/import',[TranslationsApi::class, 'renderImport']);
Flight::route('GET /api/translations/render/create',[TranslationsApi::class, 'renderCreate']);
Flight::route('GET /api/translations/render/update',[TranslationsApi::class, 'renderUpdate']);
Flight::route('GET /api/translations/render/delete',[TranslationsApi::class, 'renderDelete']);

// actions
Flight::route('PUT /api/translations',[TranslationsApi::class, 'put']);
Flight::route('POST /api/translations',[TranslationsApi::class, 'post']);
Flight::route('DELETE /api/translations',[TranslationsApi::class, 'delete']);
Flight::route('GET /api/translations/export',[TranslationsApi::class, 'export']);
Flight::route('POST /api/translations/import',[TranslationsApi::class, 'import']);
Flight::route('GET /api/translations/download',[TranslationsApi::class, 'download']);

// langs api
Flight::route('PUT /api/langs',[LangsApi::class, 'put']);
Flight::route('PUT /api/langs/order',[LangsApi::class, 'order']);


Flight::route('/sandbox',[Sandbox::class, 'index']);