<?php

declare(strict_types=1);

namespace App\Enums;

enum Unit: string
{
    case M2       = 'm2';
    case Hour     = 'hour';
    case FlatRate = 'flat_rate';
    case Ml       = 'ml';
    case Day      = 'day';
    case Unite    = 'unite';

    public function title(): string
    {
        return match ($this) {
            self::M2       => 'Mètre carré',
            self::Hour     => 'Heure',
            self::FlatRate => 'Forfait',
            self::Ml       => 'Mètre linéaire',
            self::Day      => 'Jour',
            self::Unite    => 'Unité',
        };
    }

}
