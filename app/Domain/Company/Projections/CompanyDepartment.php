<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyDepartment extends BaseProjection
{
    protected $table = 'company_departments';

    protected $fillable = ['id', 'company_id', 'name'];

    public function getKeyName(): string
    {
        return 'id';
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function departmentTeams(): HasMany
    {
        return $this->hasMany(DepartmentTeam::class);
    }
}
