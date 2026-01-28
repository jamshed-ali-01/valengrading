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
        Schema::table('service_levels', function (Blueprint $table) {
            // 1. Drop POTENTIAL bad foreign keys
            // The error said 'service_levels_service_id_foreign' was the issue.
            try {
                $table->dropForeign('service_levels_service_id_foreign');
            } catch (\Exception $e) {}

            try {
                $table->dropForeign(['service_id']);
            } catch (\Exception $e) {}

            // Also check if submission_type_id has a bad FK
            try {
                $table->dropForeign(['submission_type_id']);
            } catch (\Exception $e) {}


            // 2. Drop service_id column if it exists
            if (Schema::hasColumn('service_levels', 'service_id')) {
                $table->dropColumn('service_id');
            }

            // 3. Ensure submission_type_id exists and has CORRECT FK
            if (!Schema::hasColumn('service_levels', 'submission_type_id')) {
                 $table->foreignId('submission_type_id')->nullable()->after('id')->constrained('submission_types')->cascadeOnDelete();
            } else {
                // If column exists but might have bad FK, we already dropped FK above.
                // Now we need to add the CORRECT FK back.
                try {
                    $table->foreign('submission_type_id')->references('id')->on('submission_types')->cascadeOnDelete();
                } catch (\Exception $e) {}
            }
        });

        // 4. Force drop services table if it still exists
        Schema::dropIfExists('services');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_levels', function (Blueprint $table) {
            //
        });
    }
};
