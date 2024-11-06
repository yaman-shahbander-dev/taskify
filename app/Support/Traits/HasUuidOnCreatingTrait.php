<?php

namespace App\Support\Traits;

trait HasUuidOnCreatingTrait
{
    use GeneratesUuidTrait;

    protected static function bootUuidOnCreating(): void
    {
        static::creating(function ($model) {
            $model->generateUuidForModel($model);
        });
    }
}
