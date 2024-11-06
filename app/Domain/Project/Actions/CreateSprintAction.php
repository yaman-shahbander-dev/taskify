<?php

namespace App\Domain\Project\Actions;


use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\Exceptions\FailedToCreateSprintException;
use App\Domain\Project\Projections\Sprint;

class CreateSprintAction
{
    public function __construct(protected Sprint $sprint)
    {
    }

    public function __invoke(SprintData $data): Sprint
    {
        $sprint = $this->sprint->writeable()->create([
            'id' => $data->id,
            'project_id' => $data->projectId,
            'number' => $data->number,
            'start' => $data->start,
            'end' => $data->end,
            'goal' => $data->goal,
            'status' => $data->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$sprint) {
            throw new FailedToCreateSprintException();
        }

        return $sprint;
    }
}
