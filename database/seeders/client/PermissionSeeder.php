<?php

namespace Database\Seeders\client;

use App\Domain\Client\Models\EPermission;
use App\Domain\Client\Models\ERole;
use Illuminate\Database\Seeder;
use App\Domain\Client\Enums\PermissionsEnum;
use App\Domain\Client\Enums\RolesEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Insert roles
        collect(RolesEnum::getValues())->each(function ($role) {
            ERole::query()->firstOrCreate(['name' => $role, 'guard_name' => 'api']);
        });
        // Insert permissions
        collect(PermissionsEnum::getValues())->each(function ($permission) {
            EPermission::query()->firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        });
    }
}
