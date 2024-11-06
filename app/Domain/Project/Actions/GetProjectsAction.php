<?php

namespace App\Domain\Project\Actions;

use App\Domain\Project\Projections\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class GetProjectsAction
{
    public function __invoke(?string $userId = null): LengthAwarePaginator
    {
        return Project::query()
            ->with([
                'companies',
                'departments',
                'sprints',
                'tasks'
            ])
            ->when($userId, function ($query) use ($userId) {
                return $query->whereHas('companies', function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', $userId);
                });
            })
            ->orderBy('projects.created_at', 'desc')
            ->paginate();
    }
}
