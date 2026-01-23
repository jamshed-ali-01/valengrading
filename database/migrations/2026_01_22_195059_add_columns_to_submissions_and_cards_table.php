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
        Schema::table('submissions', function (Blueprint $table) {
            $table->foreignId('label_type_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::table('submission_cards', function (Blueprint $table) {
            $table->foreignId('label_type_id')->nullable()->constrained()->nullOnDelete();
            // 'lang' is already in create_submission_cards_table? checking next.
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['label_type_id']);
            $table->dropColumn('label_type_id');
        });

        Schema::table('submission_cards', function (Blueprint $table) {
             $table->dropForeign(['label_type_id']);
             $table->dropColumn('label_type_id');
        });
    }
};
