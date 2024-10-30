<?php

namespace Database\Seeders\client;

use Database\Factories\client\ProficiencyLevelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProficiencyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proficiency_levels')->truncate();
        ProficiencyLevelFactory::new()->count(10)->make()->each(function ($proficiencyLevel) {
            $proficiencyLevel->writeable()->save();
        });
    }
}
