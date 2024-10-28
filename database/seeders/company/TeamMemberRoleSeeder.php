<?php

namespace Database\Seeders\company;

use Database\Factories\company\TeamMemberRoleFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_member_roles')->truncate();
        TeamMemberRoleFactory::new()->count(20)->create();
    }
}
