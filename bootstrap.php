<?php

require_once __DIR__ . '/helper/helper.php';

set_exception_handler(function ($exception) {
    error_log(get_class($exception) . ': ' . $exception->getMessage());
    send_json_response([
        'success' => false,
        'message' => 'Terjadi kesalahan pada server.',
    ], 500);
});

set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return false;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$appConfig = require __DIR__ . '/config/app.php';
date_default_timezone_set($appConfig['timezone']);

return $appConfig;
