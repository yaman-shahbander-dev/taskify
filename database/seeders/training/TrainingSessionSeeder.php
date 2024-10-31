<?php

namespace Database\Seeders\training;

use Database\Factories\training\TrainingSessionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_sessions')->truncate();
        TrainingSessionFactory::new()->count(10)->make()->each(function ($trainingSession) {
            $trainingSession->writeable()->save();
        });;
    }
}
