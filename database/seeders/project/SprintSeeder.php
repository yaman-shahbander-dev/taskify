<?php

namespace Database\Seeders\project;

use Database\Factories\project\MeetingFactory;
use Database\Factories\project\SprintFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sprints')->truncate();
        SprintFactory::new()->count(4)->make()->each(function ($sprint) {
            $sprint->writeable()->save();
        });
    }
}
