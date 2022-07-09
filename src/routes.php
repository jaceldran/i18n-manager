<?php

use App\Controllers\Manage;
use App\Controllers\Config;
use App\Controllers\Upload;
use App\Controllers\Download;
use App\Controllers\Entries;

Flight::route('/',[Manage::class, 'index']);
Flight::route('/manage',[Manage::class, 'index']);
Flight::route('/upload',[Upload::class, 'index']);
Flight::route('/download',[Download::class, 'index']);
Flight::route('/config',[Config::class, 'index']);

// api
Flight::route('PUT /api/entries',[Entries::class, 'put']);
