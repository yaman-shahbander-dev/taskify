<?php

namespace App\Domain\Company\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class CompanyDepartment extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'company_departments';

    protected $fillable = ['id', 'company_id', 'name'];

    public function getKeyName(): string
    {
        return 'id';
    }
}
