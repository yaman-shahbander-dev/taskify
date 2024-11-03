<?php

namespace App\Domain\Client\Factories;

use App\Domain\Company\DataTransferObjects\CompanyData;
use App\Domain\Company\DataTransferObjects\CompanyDepartmentData;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;

class RegisterUserDTOFactory
{
    public function create($data): array
    {
        $companyDTO = formatDTO([
            'name' => 'default company #' . time(),
            'user_id' => $data->id,
            'address' => $data->address,
            'contact_number' => $data->contactNumber,
        ], app(CompanyData::class));

        $departmentDTO = formatDTO([
            'name' => 'default company department #' . time(),
            'companyId' => $companyDTO->id,
        ], app(CompanyDepartmentData::class));

        $teamDTO = formatDTO([
            'name' => 'default department team #' . time(),
            'department_id' => $departmentDTO->id,
        ], app(DepartmentTeamData::class));

        return [$companyDTO, $departmentDTO, $teamDTO];
    }
}
