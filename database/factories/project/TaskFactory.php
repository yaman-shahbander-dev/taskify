<?php

namespace Database\Factories\project;

use App\Models\client\User;
use App\Models\project\PriorityLevel;
use App\Models\project\Project;
use App\Models\project\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;
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
