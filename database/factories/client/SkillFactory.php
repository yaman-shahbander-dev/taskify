<?php

namespace Database\Factories\client;

use App\Models\client\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

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
