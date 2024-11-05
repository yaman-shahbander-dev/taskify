<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class ProjectCompany extends BaseProjection
{
    protected $table = 'project_companies';

    protected $fillable = ['id', 'project_id', 'company_id'];
}
