<?php

namespace App\Domain\Company\Policies;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\CompanyDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Client\Enums\PermissionsEnum;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::DEPARTMENTS_LIST->value);
    }

    public function view(User $user, CompanyDepartment $department): bool
    {
        return $user->can(PermissionsEnum::DEPARTMENTS_SHOW->value) && $user->companies()
                ->whereHas('companyDepartments', function($query) use ($department) {
                    $query->where('id', $department->id);
                })->exists();
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::DEPARTMENTS_STORE->value);
    }

    public function update(User $user, CompanyDepartment $department): bool
    {
        return $user->can(PermissionsEnum::DEPARTMENTS_UPDATE->value) && $user->companies()
                ->whereHas('companyDepartments', function($query) use ($department) {
                    $query->where('id', $department->id);
                })->exists();
    }

    public function delete(User $user, CompanyDepartment $department): bool
    {
        return $user->can(PermissionsEnum::DEPARTMENTS_DESTROY->value) && $user->companies()
                ->whereHas('companyDepartments', function($query) use ($department) {
                    $query->where('id', $department->id);
                })->exists();
    }
}
