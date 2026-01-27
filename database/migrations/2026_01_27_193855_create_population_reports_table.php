<?php

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
        Schema::create('population_reports', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('brand')->nullable();
            $table->string('set_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('title');
            $table->string('rarity')->nullable();
            $table->string('grade'); // Storing '10', '9.5', etc.
            $table->timestamps();

            $table->index(['title', 'set_name', 'card_number']);
            $table->index('grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_reports');
    }
};
