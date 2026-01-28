<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubmissionType;
use App\Models\ServiceLevel;

class RepairSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure Submission Types exist
        $grading = SubmissionType::firstOrCreate(
            ['name' => 'Trading Card Grading'],
            ['title' => 'Trading Card Grading', 'description' => 'Professional grading for your cards', 'order' => 1, 'is_active' => true]
        );

        $auto = SubmissionType::firstOrCreate(
            ['name' => 'Autograph Authentication'],
            ['title' => 'Autograph Authentication', 'description' => 'Verify authenticity of autographs', 'order' => 2, 'is_active' => true]
        );

        // 2. Ensure Service Levels exist and are linked
        if (ServiceLevel::count() == 0) {
            ServiceLevel::create([
                'submission_type_id' => $grading->id,
                'name' => 'Express',
                'delivery_time' => '5-7 Days',
                'min_submission' => 1,
                'price_per_card' => 50.00,
                'order' => 1,
                'is_active' => true,
            ]);

            ServiceLevel::create([
                'submission_type_id' => $grading->id,
                'name' => 'Standard',
                'delivery_time' => '15-20 Days',
                'min_submission' => 1,
                'price_per_card' => 25.00,
                'order' => 2,
                'is_active' => true,
            ]);

             ServiceLevel::create([
                'submission_type_id' => $grading->id,
                'name' => 'Bulk',
                'delivery_time' => '30-45 Days',
                'min_submission' => 20,
                'price_per_card' => 15.00,
                'order' => 3,
                'is_active' => true,
            ]);
        }
    }
}
