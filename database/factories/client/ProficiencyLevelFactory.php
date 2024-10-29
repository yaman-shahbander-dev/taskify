<?php

namespace Database\Factories\client;

use App\Domain\Client\Models\ProficiencyLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProficiencyLevelFactory extends Factory
{
    protected $model = ProficiencyLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
