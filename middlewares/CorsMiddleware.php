<?php

require_once __DIR__ . '/../helper/helper.php';

class CorsMiddleware
{
    public static function handle($allowedOrigins)
    {
        header('Vary: Origin');
        $origin = $_SERVER['HTTP_ORIGIN'] ?? null;

        if ($origin !== null) {
            if (!in_array($origin, $allowedOrigins, true)) {
                send_json_response(['success' => false, 'message' => 'Origin tidak diizinkan.'], 403);
            }
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Methods: GET, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Accept');
        }

        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
            send_json_response([], 204);
        }
    }
}
