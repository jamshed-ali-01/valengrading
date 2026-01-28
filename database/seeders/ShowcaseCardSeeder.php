<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShowcaseCard;

class ShowcaseCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            ['image_path' => 'images/card2.jpg', 'grade' => '10', 'order' => 1],
            ['image_path' => 'images/card3.jpg', 'grade' => '10', 'order' => 2],
            ['image_path' => 'images/card4.jpg', 'grade' => '10', 'order' => 3],
            ['image_path' => 'images/card5.jpg', 'grade' => '10', 'order' => 4],
            ['image_path' => 'images/card6.jpg', 'grade' => '10', 'order' => 5],
            ['image_path' => 'images/card7.jpg', 'grade' => '10', 'order' => 6],
        ];

        foreach ($cards as $card) {
            ShowcaseCard::create($card);
        }
    }
}
