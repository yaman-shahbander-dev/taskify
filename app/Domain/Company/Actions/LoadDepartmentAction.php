<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
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
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        return $department;
    }
}
