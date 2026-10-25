<?php

if (!function_exists('loadEnv')) {
    function loadEnv($path)
    {
        if (!is_file($path) || !is_readable($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) continue;

            $parts = explode('=', $line, 2);
            $name = trim($parts[0]);
            $value = trim($parts[1], " \t\n\r\0\x0B\"'");

            if ($name !== '') $_ENV[$name] = $value;
        }
    }
}

if (!function_exists('env')) {
    function env($name, $default = null)
    {
        if (array_key_exists($name, $_ENV)) return $_ENV[$name];

        $value = getenv($name);
        return $value === false ? $default : $value;
    }
}

loadEnv(__DIR__ . '/../.env');

function send_json_response($body = [], $status = 200)
{
    http_response_code($status);
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');

    if ($status === 204) {
        exit;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    exit;
}
