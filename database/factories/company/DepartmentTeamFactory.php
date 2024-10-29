<?php

namespace Database\Factories\company;

use App\Domain\Company\Models\CompanyDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentTeamFactory extends Factory
{
    protected $model = \App\Domain\Company\Models\DepartmentTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'department_id' => CompanyDepartment::query()->inRandomOrder()->first()->id,
            'name' => fake()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
