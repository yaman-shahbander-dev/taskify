<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class ProjectDepartment extends BaseProjection
{
    protected $table = 'project_departments';

    protected $fillable = ['project_id', 'department_id'];
}
