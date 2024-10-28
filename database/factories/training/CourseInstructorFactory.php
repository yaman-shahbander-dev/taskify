<?php

namespace Database\Factories\training;

use App\Models\training\CourseInstructor;
use App\Models\training\Instructor;
use App\Models\training\TrainingCourse;
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
            'instructor_id' => Instructor::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
