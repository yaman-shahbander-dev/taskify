<?php

namespace App\Domain\Client\Projections;

use App\Support\Bases\BaseProjection;

class UserTask extends BaseProjection
{
    protected $table = 'user_tasks';

    public function getKeyName(): string
    {
        return 'id';
    }
}
