<?php

namespace Database\Seeders\project;

use Database\Factories\project\ProjectFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->truncate();
        ProjectFactory::new()->count(10)->create();
    }
}
