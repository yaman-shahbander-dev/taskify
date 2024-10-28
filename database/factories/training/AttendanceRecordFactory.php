<?php

namespace Database\Factories\training;

use App\Models\client\User;
use App\Models\training\AttendanceRecord;
use App\Models\training\TrainingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

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
}
