<?php

declare(strict_types=1);

return [
    'currency' => env('MONEY_DEFAULT_CURRENCY', 'EUR'),
    'locale' => 'fr_FR',
    'currencies' => [
        'EUR' => [
            'name' => 'Euro',
            'symbol' => '€',
            'decimal_separator' => ',',
            'thousands_separator' => ' ',
            'decimal_places' => 2,
        ],
        'USD' => [
            'name' => 'US Dollar',
            'symbol' => '$',
            'decimal_separator' => '.',
            'thousands_separator' => ',',
            'decimal_places' => 2,
        ],
    ],
];
