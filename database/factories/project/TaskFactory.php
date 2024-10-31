<?php

namespace Database\Factories\project;

use App\Domain\Client\Projections\User;
use App\Domain\Project\Projections\PriorityLevel;
use App\Domain\Project\Projections\Project;
use App\Domain\Project\Projections\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = \App\Domain\Project\Projections\Task::class;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\Task
     */
    public function createWritable(array $attributes = []): Task
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
