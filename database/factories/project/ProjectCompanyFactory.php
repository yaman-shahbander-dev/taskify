<?php

namespace Database\Factories\project;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\Company;
use App\Domain\Project\Projections\ProjectCompany;
use Database\Factories\client\UserFactory;
use Database\Factories\company\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Project;

class ProjectCompanyFactory extends Factory
{
    protected $model = ProjectCompany::class;
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

        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => $project->id,
            'company_id' => $company->id,
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
