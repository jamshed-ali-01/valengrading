<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabelType>
 */
class LabelTypeFactory extends Factory
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
            'description' => $this->faker->sentence(),
            'price_adjustment' => $this->faker->randomFloat(2, 0, 20),
            'order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }

    public function classic(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Classic',
            'description' => 'Classic (Free)',
            'price_adjustment' => 0.00,
            'order' => 1,
        ]);
    }

    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Premium',
            'description' => 'Premium (+5)',
            'price_adjustment' => 5.00,
            'order' => 2,
        ]);
    }

    public function custom(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Custom',
            'description' => 'Custom (+10)',
            'price_adjustment' => 10.00,
            'order' => 3,
        ]);
    }
}
