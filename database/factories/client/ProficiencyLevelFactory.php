<?php

namespace Database\Factories\client;

use App\Domain\Client\Projections\ProficiencyLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProficiencyLevelFactory extends Factory
{
    protected $model = ProficiencyLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Client\Projections\ProficiencyLevel
     */
    public function createWritable(array $attributes = []): ProficiencyLevel
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
