<?php

namespace Database\Seeders\company;

use Database\Factories\company\CompanyFactory;
use Database\Factories\company\RoleFactory;
use Database\Factories\company\TrainingPolicyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_policies')->truncate();
        TrainingPolicyFactory::new()->count(3)->make()->each(function ($trainingPolicy) {
            $trainingPolicy->writeable()->save();
        });
    }
}
