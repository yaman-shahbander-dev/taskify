<?php

namespace Database\Factories\client;

use App\Domain\Project\Projections\Sprint;
use App\Domain\Project\Projections\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Client\Projections\UserSprintAssignment;
use App\Domain\Client\Projections\User;

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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Client\Projections\UserSprintAssignment
     */
    public function createWritable(array $attributes = []): UserSprintAssignment
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
