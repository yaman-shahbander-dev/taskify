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

    protected $fillable = ['id', 'name', 'address', 'contact_number'];

    public function getKeyName(): string
    {
        return 'id';
    }
}
