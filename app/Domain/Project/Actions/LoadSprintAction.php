<?php

namespace App\Domain\Project\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Project\Projections\Sprint;

class LoadSprintAction
{
    public function __construct(protected Sprint $sprint)
    {
    }
    public function __invoke(string $value, string $column = 'id')
    {
        $sprint = $this->sprint->query()
            ->with('tasks')
            ->where($column, $value)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        return $sprint;
    }
}
