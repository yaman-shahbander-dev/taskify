<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait GeneratesUuidTrait
{
    public function addUuid(array &$data, string $key = 'id'): string
    {
        $uuid = Str::orderedUuid()->toString();
        $data[$key] = $uuid;

        return $uuid;
    }

    public function generateUuidForModel($model): void
    {
        $keyName = $model->getKeyName();
        if (empty($model->{$keyName})) {
            $model->{$keyName} = Str::orderedUuid()->toString();
        }
    }
}
