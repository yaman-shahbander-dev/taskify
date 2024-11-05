<?php

namespace App\Domain\Company\Projections;

use App\Domain\Client\Projections\User;
use App\Domain\Project\Projections\Project;
use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends BaseProjection
{
    protected $table = 'companies';

    protected $fillable = ['id', 'user_id', 'name', 'address', 'contact_number'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companyDepartments(): HasMany
    {
        return $this->hasMany(CompanyDepartment::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_companies', 'company_id', 'project_id');
    }
}
