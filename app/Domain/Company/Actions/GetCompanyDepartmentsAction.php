<?php

namespace App\Domain\Company\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class GetCompanyDepartmentsAction
{
    public function __invoke(?string $userId = null): LengthAwarePaginator
    {
        return DB::table('users')
            ->select([
                'company_departments.id',
                'company_departments.company_id',
                'company_departments.name',
                'company_departments.created_at',
                'company_departments.updated_at',
            ])
            ->join('companies', 'companies.user_id', '=', 'users.id')
            ->join('company_departments', 'company_departments.company_id', '=', 'companies.id')
            ->join('departments_teams', 'departments_teams.department_id', '=', 'company_departments.id')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('users.id', $userId);
            })
            ->orderBy('company_departments.created_at', 'desc')
            ->paginate();
    }
}
