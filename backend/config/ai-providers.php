<?php

return [
    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL'),
        'timeout' => env('GEMINI_TIMEOUT', 120),
        'url' => 'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s'
    ],
];
