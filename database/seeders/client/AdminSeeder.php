<?php

namespace Database\Seeders\client;

use Illuminate\Database\Seeder;
use App\Domain\Client\Projections\User;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(User::class)->firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);
    }
}
