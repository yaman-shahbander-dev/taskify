<?php

namespace Database\Factories\training;

use App\Domain\Training\Projections\CourseInstructor;
use App\Domain\Training\Projections\TrainingCourse;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Training\Projections\Instructor;

class CourseInstructorFactory extends Factory
{
    protected $model = CourseInstructor::class;
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
            'instructor_id' => Instructor::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\CourseInstructor
     */
    public function createWritable(array $attributes = []): CourseInstructor
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
