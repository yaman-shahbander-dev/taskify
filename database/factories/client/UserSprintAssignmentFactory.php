<?php

namespace Database\Factories\client;

use App\Domain\Project\Models\Sprint;
use App\Domain\Project\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSprintAssignmentFactory extends Factory
{
    protected $model = \App\Domain\Client\Models\UserSprintAssignment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'sprint_id' => Sprint::query()->inRandomOrder()->first()->id,
            'task_id' => Task::query()->inRandomOrder()->first()->id,
            'user_id' => \App\Domain\Client\Models\User::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
