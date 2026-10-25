<?php

require_once __DIR__ . '/helper.php';

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($method, $path)
    {
        $allowedMethods = [];
        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            if ($routePath !== $path) {
                continue;
            }
            if ($routeMethod === $method) {
                $handler();
                send_json_response(['success' => false, 'message' => 'Respons endpoint belum tersedia.'], 500);
            }
            $allowedMethods[] = $routeMethod;
        }

        if ($allowedMethods !== []) {
            header('Allow: ' . implode(', ', array_unique($allowedMethods)));
            send_json_response(['success' => false, 'message' => 'Metode HTTP tidak diizinkan.'], 405);
        }

        send_json_response(['success' => false, 'message' => 'Endpoint tidak ditemukan.'], 404);
    }
}
