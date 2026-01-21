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
        Schema::create('submission_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Grading, Reholder, Crossover, Authentication
            $table->string('title')->nullable(); // Optional title for display
            $table->string('description')->nullable();
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
        Schema::dropIfExists('submission_types');
    }
};
