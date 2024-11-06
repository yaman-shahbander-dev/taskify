<?php

namespace App\Domain\Project\Factories;

use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\Enums\SprintStatusEnum;
use App\Support\Bases\BaseData;

class SprintDataDTOFactory
{
    public function create($data): BaseData
    {
        $sprintDTO = formatDTO([
            'project_id' => $data->id,
            'number' => $data->sprint->number,
            'start' => $data->sprint->start,
            'end' => $data->sprint->end,
            'goal' => $data->sprint->goal,
            'status' => SprintStatusEnum::IN_PROGRESS->value,
        ], app(SprintData::class));

        return $sprintDTO;
    }
}
