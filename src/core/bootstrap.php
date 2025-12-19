<?php
// src/core/bootstrap.php

// Detectar entorno (puede venir de config.php, env, etc.)
$env = defined('APP_ENV') ? APP_ENV : 'prod';

if ($env === 'dev') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
}

Session::start();
