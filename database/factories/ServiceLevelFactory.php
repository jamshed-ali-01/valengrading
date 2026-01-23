<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceLevel>
 */
class ServiceLevelFactory extends Factory
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
            'delivery_time' => '15-20 Business Days',
            'min_submission' => 5,
            'price_per_card' => $this->faker->randomFloat(2, 10, 100),
            'order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }

    public function standard(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Standard',
            'delivery_time' => '15-20 Business Days',
            'min_submission' => 5,
            'price_per_card' => 15.00,
            'order' => 1,
        ]);
    }

    public function express(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Express',
            'delivery_time' => '3-5 Business Days',
            'min_submission' => 5,
            'price_per_card' => 25.00,
            'order' => 2,
        ]);
    }

    public function elite(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Elite',
            'delivery_time' => '3-5 Business Days',
            'min_submission' => null, // Elite has no minimum
            'price_per_card' => 45.00,
            'order' => 3,
        ]);
    }
}
