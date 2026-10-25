<?php

require_once __DIR__ . '/../helper/helper.php';

class HealthController
{
    public static function show()
    {
        send_json_response([
            'success' => true,
            'message' => 'Medina API siap digunakan.',
            'data' => [
                'service' => 'Medina API',
                'status' => 'ok',
                'timestamp' => date(DATE_ATOM),
            ],
        ]);
    }
}
