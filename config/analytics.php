<?php

return [
    'tracking_enabled' => env('VIEWS_TRACKING_ENABLED', true),
    'cleanup_days' => env('VIEWS_CLEANUP_DAYS', 90),
    'session_timeout' => env('VIEWS_SESSION_TIMEOUT', 30), // minutes
    'rate_limiting' => [
        'enabled' => true,
        'max_requests' => 100,
        'per_minutes' => 60,
    ],
];