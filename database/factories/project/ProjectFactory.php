<?php

namespace Database\Factories\project;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\CompanyDepartment;
use Database\Factories\company\CompanyDepartmentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = \App\Domain\Project\Models\Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::query()->inRandomOrder()->first();
        $department = CompanyDepartment::query()->where('company_id')->first()
            ?? CompanyDepartmentFactory::new(['company_id' => $company->id])->create();

        return [
            'id' => fake()->unique()->uuid(),
            'company_id' => $company->id,
            'department_id' => $department->id,
            'name' => fake()->name,
            'description' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}