<?php

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
        // ── Utilisateurs ──────────────────────────────
        $admin = User::factory()->create();

        // ── Clients ───────────────────────────────────
        $clients = Client::factory(10)->create([
            'user_id' => fn () => $admin->id,
        ]);

        // ── Chantiers ─────────────────────────────────
        $worksites = Worksite::factory(15)->create([
            'client_id' => fn () => $clients->random()->id,
        ]);

        // Assigner des utilisateurs aux chantiers (pivot)
        $worksites->each(function (Worksite $worksite) use ($admin) {
            $worksite->users()->attach(
                $admin->id
            );
        });

        // ── Devis ─────────────────────────────────────
        $quotes = Quote::factory(20)->create([
            'client_id' => fn () => $clients->random()->id,
        ]);

        // Lignes produits par devis
        $quotes->each(function (Quote $quote) {
            ProductLine::factory(rand(2, 8))->create([
                'quote_id' => $quote->id,
            ]);
        });

        // Associer devis aux chantiers (pivot)
        $worksites->each(function (Worksite $worksite) use ($quotes) {
            $worksite->quotes()->attach(
                $quotes->random(rand(1, 3))->pluck('id')
            );
        });

        // ── Factures client ───────────────────────────
        $worksites->each(function (Worksite $worksite) {
            InvoiceClient::factory()->create([
                'worksite_id' => $worksite->id,
                'client_id' => $worksite->client_id,
            ]);
        });

        // ── Factures fournisseur ──────────────────────
        $worksites->each(function (Worksite $worksite) {
            InvoiceSupplier::factory(rand(1, 3))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Factures sous-traitant ────────────────────
        $worksites->each(function (Worksite $worksite) {
            InvoiceSubcontractor::factory(rand(1, 3))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Factures autres ───────────────────────────
        $worksites->each(function (Worksite $worksite) {
            InvoiceOther::factory(rand(1, 2))->create([
                'worksite_id' => $worksite->id,
            ]);
        });

        // ── Main d'oeuvre ──────────────────────────────
        $worksites->each(function (Worksite $worksite) {
            Workforce::factory(rand(2, 6))->create([
                'worksite_id' => $worksite->id,
            ]);
        });
    }
}
