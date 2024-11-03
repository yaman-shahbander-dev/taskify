<?php

namespace App\Domain\Communication\Projections;

use App\Support\Bases\BaseProjection;

class Comment extends BaseProjection
{
    protected $table = 'comments';

    public function getKeyName(): string
    {
        return 'id';
    }
}
