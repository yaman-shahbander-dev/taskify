<?php

namespace App\Domain\Company\Actions;

use App\Domain\Client\Exceptions\UserNotFoundException;
use App\Domain\Company\Projections\CompanyDepartment;

class LoadDepartmentAction
{
    public function __construct(protected CompanyDepartment $department)
    {
    }
    public function __invoke(string $value, string $column = 'id')
    {
        $department = $this->department->query()
            ->with([
                'company',
                'departmentTeams',
            ])
            ->where($column, $value)
            ->firstOr(fn() => throw new UserNotFoundException());

        return $department;
    }
}
