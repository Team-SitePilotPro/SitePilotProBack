<?php

use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
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
        Schema::create('worksites', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Client::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->string('name_worksite');
            $table->text('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum(
                'worksite_priority', array_column(WorksitePriority::cases(), 'value')
            );
            $table->enum(
                'worksite_status', array_column(WorksiteStatus::cases(), 'value')
            )->default(WorksiteStatus::Pending->value);
            $table->string('street');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('country')->default('France');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worksites');
    }
};
