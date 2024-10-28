<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyDepartmentFactory;
use Database\Factories\company\DepartmentTeamFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments_teams')->truncate();
        DepartmentTeamFactory::new()->count(30)->create();
    }
}
