<?php

declare(strict_types=1);

namespace App\Enums;

enum WorksitePriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Critical = 'critical';

    public function title(): string
    {
        return match ($this) {
            self::Low => 'Basse',
            self::Medium => 'Moyen',
            self::High => 'Haute',
            self::Critical => 'Critique',
        };
    }

}
