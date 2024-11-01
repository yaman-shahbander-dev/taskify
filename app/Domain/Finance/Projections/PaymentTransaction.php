<?php

namespace App\Domain\Finance\Projections;

use App\Support\Bases\BaseProjection;

class PaymentTransaction extends BaseProjection
{
    protected $table = 'payment_transactions';

    public function getKeyName(): string
    {
        return 'id';
    }
}
