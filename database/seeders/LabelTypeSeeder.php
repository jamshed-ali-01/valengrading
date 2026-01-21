<?php

namespace Database\Seeders;

use App\Models\LabelType;
use Illuminate\Database\Seeder;

class LabelTypeSeeder extends Seeder
{
    public function run(): void
    {
        LabelType::factory()->classic()->create();
        LabelType::factory()->premium()->create();
        LabelType::factory()->custom()->create();
    }
}