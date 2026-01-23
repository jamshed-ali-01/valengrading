<?php

namespace Tests\Feature;

use App\Models\ServiceLevel;
use App\Models\SubmissionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed data
        $this->seed(\Database\Seeders\ServiceLevelSeeder::class);
        $this->seed(\Database\Seeders\SubmissionTypeSeeder::class);
    }

    public function test_step1_stores_session()
    {
        $type = SubmissionType::first();

        $response = $this->post(route('submission.storeStep1'), [
            'submission_name' => 'My Test Submission',
            'submission_type_id' => $type->id,
        ]);

        $response->assertRedirect(route('submission.step2'));
        $this->assertEquals('My Test Submission', session('submission_data.submission_name'));
    }

    public function test_step2_stores_session()
    {
        // Setup Step 1 data
        session(['submission_data' => ['submission_name' => 'Test', 'submission_type_id' => 1]]);

        $level = ServiceLevel::where('name', 'Standard')->first();

        $response = $this->post(route('submission.storeStep2'), [
            'service_level_id' => $level->id,
        ]);

        $response->assertRedirect(route('submission.step3'));
        $this->assertEquals($level->id, session('submission_data.service_level_id'));
    }

    public function test_step3_validates_min_cards()
    {
        $level = ServiceLevel::where('name', 'Standard')->first(); // Min 5
        session(['submission_data' => [
            'submission_name' => 'Test',
            'submission_type_id' => 1,
            'service_level_id' => $level->id,
        ]]);

        // Try with 4 cards (Easy mode)
        $response = $this->post(route('submission.storeStep3'), [
            'card_entry_mode' => 'easy',
            'total_cards' => 4,
        ]);

        $response->assertSessionHasErrors('total_cards');
    }

    public function test_step3_success_easy_mode()
    {
        $level = ServiceLevel::where('name', 'Standard')->first(); // Min 5
        session(['submission_data' => [
            'submission_name' => 'Test',
            'submission_type_id' => 1,
            'service_level_id' => $level->id,
        ]]);

        $response = $this->post(route('submission.storeStep3'), [
            'card_entry_mode' => 'easy',
            'total_cards' => 5,
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('submissions', [
            'guest_name' => 'Test',
            'total_cards' => 5,
            'card_entry_mode' => 'easy',
        ]);
    }

    public function test_step3_success_detailed_mode()
    {
        $level = ServiceLevel::where('name', 'Standard')->first();
        session(['submission_data' => [
            'submission_name' => 'Test',
            'submission_type_id' => 1,
            'service_level_id' => $level->id,
        ]]);

        $cards = [];
        for ($i = 0; $i < 5; $i++) {
            $cards[] = ['qty' => 1, 'title' => "Card $i"];
        }

        $response = $this->post(route('submission.storeStep3'), [
            'card_entry_mode' => 'detailed',
            'total_cards' => 1, // Ignored logic but passed by validated
            'cards' => $cards,
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('submissions', [
            'guest_name' => 'Test',
            'card_entry_mode' => 'detailed',
        ]);

        $this->assertDatabaseCount('submission_cards', 5);
    }
}
