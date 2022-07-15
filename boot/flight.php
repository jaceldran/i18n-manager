<?php

use eftec\bladeone\BladeOne;

define ('BLADE_VIEWS', APP_PATH."/src/Views");
define ('BLADE_COMPILED', APP_PATH."/.tmp/blade");

Flight::set('env', (object) $_ENV);

Flight::set('theme', (object) require APP_PATH.'/config/theme.php');

Flight::register('view', BladeOne::class, [
	BLADE_VIEWS,
	BLADE_COMPILED
], function(BladeOne $blade) {
	$blade->setPath(BLADE_VIEWS, BLADE_COMPILED);
	$blade->setBaseUrl(Flight::get('env')->URL_BASE);
});

Flight::map('render', function($template, $data){
    echo Flight::view()->run($template, $data);
});