<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class SprintTask extends BaseProjection
{
    protected $table = 'sprint_tasks';

    protected $fillable = ['sprint_id', 'task_id'];
}
