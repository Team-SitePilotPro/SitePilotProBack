<?php

declare(strict_types=1);

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
        Schema::create('workforces', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Worksite::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('code');
            $table->string('worker');
            $table->integer('hr_working')->nullable();
            $table->integer('hr_rate')->nullable();
            $table->integer('cost_hr_working')->nullable();
            $table->integer('additional_costs')->nullable();
            $table->integer('total_gross_cost')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workforces');
    }
};
