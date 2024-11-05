<?php

namespace App\Domain\Company\Projections;

use App\Domain\Project\Projections\Project;
use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CompanyDepartment extends BaseProjection
{
    protected $table = 'company_departments';

    protected $fillable = ['id', 'company_id', 'name'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function departmentTeams(): HasMany
    {
        return $this->hasMany(DepartmentTeam::class, 'department_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_departments', 'department_id', 'project_id');
    }
}
