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
        Schema::table('submission_cards', function (Blueprint $table) {
            $table->string('back_image')->nullable()->after('grading_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_cards', function (Blueprint $table) {
            $table->dropColumn('back_image');
        });
    }
};
