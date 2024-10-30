<?php

namespace Database\Seeders\company;

use Database\Factories\company\TeamMemberFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_members')->truncate();
        TeamMemberFactory::new()->count(10)->make()->each(function ($teamMember) {
            $teamMember->writeable()->save();
        });
    }
}
