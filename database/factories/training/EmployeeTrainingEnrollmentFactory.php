<?php

namespace Database\Factories\training;

use App\Domain\Client\Models\User;
use App\Domain\Training\Models\EmployeeTrainingEnrollment;
use App\Domain\Training\Models\TrainingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeTrainingEnrollmentFactory extends Factory
{
    protected $model = EmployeeTrainingEnrollment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'session_id' => TrainingSession::query()->inRandomOrder()->first()->id,
            'enrollment_date' => fake()->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
