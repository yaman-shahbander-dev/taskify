<?php

namespace App\Domain\Project\Policies;

use App\Domain\Client\Projections\User;
use App\Domain\Project\Projections\Project;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Client\Enums\PermissionsEnum;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::PROJECTS_LIST->value);
    }

    public function view(User $user, Project $project): bool
    {
        return $user->can(PermissionsEnum::PROJECTS_SHOW->value)
            && $user->companies()->whereHas('projects', function ($query) use ($project) {
                return $query->where('project_companies.project_id', $project->id);
            })->exists();
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::PROJECTS_STORE->value);
    }

    public function update(User $user, Project $project): bool
    {
        return $user->can(PermissionsEnum::PROJECTS_UPDATE->value)
            && $user->companies()->whereHas('projects', function ($query) use ($project) {
                return $query->where('project_companies.project_id', $project->id);
            })->exists();
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->can(PermissionsEnum::PROJECTS_DESTROY->value)
            && $user->companies()->whereHas('projects', function ($query) use ($project) {
                return $query->where('project_companies.project_id', $project->id);
            })->exists();
    }
}
