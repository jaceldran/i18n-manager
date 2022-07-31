<?php

use eftec\bladeone\BladeOne;

define ('BLADE_VIEWS', APP_PATH."/app/Views");
define ('BLADE_COMPILED', APP_PATH."/.tmp/blade");

Flight::set('env', (object) $_ENV);

Flight::set('theme', (object) require APP_PATH.'/config/theme.php');

Flight::map('download',function(string $path) {
	if (file_exists($path)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($path).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($path));
		readfile($path);
		exit;
	}
});

Flight::register('view', BladeOne::class, [
	BLADE_VIEWS,
	BLADE_COMPILED
], function(BladeOne $blade) {
	$blade->setPath(BLADE_VIEWS, BLADE_COMPILED);
	$blade->setBaseUrl(Flight::get('env')->URL_BASE);

	if ($_ENV['ENV']==='develop') {
		$blade->setMode(BladeOne::MODE_SLOW);
	}
});

Flight::map('render', function($template, $data, $return=false){
	if ($return) {
		return Flight::view()->run($template, $data);
	}
    echo Flight::view()->run($template, $data);
});