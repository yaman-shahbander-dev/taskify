<?php

namespace Database\Factories\project;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Project;
use App\Domain\Project\Projections\Sprint;

class SprintFactory extends Factory
{
    protected $model = Sprint::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = now();
        $end = $start->copy()->addDays(14);

        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => Project::query()->inRandomOrder()->first()->id,
            'number' => fake()->unique()->randomDigitNotZero(),
            'start' => $start,
            'end' => $end,
            'goal' => fake()->sentence,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\Sprint
     */
    public function createWritable(array $attributes = []): Sprint
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
