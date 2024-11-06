<?php

namespace App\Domain\Project\Partials;

use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Domain\Project\Events\ProjectCompanyCreated;
use App\Domain\Project\Events\ProjectCreated;
use App\Domain\Project\Events\ProjectDeleted;
use App\Domain\Project\Events\ProjectDepartmentCreated;
use App\Domain\Project\Events\ProjectTaskCreated;
use App\Domain\Project\Events\ProjectUpdated;
use App\Domain\Project\Events\SprintCreated;
use App\Domain\Project\Factories\SprintDataDTOFactory;
use App\Support\Bases\BaseAggregatePartial;

class ProjectAggregatePartial extends BaseAggregatePartial
{
    public function createProject(ProjectData $data): static
    {
        $this->recordThat(new ProjectCreated($data));
        $this->recordThat(new ProjectCompanyCreated($data->id, $data->companies));
        $this->recordThat(new ProjectDepartmentCreated($data->id, $data->departments));

        if ($data->sprint) {
            $sprintData = app(SprintDataDTOFactory::class)->create($data);

            $this->recordThat(new SprintCreated($sprintData));
            $this->recordThat(new ProjectTaskCreated($data->id, $data->tasks));
        }

        return $this;
    }

    public function updateProject(ProjectData $data): static
    {
        $this->recordThat(new ProjectUpdated($data));

        return $this;
    }

    public function deleteProject(string $projectId): static
    {
        $this->recordThat(new ProjectDeleted($projectId));

        return $this;
    }
}
