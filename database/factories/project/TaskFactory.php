<?php

namespace Database\Factories\project;

use App\Domain\Client\Models\User;
use App\Domain\Project\Models\PriorityLevel;
use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = \App\Domain\Project\Models\Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => Project::query()->inRandomOrder()->first()->id,
            'priority_id' => PriorityLevel::query()->inRandomOrder()->first()->id,
            'assigned_to' => User::query()->inRandomOrder()->first()->id,
            'title' => fake()->word,
            'description' => fake()->sentence,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
