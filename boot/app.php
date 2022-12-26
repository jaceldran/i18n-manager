<?php

define('APP_PATH', str_replace('\\', '/', getcwd()));

require_once APP_PATH.'/vendor/autoload.php';
require_once APP_PATH.'/boot/dotenv.php';
require_once APP_PATH.'/boot/flight.php';
require_once APP_PATH.'/boot/routes.php';
