<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmissionType>
 */
class SubmissionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }

    public function grading(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Grading',
            'title' => 'Grading Service',
            'description' => 'Professional card grading service',
            'order' => 1,
        ]);
    }

    public function reholder(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Reholder',
            'title' => 'Reholder Service',
            'description' => 'Transfer card to a new holder',
            'order' => 2,
        ]);
    }

    public function crossover(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Crossover',
            'title' => 'Crossover Service',
            'description' => 'Cross-grade service between different grading companies',
            'order' => 3,
        ]);
    }

    public function authentication(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Authentication',
            'title' => 'Authentication Service',
            'description' => 'Verification of authenticity and originality for your valuable cards.',
            'order' => 4,
        ]);
    }
}
