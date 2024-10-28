<?php

namespace Database\Factories\project;

use App\Models\project\PriorityLevel;
use App\Models\project\Project;
use App\Models\project\Sprint;
use App\Models\project\SprintTask;
use App\Models\project\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintTaskFactory extends Factory
{
    protected $model = SprintTask::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Project::query()->inRandomOrder()->first();
        $sprint = Sprint::query()->where('project_id', $project->id)->inRandomOrder()
            ->first() ?? SprintFactory::new(['project_id' => $project->id])->create();
        $task = Task::query()->where('project_id', $project->id)->inRandomOrder()
            ->first() ?? TaskFactory::new(['project_id' => $project->id])->create();
        $priority = PriorityLevel::query()->inRandomOrder()->first()
            ?? PriorityLevelFactory::new()->create();

        return [
            'id' => fake()->unique()->uuid(),
            'sprint_id' => $sprint->id,
            'task_id' => $task->id,
            'priority_id' => $priority->id,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
