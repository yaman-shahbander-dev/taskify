<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;

class Role extends BaseProjection
{
    protected $table = 'roles';

    public function getKeyName(): string
    {
        return 'id';
    }
}
