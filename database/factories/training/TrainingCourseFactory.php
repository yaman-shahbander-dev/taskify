<?php

namespace Database\Factories\training;

use App\Domain\Company\Models\Company;
use App\Domain\Training\Models\TrainingCourse;
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
}
