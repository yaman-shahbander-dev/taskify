<?php

namespace App\Domain\Company\Policies;

use App\Domain\Client\Projections\User;
use App\Domain\Project\Projections\Task;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Client\Enums\PermissionsEnum;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::TASKS_LIST->value);
    }

    public function view(User $user, Task $task): bool
    {
        return $user->can(PermissionsEnum::TASKS_SHOW->value)
            && $user->companies()->whereHas('projects.tasks', function ($query) use ($task) {
                $query->where('tasks.project_id', $task->id);
            })->exists();
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::TASKS_STORE->value);
    }

    public function update(User $user, Task $task): bool
    {
        return $user->can(PermissionsEnum::TASKS_UPDATE->value)
            && $user->companies()->whereHas('projects.tasks', function ($query) use ($task) {
                $query->where('tasks.project_id', $task->id);
            })->exists();
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->can(PermissionsEnum::TASKS_DESTROY->value)
            && $user->companies()->whereHas('projects.tasks', function ($query) use ($task) {
                $query->where('tasks.project_id', $task->id);
            })->exists();
    }
}
