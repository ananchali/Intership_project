<?php

// Serve static files (compiled assets, images, favicon, etc.) before bootstrapping Laravel.
$publicPath = realpath(__DIR__ . '/../public');
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = $publicPath ? realpath($publicPath . $uri) : false;
if ($uri !== '/' && $publicPath && $file && is_file($file) && str_starts_with($file, $publicPath . DIRECTORY_SEPARATOR)) {
    $mime = function_exists('mime_content_type') ? mime_content_type($file) : false;
    if ($mime) {
        header('Content-Type: ' . $mime);
    }
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

use Illuminate\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

// Vercel-specific setup
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Vercel Lambda filesystems are read-only except /tmp, so redirect storage there.
$storagePath = sys_get_temp_dir() . '/storage';
$storageDirs = [
    'app',
    'framework',
    'framework/cache',
    'framework/cache/data',
    'framework/sessions',
    'framework/testing',
    'framework/views',
    'logs',
];
foreach ($storageDirs as $dir) {
    $target = $storagePath . '/' . $dir;
    if (!is_dir($target)) {
        mkdir($target, 0777, true);
    }
}
$app->useStoragePath($storagePath);

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);