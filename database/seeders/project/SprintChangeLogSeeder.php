<?php

namespace Database\Seeders\project;

use Database\Factories\project\SprintChangeLogFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprintChangeLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sprint_changes_log')->truncate();
        SprintChangeLogFactory::new()->count(4)->make()->each(function ($sprintChangeLog) {
            $sprintChangeLog->writeable()->save();
        });
    }
}
