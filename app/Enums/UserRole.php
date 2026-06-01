<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
    case SiteManager = 'site_manager';
    case SalesRepresentative = 'sales_representative';
    case SiteSupervisor = 'site_supervisor';

    public function title(): string
    {
        return match ($this) {
            self::Admin => 'Administrateur',
            self::User => 'Utilisateur',
            self::SiteManager => 'chef de chantier',
            self::SalesRepresentative => 'Commerciale',
            self::SiteSupervisor => 'Conducteur de travaux',
        };
    }
}
