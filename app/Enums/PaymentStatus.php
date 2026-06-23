<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Partial = 'partial';
    case Overdue = 'overdue';
    case Canceled = 'canceled';

    public function title(): string
    {
        return match ($this) {
            self::Pending => 'Paiement en attente',
            self::Paid => 'Paiement reçu',
            self::Partial => 'Paiement partiel reçu',
            self::Overdue => 'Paiement en retard',
            self::Canceled => 'Paiement annulé',
        };
    }
}
