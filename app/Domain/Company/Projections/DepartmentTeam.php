<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentTeam extends BaseProjection
{
    protected $table = 'departments_teams';

    protected $fillable = ['id', 'department_id', 'name'];

    public function getKeyName(): string
    {
        return 'id';
    }

    public function companyDepartment(): BelongsTo
    {
        return $this->belongsTo(CompanyDepartment::class);
    }
}
