<?php

declare(strict_types=1);

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Client;
use App\Models\Quote;
use App\Models\Worksite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_clients', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Client::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Worksite::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Quote::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->dateTime('delivery_date');
            $table->string('number_invoice');
            $table->string('invoice_description');
            $table->integer('total_ht');
            $table->enum('payment_status', array_column(PaymentStatus::cases(), 'value')
            )->default(PaymentStatus::Pending->value);
            $table->dateTime('payment_date')->nullable();
            $table->enum('payment_method', array_column(PaymentMethod::cases(), 'value')
            )->default(PaymentMethod::Other->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_clients');
    }
};
