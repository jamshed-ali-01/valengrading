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
        Schema::table('population_reports', function (Blueprint $table) {
            // Drop the old grade column
            $table->dropColumn('grade');
            
            // Add individual grade columns (1-10)
            $table->integer('grade_1')->default(0)->after('rarity');
            $table->integer('grade_2')->default(0)->after('grade_1');
            $table->integer('grade_3')->default(0)->after('grade_2');
            $table->integer('grade_4')->default(0)->after('grade_3');
            $table->integer('grade_5')->default(0)->after('grade_4');
            $table->integer('grade_6')->default(0)->after('grade_5');
            $table->integer('grade_7')->default(0)->after('grade_6');
            $table->integer('grade_8')->default(0)->after('grade_7');
            $table->integer('grade_9')->default(0)->after('grade_8');
            $table->integer('grade_10')->default(0)->after('grade_9');
            
            // Add total column
            $table->integer('total')->default(0)->after('grade_10');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('population_reports', function (Blueprint $table) {
            // Drop the new columns
            $table->dropColumn([
                'grade_1', 'grade_2', 'grade_3', 'grade_4', 'grade_5',
                'grade_6', 'grade_7', 'grade_8', 'grade_9', 'grade_10',
                'total'
            ]);
            
            // Restore the old grade column
            $table->string('grade')->nullable();
        });
    }
};
