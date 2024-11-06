<?php

namespace App\Domain\Project\Actions;


use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\Exceptions\FailedToUpdateSprintException;
use App\Domain\Project\Projections\Sprint;

class UpdateSprintAction
{
    public function __construct(protected Sprint $sprint)
    {
    }

    public function __invoke(SprintData $data): Sprint
    {
        $sprint = $this->sprint
            ->query()
            ->where('id', $data->id)
            ->firstOr(fn () => throw new FailedToFindTheDataException());

        $result = $sprint->writeable()->update([
            'project_id' => $data->projectId,
            'number' => $data->number,
            'start' => $data->start,
            'end' => $data->end,
            'goal' => $data->goal,
            'status' => $data->status,
        ]);

        if (!$result) {
            throw new FailedToUpdateSprintException();
        }

        $sprint->tasks()->sync($data->taskIds);

        return $sprint;
    }
}
