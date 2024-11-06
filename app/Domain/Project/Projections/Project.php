<?php

namespace App\Domain\Project\Projections;

use App\Domain\Company\Projections\Company;
use App\Domain\Company\Projections\CompanyDepartment;
use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseProjection
{
    protected $table = 'projects';

    protected $fillable = ['id', 'name', 'description'];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'project_companies', 'project_id', 'company_id');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(CompanyDepartment::class, 'project_departments', 'project_id', 'department_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class);
    }
}
