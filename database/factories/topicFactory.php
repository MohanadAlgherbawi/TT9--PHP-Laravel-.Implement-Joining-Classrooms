<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class topicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->word(),
            'id' => fake()->unique()->randomNumber(5),
            'classroom_id' => fake()->numberBetween(1, 100), // Assuming classroom IDs are between 1 and 100
            'user_id' => fake()->numberBetween(1, 50), // Assuming user IDs are between 1 and 50
        ];
    }
}
