<?php

namespace App\Domain\Project;

use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\Partials\ProjectAggregatePartial;
use App\Domain\Project\Partials\SprintAggregatePartial;
use App\Support\Bases\BaseAggregate;

class ProjectAggregate extends BaseAggregate
{
    protected ProjectAggregatePartial $project;
    protected SprintAggregatePartial $sprint;

    public function __construct() {
        $this->project = new ProjectAggregatePartial($this);
        $this->sprint = new SprintAggregatePartial($this);
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

    public function createSprint(SprintData $data): static
    {
        $this->sprint->createSprint($data);

        return $this;
    }

    public function updateSprint(SprintData $data): static
    {
        $this->sprint->updateSprint($data);

        return $this;
    }

    public function deleteSprint(string $sprintId): static
    {
        $this->sprint->deleteSprint($sprintId);

        return $this;
    }
}
