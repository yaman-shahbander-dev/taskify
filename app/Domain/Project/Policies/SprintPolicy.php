<?php

namespace App\Domain\Project\Policies;

use App\Domain\Client\Projections\User;
use App\Domain\Project\Projections\Sprint;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Client\Enums\PermissionsEnum;

class SprintPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::SPRINTS->value);
    }

    public function view(User $user, Sprint $sprint): bool
    {
        return $user->can(PermissionsEnum::SPRINTS_SHOW->value)
            && $user->companies()->whereHas('projects.sprints', function ($query) use ($sprint) {
                return $query->where('sprints.id', $sprint->id);
            })->exists();
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::SPRINTS_STORE->value);
    }

    public function update(User $user, Sprint $sprint): bool
    {
        return $user->can(PermissionsEnum::SPRINTS_UPDATE->value)
            && $user->companies()->whereHas('projects.sprints', function ($query) use ($sprint) {
                return $query->where('sprints.id', $sprint->id);
            })->exists();
    }

    public function delete(User $user, Sprint $sprint): bool
    {
        return $user->can(PermissionsEnum::SPRINTS_DESTROY->value)
            && $user->companies()->whereHas('projects.sprints', function ($query) use ($sprint) {
                return $query->where('sprints.id', $sprint->id);
            })->exists();
    }
}
