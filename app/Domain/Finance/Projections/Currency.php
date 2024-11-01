<?php

namespace App\Domain\Finance\Projections;

use App\Support\Bases\BaseProjection;

class Currency extends BaseProjection
{
    protected $table = 'currencies';

    public function getKeyName(): string
    {
        return 'id';
    }
}
