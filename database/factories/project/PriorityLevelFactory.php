<?php

namespace Database\Factories\project;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\PriorityLevel;

class PriorityLevelFactory extends Factory
{
    protected $model = PriorityLevel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->name,
            'description' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\PriorityLevel
     */
    public function createWritable(array $attributes = []): PriorityLevel
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
