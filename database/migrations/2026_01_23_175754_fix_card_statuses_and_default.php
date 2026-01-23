<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing 'received' status to 'Submission Complete'
        DB::table('submission_cards')->where('status', 'received')->update(['status' => 'Submission Complete']);

        Schema::table('submission_cards', function (Blueprint $table) {
            $table->string('status')->default('Submission Complete')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_cards', function (Blueprint $table) {
            $table->string('status')->default('received')->change();
        });
    }
};
