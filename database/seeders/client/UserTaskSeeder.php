<?php

namespace Database\Seeders\client;

use Database\Factories\client\UserTaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_tasks')->truncate();
        UserTaskFactory::new()->count(30)->make()->each(function ($userTask) {
            $userTask->writeable()->save();
        });
    }
}
