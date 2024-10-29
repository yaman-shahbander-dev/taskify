<?php

namespace Database\Seeders\client;

use App\Domain\Client\Models\EPermission;
use Illuminate\Database\Seeder;
use App\Domain\Client\Enums\RolesEnum;
use Illuminate\Support\Arr;
use App\Domain\Client\Models\ERole;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enumRolesPermissions = RolesEnum::getRolesPermissions();
        $matchedRoles = ERole::query()->whereIn('name', array_keys($enumRolesPermissions))->get();
        $matchedPermissions = EPermission::query()->whereIn('name', Arr::flatten($enumRolesPermissions))->get();
        foreach ($matchedRoles as $matchedRole) {
            $matchedRole->permissions()->syncWithoutDetaching(
                $matchedPermissions->whereIn('name', $enumRolesPermissions[$matchedRole->name])
                    ->pluck('id')->toArray()
            );
        }
    }
}
