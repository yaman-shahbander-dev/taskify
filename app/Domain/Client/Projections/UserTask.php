<?php

namespace App\Domain\Client\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Projections\Projection;

class UserTask extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'user_tasks';

    public function getKeyName(): string
    {
        return 'id';
    }
}
