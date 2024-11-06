<?php

namespace App\Domain\Project\Actions;


use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Domain\Project\Exceptions\FailedToUpdateProjectException;
use App\Domain\Project\Projections\Project;

class UpdateProjectAction
{
    public function __construct(protected Project $project)
    {
    }

    public function __invoke(ProjectData $data): Project
    {
        $project = $this->project
            ->query()
            ->where('id', $data->id)
            ->firstOr(fn () => throw new FailedToFindTheDataException());


        $project->writeable()->update([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        if (!$project) {
            throw new FailedToUpdateProjectException();
        }

        $project->companies()->sync($data->companies);
        $project->departments()->sync($data->departments);

        return $project;
    }
}
