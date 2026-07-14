<?php
// ============================================
// Enviroment error handling
//
// deafult to production safe where errors are hidden from users no leakage
// ============================================

$appEnv = getenv('APP_ENV') ?: ($_SERVER['APP_ENV'] ?? 'production');

if ($appEnv === 'development') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}

// always log errors server side, regardless of environment.
ini_set('log_errors', '1');
