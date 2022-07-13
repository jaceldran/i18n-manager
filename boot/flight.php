<?php

use eftec\bladeone\BladeOne;

define ('BLADE_VIEWS', APP_PATH."/src/Views");
define ('BLADE_COMPILED', APP_PATH."/.tmp/blade");

Flight::set('env', (object) $_ENV);

Flight::set('phinx_config', require_once APP_PATH.'/boot/phinx.php');

Flight::register('view', BladeOne::class, [
	BLADE_VIEWS,
	BLADE_COMPILED
], function(BladeOne $blade) {
	$blade->setPath(BLADE_VIEWS, BLADE_COMPILED);
});

Flight::map('render', function($template, $data){
    echo Flight::view()->run($template, $data);
});