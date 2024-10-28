<?php

namespace Database\Factories\client;

use App\Models\client\User;
use App\Models\client\UserSprintAssignment;
use App\Models\project\Sprint;
use App\Models\project\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSprintAssignmentFactory extends Factory
{
    protected $model = UserSprintAssignment::class;

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
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
