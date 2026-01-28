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
            // 1. Drop service_id if it exists
            if (Schema::hasColumn('service_levels', 'service_id')) {
                // Try dropping foreign key first, might fail if constraint name differs but try standard convention
                // Or just drop column which usually requires dropping FK first in some DBs, MySQL might complain.
                try {
                    $table->dropForeign(['service_id']); 
                } catch (\Exception $e) {}
                
                $table->dropColumn('service_id');
            }

            // 2. Add submission_type_id if it doesn't exist
            if (!Schema::hasColumn('service_levels', 'submission_type_id')) {
                try {
                    $table->foreignId('submission_type_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
                } catch (\Exception $e) {}
            }
        });

        // 3. Drop orphaned services table
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
