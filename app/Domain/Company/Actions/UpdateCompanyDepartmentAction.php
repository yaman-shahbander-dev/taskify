<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Company\Exceptions\FailedToUpdateDepartmentException;
use App\Domain\Company\Projections\CompanyDepartment;

class UpdateCompanyDepartmentAction
{
    public function __construct(protected CompanyDepartment $companyDepartment)
    {
    }

    public function __invoke(string $id, string $name): ?CompanyDepartment
    {

        $companyDepartment = $this->companyDepartment->query()
            ->where('id', $id)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        $result = $companyDepartment->writeable()->update([
            'name' => $name
        ]);

        if (!$result) {
            throw new FailedToUpdateDepartmentException();
        }

        return $companyDepartment;
    }
}
