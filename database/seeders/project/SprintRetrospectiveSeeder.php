<?php

namespace Database\Seeders\project;

use Database\Factories\project\SprintRetrospectiveFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprintRetrospectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sprint_retrospectives')->truncate();
        SprintRetrospectiveFactory::new()->count(5)->create();
    }
}
