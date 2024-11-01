<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class SprintReview extends BaseProjection
{
    protected $table = 'sprint_reviews';

    public function getKeyName(): string
    {
        return 'id';
    }
}
