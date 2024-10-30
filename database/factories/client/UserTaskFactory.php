<?php

namespace Database\Factories\client;

use App\Domain\Client\Projections\UserTask;
use App\Domain\Project\Projections\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Client\Projections\User;

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
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'task_id' => Task::query()->inRandomOrder()->first()->id,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Client\Projections\UserTask
     */
    public function createWritable(array $attributes = []): UserTask
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
