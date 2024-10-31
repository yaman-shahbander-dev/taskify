<?php

namespace Database\Factories\company;

use App\Domain\Company\Projections\CompanyDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Company\Projections\Company;

class CompanyDepartmentFactory extends Factory
{
    protected $model = CompanyDepartment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'company_id' => Company::query()->inRandomOrder()->first()->id,
            'name' => fake()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\CompanyDepartment
     */
    public function createWritable(array $attributes = []): CompanyDepartment
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
