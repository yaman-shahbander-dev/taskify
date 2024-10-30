<?php

namespace Database\Factories\training;

use App\Domain\Client\Projections\User;
use App\Domain\Training\Projections\EmployeeTrainingEnrollment;
use App\Domain\Training\Projections\TrainingSession;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\EmployeeTrainingEnrollment
     */
    public function createWritable(array $attributes = []): EmployeeTrainingEnrollment
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
