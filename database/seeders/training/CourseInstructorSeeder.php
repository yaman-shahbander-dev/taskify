<?php

namespace Database\Seeders\training;

use Database\Factories\training\CourseInstructorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseInstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_instructors')->truncate();
        CourseInstructorFactory::new()->count(10)->make()->each(function ($courseInstructor) {
            $courseInstructor->writeable()->save();
        });
    }
}
