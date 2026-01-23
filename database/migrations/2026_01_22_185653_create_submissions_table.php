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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('submission_no')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('temp_guest_id')->nullable(); // For guest tracking
            $table->foreignId('service_level_id')->constrained();
            $table->foreignId('submission_type_id')->nullable()->constrained(); // Nullable initially
            $table->string('guest_name')->nullable(); // Captured in Step 1
            $table->string('status')->default('draft'); // draft, pending_payment, paid, processing, completed
            $table->enum('card_entry_mode', ['easy', 'detailed'])->default('easy');
            $table->integer('total_cards')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
