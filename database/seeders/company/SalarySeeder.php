<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyFactory;
use Database\Factories\company\RoleFactory;
use Database\Factories\company\SalaryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salaries')->truncate();
        SalaryFactory::new()->count(3)->create();
    }
}
