<?php

return [

    'enabled' => env('WHATSAPP_ENABLED', FALSE),
    'api_key' => env('WHATSAPP_API_KEY'),
    'url' => env('WHATSAPP_URL'),

    'recipient' => [
        'medkraf' => [
            'group_name' => env('MEDKRAF_WA', 'Tes bot'),
            'is_group' => 'true'
        ]
    ]
];