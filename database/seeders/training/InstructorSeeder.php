<?php

namespace Database\Seeders\training;

use Database\Factories\training\InstructorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instructors')->truncate();
        InstructorFactory::new()->count(10)->create();
    }
}
