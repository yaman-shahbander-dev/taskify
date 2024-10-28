<?php

namespace Database\Seeders\training;

use Database\Factories\training\TrainingMaterialFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_materials')->truncate();
        TrainingMaterialFactory::new()->count(5)->create();
    }
}
