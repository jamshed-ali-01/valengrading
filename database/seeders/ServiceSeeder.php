<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Services
        $grading = \App\Models\Service::firstOrCreate(
            ['name' => 'Trading Card Grading'],
            ['description' => 'Professional grading for TCG cards.', 'order' => 1]
        );

        $auth = \App\Models\Service::firstOrCreate(
            ['name' => 'Autograph Authentication'],
            ['description' => 'Authentication for signed cards.', 'order' => 2]
        );

        // 2. Assign existing levels to "Grading" if unassigned
        \App\Models\ServiceLevel::whereNull('service_id')->update(['service_id' => $grading->id]);
    }
}
