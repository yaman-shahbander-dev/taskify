<?php

namespace App\Domain\Company\Factories;

use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Support\Bases\BaseData;

class TeamDataDTOFactory
{
    public function create($data): BaseData
    {
        $teamDTO = formatDTO([
            'department_id' => $data->id,
            'name' => $data->name,
        ], app(DepartmentTeamData::class));

        return $teamDTO;
    }

    public function createForUpdate($data): BaseData
    {
        $teamDTO = formatDTO([
            'name' => $data->teamName,
        ], app(DepartmentTeamData::class), 'id', $data->teamId);

        return $teamDTO;
    }
}
