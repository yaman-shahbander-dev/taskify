<?php

namespace Database\Seeders\client;

use Database\Factories\client\UserSkillFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_skills')->truncate();
        UserSkillFactory::new()->count(30)->make()->each(function ($userSkill) {
            $userSkill->writeable()->save();
        });
    }
}
