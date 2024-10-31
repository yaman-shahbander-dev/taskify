<?php

namespace App\Domain\Finance\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class PaymentTransaction extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'payment_transactions';

    public function getKeyName(): string
    {
        return 'id';
    }
}
