<?php

namespace App\Domain\Project\Actions;

use App\Domain\Project\Projections\Sprint;
use Illuminate\Pagination\LengthAwarePaginator;

class GetSprintsAction
{
    public function __invoke(?string $userId = null): LengthAwarePaginator
    {
        return Sprint::query()
            ->with('tasks')
            ->when($userId, function ($query) use ($userId) {
                return $query->whereHas('project.companies', function ($subQuery) use ($userId) {
                    $subQuery->where('companies.user_id', $userId);
                });
            })
            ->orderBy('sprints.created_at', 'desc')
            ->paginate();
    }
}
