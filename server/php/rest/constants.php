<?php
$host = str_replace("www.", "", $_SERVER['HTTP_HOST']);

define('ALLOWED_ORIGINS', '*');
define('APPLICATION_NAME', 'Logger');

if($host == "localhost" || $host == "127.0.0.1"){	
	define('DB_HOST_ADDRESS', 'localhost');
	define('DB_USER_NAME', 'logger_user');
	define('DB_USER_PASSWORD', 'logger123');
	define('DB_NAME', 'logger');
} else {
	define('DB_HOST_ADDRESS', '94.73.146.206');
	define('DB_USER_NAME', 'cagdas');
	define('DB_USER_PASSWORD', 'CWpr08I7');
	define('DB_NAME', 'logger');
}

?>