<?php

// TODO : Activer lors d'une publication.
//error_reporting(0);

define('ROOT', realpath(dirname(__FILE__)) . '/');
define(ERROR_PAGE, ROOT . 'pages/' . 'error' . '.php');

define('DB_HOST', '172.16.16.88');
define('DB_NAME', 'WebBoutique');
define('DB_DSN', 'Driver={SQL SERVER}; Server=' . DB_HOST . '; Database=' . DB_NAME . ';');
define('DB_USERNAME', 'hlapointe');
define('DB_PASSWORD', 'hlapointe');