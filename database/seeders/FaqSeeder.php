<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run()
    {
        // Clear existing FAQs to prevent duplicates/confusion
        DB::table('faqs')->truncate();

        $faqs = [
            // Homepage FAQs (Order 1-5)
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
            ],

            // Other General FAQs (Order 6+)
            [
                'category' => 'General',
                'question' => 'What is card grading and why should I grade my cards?',
                'answer' => 'Card grading is the process of submitting your trading cards to a professional third-party service for authentication and condition evaluation. Grading encapsulates your card in a protective case (slab) and assigns it a numeric grade (1-10), which can significantly increase its value and liquidity.',
                'order' => 6,
                'show_on_home' => false,
            ],
            [
                'category' => 'General',
                'question' => 'Services Overview',
                'answer' => 'We offer various service levels ranging from Standard to Walk-Through, depending on your turnaround time needs and the declared value of your cards.',
                'order' => 7,
                'show_on_home' => false,
            ],
            [
                'category' => 'General',
                'question' => 'Contact Support',
                'answer' => 'You can reach our support team via email at support@valengrading.com or through our Contact page form. We typically respond within 24 hours.',
                'order' => 8,
                'show_on_home' => false,
            ],
            [
                'category' => 'Shipping & Packaging',
                'question' => 'How to ship cards safely?',
                'answer' => 'Shipping your cards securely is crucial. We recommend using penny sleeves and semi-rigid holders (Card Savers), sandwiched between cardboard and bubble wrap.',
                'order' => 9,
                'show_on_home' => false,
            ],
            [
                'category' => 'Shipping & Packaging',
                'question' => 'Return Shipping Carriers',
                'answer' => 'We use insured carriers for all return shipments. Signatures are required for high-value packages.',
                'order' => 10,
                'show_on_home' => false,
            ],
            [
                'category' => 'Shipping & Packaging',
                'question' => 'Shipping Questions',
                'answer' => 'If you have questions about a shipment, please contact our shipping department directly.',
                'order' => 11,
                'show_on_home' => false,
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
