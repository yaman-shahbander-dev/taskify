<?php

namespace App\Support\Bases;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class BaseProjection extends Projection
{
    use HasFactory;
    use HasUuids;
    use HasRelationships;
}
