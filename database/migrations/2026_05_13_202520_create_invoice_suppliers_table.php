<?php

use App\Models\Worksite;
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
        Schema::create('invoice_suppliers', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Worksite::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->dateTime('delivery_date');
            $table->string('number_invoice');
            $table->string('invoice_description');
            $table->integer('purchase_price');
            $table->integer('cost_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_suppliers');
    }
};
