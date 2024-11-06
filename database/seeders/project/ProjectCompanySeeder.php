<?php

namespace Database\Seeders\project;

use Database\Factories\project\ProjectCompanyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_companies')->truncate();
        ProjectCompanyFactory::new()->count(3)->make()->each(function ($projectCompany) {
            $projectCompany->writeable()->save();
        });
    }
}
