<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToDeleteDepartmentException;
use App\Domain\Company\Exceptions\FailedToDeleteDepartmentTeamException;
use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Company\Projections\CompanyDepartment;

class DeleteCompanyDepartmentAction
{
    public function __construct(
        protected CompanyDepartment $companyDepartment
    ) {
    }

    public function __invoke(string $departmentId): ?true
    {
        $companyDepartment = $this->companyDepartment->query()
            ->where('id', $departmentId)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        if (!$companyDepartment->departmentTeams()?->delete()) {
            throw new FailedToDeleteDepartmentTeamException();
        }

        if (!$companyDepartment->writeable()->delete()) {
            throw new FailedToDeleteDepartmentException();
        }

        return true;
    }
}
