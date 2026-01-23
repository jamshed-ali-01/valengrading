<?php

namespace Database\Seeders;

use App\Models\ServiceLevel;
use Illuminate\Database\Seeder;

class ServiceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Standard',
                'delivery_time' => '15-20 Business Days',
                'min_submission' => 5,
                'price_per_card' => 15.00,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Express',
                'delivery_time' => '3-5 Business Days',
                'min_submission' => 5,
                'price_per_card' => 25.00,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Elite',
                'delivery_time' => '3-5 Business Days',
                'min_submission' => null, // No minimum
                'price_per_card' => 45.00,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($levels as $level) {
            ServiceLevel::updateOrCreate(['name' => $level['name']], $level);
        }
    }
}
