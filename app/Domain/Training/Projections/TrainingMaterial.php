<?php

namespace App\Domain\Training\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class TrainingMaterial extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = "training_materials";

    public function getKeyName(): string
    {
        return 'id';
    }
}