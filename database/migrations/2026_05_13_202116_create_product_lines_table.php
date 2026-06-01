<?php

use App\Enums\TvaRate;
use App\Enums\Unit;
use App\Models\Quote;
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
        Schema::create('product_lines', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Quote::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('description');
            $table->integer('quantity');
            $table->enum('unit', array_column(Unit::cases(), 'value'));
            $table->integer('unit_price_ht');
            $table->enum('tva_rate', array_column(TvaRate::cases(), 'value'));
            $table->integer('total_ht');
            $table->integer('total_ttc');
            $table->integer('sort_order');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_lines');
    }
};
