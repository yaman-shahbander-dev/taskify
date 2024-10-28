<?php

namespace Database\Seeders\communication;

use Database\Factories\communication\CommentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->truncate();
        CommentFactory::new()->count(10)->create();
    }
}
