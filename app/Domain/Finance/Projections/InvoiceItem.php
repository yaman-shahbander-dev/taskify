<?php

namespace App\Domain\Finance\Projections;

use App\Support\Bases\BaseProjection;

class InvoiceItem extends BaseProjection
{
    protected $table = 'invoice_items';

    public function getKeyName(): string
    {
        return 'id';
    }
}
