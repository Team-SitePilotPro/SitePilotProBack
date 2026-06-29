<?php

declare(strict_types=1);

namespace App\Enums;

enum WorksiteStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Finished = 'finished';
    case Canceled = 'canceled';

    public function title(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::InProgress => 'En cours',
            self::Finished => 'Terminé',
            self::Canceled => 'Annulé',
        };
    }
}
