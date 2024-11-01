<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;

class Salary extends BaseProjection
{
    protected $table = 'salaries';

    public function getKeyName(): string
    {
        return 'id';
    }
}
