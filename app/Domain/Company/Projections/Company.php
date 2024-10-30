<?php

namespace App\Domain\Company\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Projections\Projection;

class Company extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'companies';

    public function getKeyName(): string
    {
        return 'id';
    }
}
