<?php

namespace App\Domain\Communication\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class Comment extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'comments';

    public function getKeyName(): string
    {
        return 'id';
    }
}
