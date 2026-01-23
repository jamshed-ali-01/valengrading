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
        Schema::create('service_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Standard, Express, Elite
            $table->string('delivery_time'); // 15-20 Business Days
            $table->integer('min_submission')->nullable(); // 5 cards minimum (number only)
            $table->decimal('price_per_card', 8, 2); // 15.00, 25.00, 45.00
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_levels');
    }
};
