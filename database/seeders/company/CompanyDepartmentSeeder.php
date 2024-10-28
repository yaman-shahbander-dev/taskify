<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyDepartmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_departments')->truncate();
        CompanyDepartmentFactory::new()->count(30)->create();
    }
}
