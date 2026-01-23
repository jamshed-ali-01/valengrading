<?php

namespace Database\Seeders;

use App\Models\SubmissionType;
use Illuminate\Database\Seeder;

class SubmissionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Grading',
                'title' => 'Grading',
                'description' => 'Standard grading service for your cards.',
                'order' => 1,
            ],
            [
                'name' => 'Reholder',
                'title' => 'Reholder',
                'description' => 'Reholder your already graded cards.',
                'order' => 2,
            ],
            [
                'name' => 'Crossover',
                'title' => 'Crossover',
                'description' => 'Cross over cards from other grading companies.',
                'order' => 3,
            ],
            [
                'name' => 'Authentication',
                'title' => 'Authentication',
                'description' => 'Authenticate your cards without grading.',
                'order' => 4,
            ],
        ];

        foreach ($types as $type) {
            SubmissionType::updateOrCreate(['name' => $type['name']], $type);
        }
    }
}
