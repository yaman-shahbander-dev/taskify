<?php

namespace App\Domain\Project\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\Projections\Project;

class LoadProjectAction
{
    public function __construct(protected Project $project)
    {
    }
    public function __invoke(string $value, string $column = 'id')
    {
        $project = $this->project->query()
            ->with([
                'companies',
                'departments',
                'tasks',
                'sprints'
            ])
            ->where($column, $value)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        return $project;
    }
}
