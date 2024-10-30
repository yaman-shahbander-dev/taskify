<?php

namespace Database\Seeders\client;

use App\Domain\Client\Enums\RolesEnum;
use App\Domain\Client\Projections\ERole;
use Illuminate\Database\Seeder;
use App\Domain\Client\Projections\User;
use Illuminate\Support\Facades\DB;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()
            ->where('email', 'admin@admin.com')
            ->first();

        $role = ERole::query()
            ->where('name', RolesEnum::ADMIN->value)
            ->first();

        $data = [
            'role_id' => $role->id,
            'model_type' => 'user',
            'model_id' => $admin->id
        ];

        DB::table('model_has_roles')->insert($data);

    }
}
