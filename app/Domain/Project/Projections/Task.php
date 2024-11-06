<?php

namespace App\Domain\Project\Projections;

use App\Domain\Client\Projections\User;
use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Domain\Project\Projections\Sprint;

class Task extends BaseProjection
{
    protected $table = 'tasks';

    protected $fillable = ['id', 'project_id', 'priority_id', 'assigned_to', 'title', 'description', 'status'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(PriorityLevel::class, 'priority_id', 'id');
    }

    public function sprints(): BelongsToMany
    {
        return $this->belongsToMany(Sprint::class, 'sprint_tasks', 'task_id', 'sprint_id');
    }
}
