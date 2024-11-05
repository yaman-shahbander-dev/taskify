<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Domain\Project\Projections\Task;

class Sprint extends BaseProjection
{
    protected $table = 'sprints';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'sprint_tasks', 'sprint_id', 'task_id');
    }
}
