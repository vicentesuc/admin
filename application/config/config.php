<?php
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
define('IMAGES', URL . "/public");
define('NOW', date("Y-m-d H:i:s"));
define('MODERATOR', 2);
define('EXPOSITOR', 1);


define('SPANISH', URL . "assets/js/plugins/dataTables/spanish.json");

if (isset($_SESSION["id"])) {
    define('USER', $_SESSION["id"]);
    define('USERNAME', $_SESSION["name"]);
}


define('DB_TYPE', 'mysql');
define('DB_HOST', '172.20.0.1');
define('DB_NAME', 'merckemc_eventos');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');

define('DIRECTORY_USER_MEDIA','media/user/');
define('DIRECTORY_SPEAKER_MEDIA','media/speaker/');
define('DIRECTORY_EVENTS_MEDIA','media/events/');
define('DIRECTORY_STANDS_MEDIA','media/events/stands/');

define('DIRECTORY_EVENTS_MEDIA_VIDEO','video/');
define('DIRECTORY_EVENTS_MEDIA_IMG','images/');
define('DIRECTORY_EVENTS_MEDIA_DOCS','docs/');