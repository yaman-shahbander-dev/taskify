<?php

namespace Database\Factories\project;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\Company;
use App\Domain\Company\Projections\CompanyDepartment;
use App\Domain\Project\Projections\ProjectCompany;
use App\Domain\Project\Projections\ProjectDepartment;
use Database\Factories\client\UserFactory;
use Database\Factories\company\CompanyDepartmentFactory;
use Database\Factories\company\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Project;

class ProjectDepartmentFactory extends Factory
{
    protected $model = ProjectDepartment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first()
            ?? UserFactory::new()->create();

        $company = Company::query()->inRandomOrder()->first()
            ?? CompanyFactory::new()->createWritable(['user_id' => $user->id]);

        $project = Project::query()->inRandomOrder()->first()
            ?? ProjectFactory::new()->createWritable();

        $department = CompanyDepartment::query()->where('company_id', $company->id)->first()
            ?? CompanyDepartmentFactory::new()->createWritable(['company_id' => $company->id]);

        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => $project->id,
            'department_id' => $department->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\ProjectCompany
     */
    public function createWritable(array $attributes = []): ProjectCompany
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
