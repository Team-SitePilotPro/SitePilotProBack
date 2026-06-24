<?php

declare(strict_types=1);

return [
    'currency' => env('MONEY_DEFAULT_CURRENCY', 'EUR'),
    'locale' => 'fr_FR',
    'currencies' => [
        'iso' => ['EUR', 'USD'],
    ],
];
