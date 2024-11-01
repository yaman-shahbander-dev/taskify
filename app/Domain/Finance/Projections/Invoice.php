<?php

namespace App\Domain\Finance\Projections;

use App\Support\Bases\BaseProjection;

class Invoice extends BaseProjection
{
    protected $table = 'invoices';

    public function getKeyName(): string
    {
        return 'id';
    }
}
