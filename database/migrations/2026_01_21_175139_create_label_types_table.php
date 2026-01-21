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
        Schema::create('label_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Classic, Premium, Custom
            $table->string('description')->nullable(); // For display
            $table->decimal('price_adjustment', 8, 2)->default(0); // +10, +5, Free (0)
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
        Schema::dropIfExists('label_types');
    }
};
