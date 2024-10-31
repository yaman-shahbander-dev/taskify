<?php

namespace Database\Seeders\project;

use Database\Factories\project\MeetingFactory;
use Database\Factories\project\SprintFactory;
use Database\Factories\project\SprintTaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprintTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sprint_tasks')->truncate();
        SprintTaskFactory::new()->count(5)->make()->each(function ($sprintTask) {
            $sprintTask->writeable()->save();
        });
    }
}
