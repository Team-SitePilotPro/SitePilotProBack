<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethod: string
{
    case BankTransfer = 'bank_transfer';
    case Check = 'check';
    case Cash = 'cash';
    case CreditCard = 'credit_card';
    case DirectDebit = 'direct_debit';
    case Other = 'other';

    public function title(): string
    {
        return match ($this) {
            self::BankTransfer => 'Virement bancaire',
            self::Check => 'Chèque',
            self::Cash => 'Espèces',
            self::CreditCard => 'Carte bancaire',
            self::DirectDebit => 'Prélèvement automatique',
            self::Other => 'Autre',
        };
    }
}
