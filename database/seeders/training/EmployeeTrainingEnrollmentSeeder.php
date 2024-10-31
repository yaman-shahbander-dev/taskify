<?php

namespace Database\Seeders\training;

use Database\Factories\training\EmployeeTrainingEnrollmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTrainingEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_training_enrollments')->truncate();
        EmployeeTrainingEnrollmentFactory::new()->count(10)->make()->each(function ($employeeTrainingEnrollment) {
            $employeeTrainingEnrollment->writeable()->save();
        });
    }
}
