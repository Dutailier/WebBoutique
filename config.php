<?php

// WARNING : Activer lors d'une publication.
//error_reporting(0);

define('DIR', realpath(dirname(__FILE__)) . '/');
define('ERROR_PAGE', DIR . 'pages/' . 'error' . '.php');

define('DB_HOST', '172.16.16.88');
//define('DB_HOST', '205.237.52.212');
define('DB_NAME', 'WebBoutique');
define('DB_DSN', 'Driver={SQL SERVER}; Server=' . DB_HOST . '; Database=' . DB_NAME . ';');
define('DB_USERNAME', 'hlapointe');
define('DB_PASSWORD', 'hlapointe');

define('TOTAL_PRICE_MAX', 5000);