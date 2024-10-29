<?php

namespace Database\Factories\training;

use App\Domain\Training\Models\CourseInstructor;
use App\Domain\Training\Models\TrainingCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'instructor_id' => \App\Domain\Training\Models\Instructor::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
