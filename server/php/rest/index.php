<?php

ob_start();

require_once("constants.php");

header('Access-Control-Allow-Origin: '.ALLOWED_ORIGINS);
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

error_reporting(E_ALL);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH),
    get_include_path(),
)));

// Define path to data directory
defined('APPLICATION_DATA')
    || define('APPLICATION_DATA', realpath(dirname(__FILE__) . '/../../data/logs'));

function __autoload($path) {
	return include str_replace('_', '/', $path) . '.php';
}

$rest = new Rest();
$rest->process();

ob_end_flush();

?>
