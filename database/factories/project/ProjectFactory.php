<?php

namespace Database\Factories\project;

use App\Domain\Company\Projections\Company;
use App\Domain\Company\Projections\CompanyDepartment;
use Database\Factories\company\CompanyDepartmentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;
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
     * @return \App\Domain\Project\Projections\Project
     */
    public function createWritable(array $attributes = []): Project
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
