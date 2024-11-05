<?php

namespace App\Domain\Company\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class GetTeamsAction
{
    public function __invoke(?string $userId = null): LengthAwarePaginator
    {
        return DB::table('users')
            ->select([
                'departments_teams.id',
                'departments_teams.name',
                'departments_teams.created_at',
                'departments_teams.updated_at',
                'company_departments.name AS department_name',
                'companies.name AS company_name'
            ])
            ->join('companies', 'companies.user_id', '=', 'users.id')
            ->join('company_departments', 'company_departments.company_id', '=', 'companies.id')
            ->join('departments_teams', 'departments_teams.department_id', '=', 'company_departments.id')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('users.id', $userId);
            })
            ->orderBy('departments_teams.created_at', 'desc')
            ->paginate();
    }
}
