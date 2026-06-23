<?php

declare(strict_types=1);

namespace App\Enums;

enum QuoteStatus: string
{
    case Draft = 'draft';
    case Send = 'send';
    case Accept = 'accept';
    case Decline = 'decline';
    case Expire = 'expire';

    public function title(): string
    {
        return match ($this) {
            self::Draft => 'Brouillon',
            self::Send => 'Envoyé',
            self::Accept => 'Accepté',
            self::Decline => 'Refusé',
            self::Expire => 'Expiré',
        };
    }
}
