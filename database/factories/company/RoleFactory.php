<?php

namespace Database\Factories\company;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Company\Projections\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;
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
     * @return \App\Domain\Company\Projections\Role
     */
    public function createWritable(array $attributes = []): Role
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
