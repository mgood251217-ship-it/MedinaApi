<?php

require_once __DIR__ . '/../controllers/HealthController.php';

return [
    ['GET', '/', [HealthController::class, 'show']],
    ['GET', '/api/health', [HealthController::class, 'show']],
];
