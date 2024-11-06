<?php

namespace App\Domain\Project\Actions;

use App\Domain\Project\Enums\TaskStatusEnum;
use App\Domain\Project\Exceptions\FailedToCreateProjectTaskException;
use App\Domain\Project\Projections\Project;
use App\Domain\Project\Projections\SprintTask;
use App\Domain\Project\Projections\Task;

class CreateProjectTaskAction
{
    public function __construct(
        protected Task $task,
        protected SprintTask $sprintTask
    ) {
    }

    public function __invoke(string $projectId, array $tasks): bool
    {
        $project = Project::query()
            ->where('id', $projectId)
            ->first();

        $sprint = $project->sprints()->first();

        $data = [];
        $tasksIds = [];

        foreach ($tasks as $task) {
            $id = generateUuid();
            $tasksIds[] = $id;

            $data[] = [
                'id' => $id,
                'project_id' => $projectId,
                'priority_id' => $task->priorityId,
                'assigned_to' => $task->assignedTo ?? null,
                'title' => $task->title,
                'description' => $task->description,
                'status' => TaskStatusEnum::PENDING->value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $insertedTasks = $this->task->writeable()->insertOrIgnore($data);

        if (!$insertedTasks) {
            throw new FailedToCreateProjectTaskException();
        }

        $sprint->tasks()->attach($tasksIds);

        return true;
    }
}
