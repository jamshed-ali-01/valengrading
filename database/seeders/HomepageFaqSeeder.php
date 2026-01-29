<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class HomepageFaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'category' => 'General',
                'question' => 'What are your grading fees?',
                'answer' => 'Our grading fees vary depending on the service level and turnaround time you choose. Please visit our Pricing page for the most up-to-date information.',
                'order' => 1,
                'show_on_home' => true,
            ],
            [
                'category' => 'General',
                'question' => 'What cards do you grade?',
                'answer' => 'We currently grade most standard trading cards, including sports cards (Baseball, Basketball, Football, Soccer, etc.) and TCG cards (Pokémon, Magic: The Gathering, Yu-Gi-Oh!, etc.).',
                'order' => 2,
                'show_on_home' => true,
            ],
            [
                'category' => 'General',
                'question' => 'How does the grading scale work?',
                'answer' => 'We use a standard 1-10 grading scale, with 10 being Gem Mint. Our grading standards are rigorous and consistent with industry leaders.',
                'order' => 3,
                'show_on_home' => true,
            ],
            [
                'category' => 'Shipping & Packaging',
                'question' => 'Are my cards insured being graded?',
                'answer' => 'Yes, all submissions are fully insured while in our possession and during return shipping, based on the declared value of your items.',
                'order' => 4,
                'show_on_home' => true,
            ],
            [
                'category' => 'Services',
                'question' => 'Can I track my submission?',
                'answer' => 'Absolutely. You can track the real-time status of your submission through your dashboard at any time.',
                'order' => 5,
                'show_on_home' => true,
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
