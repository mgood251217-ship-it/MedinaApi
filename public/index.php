<?php

$config = require __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../helper/Router.php';
require_once __DIR__ . '/../middlewares/CorsMiddleware.php';

CorsMiddleware::handle($config['allowed_origins']);

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = rtrim($config['base_path'], '/');
foreach ([$basePath . '/public', $basePath] as $prefix) {
    if ($prefix !== '' && ($path === $prefix || str_starts_with($path, $prefix . '/'))) {
        $path = substr($path, strlen($prefix));
        break;
    }
}
$path = '/' . trim($path, '/');

$router = new Router(require __DIR__ . '/../routes/api.php');
$router->dispatch($method, $path);
