<?php

use App\Enums\QuoteStatus;
use App\Enums\TvaRate;
use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Client::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('quote_number')->unique();
            $table->dateTime('issue_date');
            $table->dateTime('validity_date');
            $table->enum('quote_status', array_column(QuoteStatus::cases(), 'value')
            )->default(QuoteStatus::Draft->value);
            $table->integer('subtotal_ht');
            $table->integer('total_ttc');
            $table->enum('tva_rate', array_column(TvaRate::cases(), 'value')
            )->default(TvaRate::Taux20->value);
            $table->integer('tva_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
