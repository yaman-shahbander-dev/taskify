<?php

namespace App\Domain\Project\Actions;

use App\Domain\Project\Enums\TaskStatusEnum;
use App\Domain\Project\Exceptions\FailedToCreateProjectTaskException;
use App\Domain\Project\Projections\Sprint;
use App\Domain\Project\Projections\SprintTask;
use App\Domain\Project\Projections\Task;

class CreateTaskAction
{
    public function __construct(
        protected Task $task,
        protected SprintTask $sprintTask,
        protected Sprint $sprint
    ) {
    }

    public function __invoke(string $sprintId, array $tasks, ?string $projectId = null): bool
    {
        $sprint = $this->sprint
            ->query()
            ->where('id', $sprintId)
            ->first();

        $data = [];
        $tasksIds = [];

        foreach ($tasks as $task) {
            $id = generateUuid();
            $tasksIds[] = $id;

            $data[] = [
                'id' => $id,
                'project_id' => $task->projectId ?? $projectId,
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
