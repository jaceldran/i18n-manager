<?php

use eftec\bladeone\BladeOne;
use Symfony\Component\Dotenv\Dotenv;

/** autoload */
require 'vendor/autoload.php';

/** env & config */

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
Flight::set('env', (object) $_ENV);

Flight::set('phinx_config', require_once './config/phinx.php');

/** paths */

$base_path = str_replace('\\', '/', getcwd());
define ('BASE_PATH', $base_path);
define ('PATH_DATA_LANGS', "$base_path/data/i18n/langs.php");
define ('PATH_DATA_ENTRIES', "$base_path/data/i18n/entries.php");
define ('BLADE_VIEWS', "$base_path/src/Views");
define ('BLADE_COMPILED', "$base_path/.tmp/blade");

/** view engine */
Flight::register('view', BladeOne::class, [
	BLADE_VIEWS,
	BLADE_COMPILED
], function(BladeOne $blade) {
	$blade->setPath(BLADE_VIEWS, BLADE_COMPILED);
});
Flight::map('render', function($template, $data){
    echo Flight::view()->run($template, $data);
});

/** routes */
require './src/routes.php';