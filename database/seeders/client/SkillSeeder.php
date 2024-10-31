<?php

namespace Database\Seeders\client;

use Database\Factories\client\SkillFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->truncate();
        SkillFactory::new()->count(10)->make()->each(function ($skill) {
            $skill->writeable()->save();
        });
    }
}
