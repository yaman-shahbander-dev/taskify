<?php

namespace App\Domain\Project\Actions;


use App\Domain\Project\Exceptions\FailedToCreateProjectException;
use App\Domain\Project\Projections\Project;

class CreateProjectAction
{
    public function __construct(protected Project $project)
    {
    }

    public function __invoke(string $id, string $name, string $description): Project
    {
        $project = $this->project->writeable()->create([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$project) {
            throw new FailedToCreateProjectException();
        }

        return $project;
    }
}
