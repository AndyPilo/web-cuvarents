<?php
$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost');

if ($isLocal) {
    define('BASE_PATH', '/cuvarents/');
} else {
    define('BASE_PATH', '/');
}

$protocol = (
    !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
    || $_SERVER['SERVER_PORT'] == 443
) ? 'https://' : 'http://';

define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . BASE_PATH);

define('SITE_NAME', 'CuVaRents');
define('SITE_EMAIL', 'agenciacuvarents@gmail.com');
define('SITE_PHONE', '+53 753753082');

ini_set('display_errors', $isLocal ? 1 : 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
error_reporting(E_ALL);

require_once __DIR__ . '/database.php';

define('ASSETS_PATH', BASE_PATH . 'assets/');
define('IMG_PATH', ASSETS_PATH . 'img/');
define('CSS_PATH', ASSETS_PATH . 'css/');
define('JS_PATH', ASSETS_PATH . 'js/');
