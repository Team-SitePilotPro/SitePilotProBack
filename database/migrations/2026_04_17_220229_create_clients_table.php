<?php

use App\Enums\ClientType;
use App\Models\User;
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
        Schema::create('clients', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('contact_name');
            $table->string('private_name')->nullable();
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->string('phone');
            $table->enum(
                'clientType', array_column(ClientType::cases(), 'value')
            );
            $table->string('street');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('country')->default('France');
            $table->string('siret')->unique();
            $table->string('tva_intra')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
