<?php

use App\Controllers\Pages;
use App\Controllers\Translations;
use App\Controllers\Langs;
use App\Controllers\Configuration;
use App\Controllers\Sandbox;
use App\Controllers\Api\Langs as LangsApi;
use App\Controllers\Api\Translations as TranslationsApi;

// pages
Flight::route('GET /', [Pages::class, 'home']);
Flight::route('GET /readme', [Pages::class, 'readme']);
Flight::route('GET /translations', [Translations::class, 'index']);
Flight::route('GET /translations/download', [Translations::class, 'download']);
Flight::route('GET /langs', [Langs::class, 'index']);
Flight::route('GET /configuration/paths', [Configuration::class, 'paths']);
Flight::route('GET /configuration/env', [Configuration::class, 'env']);
Flight::route('GET /configuration/colorquotes', [Configuration::class, 'colorquotes']);
Flight::route('GET /configuration', [Configuration::class, 'index']);

// translations api

// renders api
Flight::route('GET /api/translations/render/import', [TranslationsApi::class, 'renderImport']);
Flight::route('GET /api/translations/render/create', [TranslationsApi::class, 'renderCreate']);
Flight::route('GET /api/translations/render/update', [TranslationsApi::class, 'renderUpdate']);
Flight::route('GET /api/translations/render/delete', [TranslationsApi::class, 'renderDelete']);

// actions api
Flight::route('PUT /api/translations', [TranslationsApi::class, 'put']);
Flight::route('POST /api/translations', [TranslationsApi::class, 'post']);
Flight::route('DELETE /api/translations', [TranslationsApi::class, 'delete']);
Flight::route('GET /api/translations/export', [TranslationsApi::class, 'export']);
Flight::route('POST /api/translations/import', [TranslationsApi::class, 'import']);
Flight::route('GET /api/translations/download', [TranslationsApi::class, 'download']);

// langs api
Flight::route('GET /api/langs/render/create', [LangsApi::class, 'renderCreate']);
Flight::route('POST /api/langs', [LangsApi::class, 'post']);
Flight::route('DELETE /api/langs', [LangsApi::class, 'delete']);
Flight::route('PUT /api/langs', [LangsApi::class, 'put']);
Flight::route('PUT /api/langs/order', [LangsApi::class, 'order']);

Flight::route('GET /sandbox', [Sandbox::class, 'index']);
