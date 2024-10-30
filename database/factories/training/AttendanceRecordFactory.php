<?php

namespace Database\Factories\training;

use App\Domain\Client\Projections\User;
use App\Domain\Training\Projections\AttendanceRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Training\Projections\TrainingSession;

class AttendanceRecordFactory extends Factory
{
    protected $model = AttendanceRecord::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'session_id' => TrainingSession::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\AttendanceRecord
     */
    public function createWritable(array $attributes = []): AttendanceRecord
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
