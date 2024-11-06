<?php

namespace App\Domain\Project\Actions;


use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\Exceptions\FailedToDeleteSprintException;
use App\Domain\Project\Projections\Sprint;

class DeleteSprintAction
{
    public function __construct(protected Sprint $sprint)
    {
    }

    public function __invoke(string $sprintId): bool
    {
        $sprint = $this->sprint
            ->query()
            ->where('id', $sprintId)
            ->firstOr(fn () => throw new FailedToFindTheDataException());

        $sprint->tasks()->detach();

        if (!$sprint->writeable()->delete()) {
            throw new FailedToDeleteSprintException();
        }

        return true;
    }
}
