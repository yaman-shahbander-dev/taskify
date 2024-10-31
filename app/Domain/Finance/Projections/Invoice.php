<?php

namespace App\Domain\Finance\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class Invoice extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'invoices';

    public function getKeyName(): string
    {
        return 'id';
    }
}
