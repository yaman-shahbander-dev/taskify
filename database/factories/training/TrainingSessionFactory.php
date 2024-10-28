<?php

namespace Database\Factories\training;

use App\Models\company\Company;
use App\Models\training\TrainingCourse;
use App\Models\training\TrainingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSessionFactory extends Factory
{
    protected $model = TrainingSession::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'course_id' => TrainingCourse::query()->inRandomOrder()->first()->id,
            'date' => fake()->dateTime(),
            'location' => fake()->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
