<?php

namespace Database\Factories\training;

use App\Domain\Training\Projections\TrainingCourse;
use App\Domain\Training\Projections\TrainingSession;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\TrainingSession
     */
    public function createWritable(array $attributes = []): TrainingSession
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
