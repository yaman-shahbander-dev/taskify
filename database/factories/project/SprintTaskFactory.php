<?php

namespace Database\Factories\project;

use App\Domain\Project\Projections\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\SprintTask;
use App\Domain\Project\Projections\Project;
use App\Domain\Project\Projections\Sprint;

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
            ->first() ?? SprintFactory::new()->createWritable(['project_id' => $project->id]);
        $task = Task::query()->where('project_id', $project->id)->inRandomOrder()
            ->first() ?? TaskFactory::new()->createWritable(['project_id' => $project->id]);

        return [
            'sprint_id' => $sprint->id,
            'task_id' => $task->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\SprintTask
     */
    public function createWritable(array $attributes = []): SprintTask
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
