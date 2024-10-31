<?php

namespace Database\Seeders\client;

use Database\Factories\client\UserSkillFactory;
use Database\Factories\client\UserSprintAssignmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSprintAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_sprint_assignments')->truncate();
        UserSprintAssignmentFactory::new()->count(30)->make()->each(function ($userSprintAssignment) {
            $userSprintAssignment->writeable()->save();
        });
    }
}
