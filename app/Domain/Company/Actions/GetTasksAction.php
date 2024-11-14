<?php

namespace App\Domain\Company\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class GetTasksAction
{
    public function __invoke(?string $userId = null): LengthAwarePaginator
    {
        return DB::table('users')
            ->select([
                'tasks.id',
                'tasks.title',
                'tasks.description',
                'tasks.status',
                'projects.name AS project_name',
                'priority_levels.name AS priority',
                'users.name AS assigned_to_user',
                'tasks.created_at',
                'tasks.updated_at'
            ])
            ->join('companies', 'companies.user_id', '=', 'users.id')
            ->join('project_companies', 'project_companies.company_id', '=', 'companies.id')
            ->join('projects', 'projects.id', '=', 'project_companies.project_id')
            ->join('tasks', 'tasks.project_id', '=', 'projects.id')
            ->join('priority_levels', 'priority_levels.id', '=', 'tasks.priority_id')
            ->join('users AS assigned_user', 'assigned_user.id', '=', 'tasks.assigned_to')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('users.id', $userId);
            })
            ->orderBy('tasks.created_at', 'desc')
            ->paginate();
    }
}
