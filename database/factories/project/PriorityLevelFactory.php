<?php

namespace Database\Factories\project;

use App\Models\project\PriorityLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriorityLevelFactory extends Factory
{
    protected $model = PriorityLevel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->name,
            'description' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
