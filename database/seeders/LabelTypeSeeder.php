<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabelType;

class LabelTypeSeeder extends Seeder
{
    public function run(): void
    {
        LabelType::updateOrCreate(['name' => 'Standard'], [
            'price_adjustment' => 0.00,
            'description' => 'Standard black label',
            'is_active' => true,
        ]);

        LabelType::updateOrCreate(['name' => 'Classic'], [
            'price_adjustment' => 0.00,
            'description' => 'Classic blue label',
            'is_active' => true,
        ]);
        
        LabelType::updateOrCreate(['name' => 'Color Match'], [
            'price_adjustment' => 5.00,
            'description' => 'Label color matches card',
            'is_active' => true,
        ]);
    }
}
