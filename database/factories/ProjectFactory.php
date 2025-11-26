<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(5),
            'leading' => fake()->paragraph(4),
            'content' => fake()->paragraph(20),
            'published_at' => fake()->boolean(80) ? fake()->dateTime() : null,
            'author_id' => fake()->numberBetween(1, 9),
        ];
    }
}
