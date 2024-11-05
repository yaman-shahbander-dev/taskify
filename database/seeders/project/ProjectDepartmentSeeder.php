<?php

namespace Database\Seeders\project;

use Database\Factories\project\ProjectDepartmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_departments')->truncate();
        ProjectDepartmentFactory::new()->count(3)->make()->each(function ($projectDepartment) {
            $projectDepartment->writeable()->save();
        });
    }
}
