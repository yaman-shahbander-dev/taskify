<?php

namespace Database\Seeders\project;

use Database\Factories\project\SprintReviewFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprintReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sprint_reviews')->truncate();
        SprintReviewFactory::new()->count(5)->create();
    }
}
