<?php

namespace App\Domain\Project;

use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Domain\Project\Partials\ProjectAggregatePartial;
use App\Support\Bases\BaseAggregate;

class ProjectAggregate extends BaseAggregate
{
    protected ProjectAggregatePartial $project;

    public function __construct() {
        $this->project = new ProjectAggregatePartial($this);
    }

    public function createProject(ProjectData $data): static
    {
        $this->project->createProject($data);

        return $this;
    }

    public function updateProject(ProjectData $data): static
    {
        $this->project->updateProject($data);

        return $this;
    }

    public function deleteProject(string $projectId): static
    {
        $this->project->deleteProject($projectId);

        return $this;
    }
}
