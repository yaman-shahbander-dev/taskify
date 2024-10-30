<?php

namespace Database\Factories\training;

use App\Domain\Company\Projections\Company;
use App\Domain\Training\Projections\TrainingCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingCourseFactory extends Factory
{
    protected $model = TrainingCourse::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::query()->inRandomOrder()->first();

        return [
            'id' => fake()->unique()->uuid(),
            'company_id' => $company->id,
            'title' => fake()->word,
            'duration' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\TrainingCourse
     */
    public function createWritable(array $attributes = []): TrainingCourse
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
