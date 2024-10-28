<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyFactory;
use Database\Factories\company\RoleFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        RoleFactory::new()->count(10)->create();
    }
}
