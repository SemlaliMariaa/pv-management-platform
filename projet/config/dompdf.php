<?php

return [
    'defaultFont' => 'amiri',

    'enable_unicode' => true,
    'fontDir' => storage_path('fonts/'),
    'fontCache' => storage_path('fonts/'),

    'isRemoteEnabled' => true,
    'isHtml5ParserEnabled' => true,

    'fonts' => [
        'amiri' => [
            'R' => 'Amiri-Regular.ttf',
            'B' => 'Amiri-Bold.ttf',
            'I' => 'Amiri-Italic.ttf',
            'BI' => 'Amiri-BoldItalic.ttf',
        ],
    ],
];
