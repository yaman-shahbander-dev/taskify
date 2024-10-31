<?php

namespace Database\Factories\client;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Client\Projections\Skill;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

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
     * @return \App\Domain\Client\Projections\Skill
     */
    public function createWritable(array $attributes = []): Skill
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
