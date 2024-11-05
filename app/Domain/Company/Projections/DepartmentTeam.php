<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class DepartmentTeam extends BaseProjection
{
    protected $table = 'departments_teams';

    protected $fillable = ['id', 'department_id', 'name'];

    public function companyDepartment(): BelongsTo
    {
        return $this->belongsTo(CompanyDepartment::class, 'department_id');
    }

    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,
            CompanyDepartment::class,
            'id',              // Foreign key on the CompanyDepartment table (department_id)
            'id',              // Foreign key on the Company table (company_id)
            'department_id',   // Local key on the DepartmentTeam table
            'company_id'       // Local key on the CompanyDepartment table
        );
    }
}
