<?php

namespace Database\Factories\client;

use App\Domain\Client\Models\UserTask;
use App\Domain\Project\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTaskFactory extends Factory
{
    protected $model = UserTask::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'user_id' => \App\Domain\Client\Models\User::query()->inRandomOrder()->first()->id,
            'task_id' => Task::query()->inRandomOrder()->first()->id,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
