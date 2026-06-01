<?php

declare(strict_types=1);

namespace App\Enums;

enum TvaRate: string
{
    case Taux0      = 'taux0';
    case Taux2_1    = 'taux2_1';
    case Taux5_5    = 'taux5_5';
    case Taux10     = 'taux10';
        case Taux20     = 'taux20';
    case Intracom   = 'intracom';
    case Extracom   = 'extracom';

    public function title(): string
    {
        return match ($this) {
            self::Taux0   => 'TVA exonéré',
            self::Taux2_1 => 'TVA 2,1%',
            self::Taux5_5 => 'TVA 5,5% (travaux amélioration énergétique)',
            self::Taux10  => 'TVA 10% (travaux de rénovation)',
            self::Taux20  => 'TVA 20% (taux normal)',
            self::Intracom => 'TVA intracommunautaire',
            self::Extracom => 'TVA extracommunautaire',
        };
    }

    public function numeric(): float
    {
        return match($this) {
            self::Taux0    => 0,
            self::Taux2_1  => 2.1,
            self::Taux5_5  => 5.5,
            self::Taux10   => 10,
            self::Taux20   => 20,
            self::Intracom => 0,
            self::Extracom => 0,
        };
    }

}
