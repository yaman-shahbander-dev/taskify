<?php

namespace App\Domain\Company\Policies;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\DepartmentTeam;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Client\Enums\PermissionsEnum;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::TEAMS_LIST->value);
    }

    public function view(User $user, DepartmentTeam $team): bool
    {
        return $user->can(PermissionsEnum::TEAMS_SHOW->value)
            && $user->teams()->where('departments_teams.id', $team->id)->exists();
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::TEAMS_STORE->value);
    }

    public function update(User $user, DepartmentTeam $team): bool
    {
        return $user->can(PermissionsEnum::TEAMS_UPDATE->value)
            && $user->teams()->where('departments_teams.id', $team->id)->exists();
    }

    public function delete(User $user, DepartmentTeam $team): bool
    {
        return $user->can(PermissionsEnum::TEAMS_DESTROY->value)
            && $user->teams()->where('departments_teams.id', $team->id)->exists();
    }
}
