<?php

declare(strict_types=1);

namespace App\Enums;

enum ClientType: string
{
    case Pro = 'pro';
    case Private = 'private';

    public function title(): string
    {
        return match ($this) {
            self::Pro => 'Professionnel',
            self::Private => 'Particulier',
        };
    }
}


