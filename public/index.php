<?php

// [긴급 패치] APP_KEY 환경 변수 로딩 문제 우회
$key = 'base64:i0sEWcW/MYbkbmFRLCOU1s/e7DE30cGt6h4uQmCvj2k=';
putenv("APP_KEY={$key}");
$_ENV['APP_KEY'] = $key;
$_SERVER['APP_KEY'] = $key;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
