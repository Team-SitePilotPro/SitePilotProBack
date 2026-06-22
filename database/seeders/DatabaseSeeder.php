<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Client;
use App\Models\InvoiceClient;
use App\Models\InvoiceOther;
use App\Models\InvoiceSubcontractor;
use App\Models\InvoiceSupplier;
use App\Models\ProductLine;
use App\Models\Quote;
use App\Models\User;
use App\Models\Workforce;
use App\Models\Worksite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'email'    => 'admin@sitepilot.fr',
            'password' => 'password',
        ]);

        $clients = Client::factory(10)->create([
            'user_id' => $admin->id,
        ]);

        $worksites = Worksite::factory(15)->create([
            'client_id' => fn () => $clients->random()->id,
        ]);

        // Assigner des utilisateurs aux chantiers (pivot)
        $worksites->each(function (Worksite $worksite) use ($admin): void {
            $worksite->users()->attach(
                $admin->id
            );
        });

        // ── Devis ─────────────────────────────────────
        $quotes = Quote::factory(20)->create([
            'client_id' => fn () => $clients->random()->id,
        ]);

        // Lignes produits par devis
        $quotes->each(function (Quote $quote): void {
            ProductLine::factory(random_int(2, 8))->create([
                'quote_id' => $quote->id,
            ]);
        });

        // Associer devis aux chantiers (pivot)
        $worksites->each(function (Worksite $worksite) use ($quotes): void {
            $worksite->quotes()->attach(
                $quotes->random(random_int(1, 3))->pluck('id')
            );
        });

        // ── Factures client ───────────────────────────
        $worksites->each(function (Worksite $worksite): void {
            InvoiceClient::factory()->create([
                'worksite_id' => $worksite->id,
                'client_id' => $worksite->client_id,
            ]);
        });

        // ── Factures fournisseur ──────────────────────
        $worksites->each(function (Worksite $worksite): void {
            InvoiceSupplier::factory(random_int(1, 3))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Factures sous-traitant ────────────────────
        $worksites->each(function (Worksite $worksite): void {
            InvoiceSubcontractor::factory(random_int(1, 3))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Factures autres ───────────────────────────
        $worksites->each(function (Worksite $worksite): void {
            InvoiceOther::factory(random_int(1, 2))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Main d'oeuvre ──────────────────────────────
        $worksites->each(function (Worksite $worksite): void {
            Workforce::factory(random_int(2, 6))->create([
                'worksite_id' => $worksite->id,
            ]);
        });
    }
}
