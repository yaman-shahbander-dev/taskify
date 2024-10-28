<?php

namespace Database\Seeders\project;

use Database\Factories\project\PriorityLevelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriorityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priority_levels')->truncate();
        PriorityLevelFactory::new()->count(10)->create();
    }
}
