<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Guatemala");

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require APP . 'libs/medoo.php';
require APP . 'config/config.php';
require APP . 'libs/helper.php';
require APP . 'core/application.php';
require APP . 'core/controller.php';

$app = new application();
