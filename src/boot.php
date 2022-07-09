<?php

use eftec\bladeone\BladeOne;

/** autoload */
require 'vendor/autoload.php';

/** env constants */
$base_path = str_replace('\\', '/', getcwd());
define ('BASE_PATH', $base_path);
define ('PATH_DATA_LANGS', "$base_path/data/i18n/langs.php");
define ('PATH_DATA_ENTRIES', "$base_path/data/i18n/entries.php");
define ('BLADE_VIEWS', "$base_path/src/Views");
define ('BLADE_COMPILED', "$base_path/data/blade");

/** view engine */
Flight::register('view', BladeOne::class, [], function(BladeOne $blade) {
	$blade->setPath(BLADE_VIEWS, BLADE_COMPILED);
});
Flight::map('render', function($template, $data){
    echo Flight::view()->run($template, $data);
});

/** routes */
require 'routes.php';