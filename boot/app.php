<?php

define ('APP_PATH', str_replace('\\', '/', getcwd()));

require APP_PATH.'/vendor/autoload.php';
require APP_PATH.'/boot/dotenv.php';
require APP_PATH.'/boot/flight.php';
require APP_PATH.'/src/routes.php';
