<?php

namespace App\Domain\Company\Projections;

use App\Domain\Client\Projections\User;
use App\Support\Bases\BaseProjection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends BaseProjection
{
    protected $table = 'companies';

    protected $fillable = ['id', 'user_id', 'name', 'address', 'contact_number'];

    public function getKeyName(): string
    {
        return 'id';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companyDepartments(): HasMany
    {
        return $this->hasMany(CompanyDepartment::class);
    }
}
