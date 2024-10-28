<?php

namespace Database\Seeders\project;

use Database\Factories\project\PriorityLevelFactory;
use Database\Factories\project\TaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->truncate();
        TaskFactory::new()->count(100)->create();
    }
}
