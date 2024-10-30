<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->truncate();
        CompanyFactory::new()->count(10)->make()->each(function ($company) {
            $company->writeable()->save();
        });
    }
}
