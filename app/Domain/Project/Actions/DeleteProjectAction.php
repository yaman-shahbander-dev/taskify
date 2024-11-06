<?php

namespace App\Domain\Project\Actions;


use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\Exceptions\FailedToDeleteProjectException;
use App\Domain\Project\Projections\Project;

class DeleteProjectAction
{
    public function __construct(protected Project $project)
    {
    }

    public function __invoke(string $projectId): bool
    {
        $project = $this->project
            ->query()
            ->with(['tasks', 'sprints'])
            ->where('id', $projectId)
            ->firstOr(fn () => throw new FailedToFindTheDataException());

        $project->companies()->detach();
        $project->departments()->detach();

        foreach ($project->tasks as $task) {
            $task->sprints()->detach();
            $task->writeable()->delete();
        }

        foreach ($project->sprints as $sprint) {
            $sprint->tasks()->detach();
            $sprint->writeable()->delete();
        }

        if (!$project->writeable()->delete()) {
            throw new FailedToDeleteProjectException();
        }

        return true;
    }
}
