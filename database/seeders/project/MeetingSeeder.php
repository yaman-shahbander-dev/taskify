<?php

namespace Database\Seeders\project;

use Database\Factories\project\MeetingFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meetings')->truncate();
        MeetingFactory::new()->count(2)->create();
    }
}
