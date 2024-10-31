<?php

namespace Database\Factories\project;

use App\Domain\Project\Projections\SprintChangeLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Sprint;

class SprintChangeLogFactory extends Factory
{
    protected $model = SprintChangeLog::class;
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
            'change_description' => fake()->sentence,
            'date' => fake()->dateTime(),
            'affected_tasks' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\SprintChangeLog
     */
    public function createWritable(array $attributes = []): SprintChangeLog
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
