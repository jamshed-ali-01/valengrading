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
            $table->string('cert_number')->nullable()->unique()->after('id');
            $table->string('grade')->nullable()->after('notes');
            $table->decimal('centering', 3, 1)->nullable()->after('grade');
            $table->decimal('corners', 3, 1)->nullable()->after('centering');
            $table->decimal('edges', 3, 1)->nullable()->after('corners');
            $table->decimal('surface', 3, 1)->nullable()->after('edges');
            $table->text('grading_insights')->nullable()->after('surface');
            $table->string('grading_image')->nullable()->after('grading_insights');
            $table->string('qr_code_token')->nullable()->unique()->after('grading_image');
            $table->boolean('is_revealed')->default(false)->after('qr_code_token');
            $table->string('grading_report_path')->nullable()->after('is_revealed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_cards', function (Blueprint $table) {
            $table->dropColumn([
                'cert_number',
                'grade',
                'centering',
                'corners',
                'edges',
                'surface',
                'grading_insights',
                'grading_image',
                'qr_code_token',
                'is_revealed',
                'grading_report_path'
            ]);
        });
    }
};
