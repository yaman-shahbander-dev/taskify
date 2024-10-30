<?php

namespace Database\Seeders\training;

use Database\Factories\training\TrainingCourseFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_courses')->truncate();
        TrainingCourseFactory::new()->count(10)->make()->each(function ($trainingCourse) {
            $trainingCourse->writeable()->save();
        });;
    }
}
