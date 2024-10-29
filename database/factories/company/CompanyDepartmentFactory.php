<?php

namespace Database\Factories\company;

use App\Domain\Company\Models\CompanyDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'company_id' => \App\Domain\Company\Models\Company::query()->inRandomOrder()->first()->id,
            'name' => fake()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
