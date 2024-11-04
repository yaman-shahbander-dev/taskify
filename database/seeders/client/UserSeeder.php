<?php

namespace Database\Seeders\client;

use Database\Factories\client\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        UserFactory::new()->count(1)->create();
    }
}
