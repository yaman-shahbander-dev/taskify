<?php

namespace Database\Factories\client;

use App\Domain\Client\Models\ProficiencyLevel;
use App\Domain\Client\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Client\Models\UserSkill;
use App\Domain\Client\Models\Skill;

class UserSkillFactory extends Factory
{
    protected $model = UserSkill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'skill_id' => Skill::query()->inRandomOrder()->first()->id,
            'proficiency_level_id' => ProficiencyLevel::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
