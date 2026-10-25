<?php

require_once __DIR__ . '/../helper/helper.php';

return [
    'name' => env('APP_NAME', 'Medina API'),
    'base_path' => env('APP_BASE_PATH', '/MedinaApi'),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'allowed_origins' => array_values(array_filter(array_map('trim', explode(',', env('APP_ALLOWED_ORIGINS', 'http://localhost:2212,http://127.0.0.1:2212'))))),
];
