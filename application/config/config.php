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
define('IMAGES',URL."img".URL_PROTOCOL);
define('NOW', date("Y-m-d H:i:s"));


define('SPANISH', URL."assets/js/plugins/dataTables/spanish.json");

if(isset($_SESSION["usuarioId"])){
    define('USER', $_SESSION["id"]);
    define('USERNAME',$_SESSION["name"]);
}


define('DB_TYPE', 'mysql');
define('DB_HOST', '172.20.0.1');
define('DB_NAME', 'eventos');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');