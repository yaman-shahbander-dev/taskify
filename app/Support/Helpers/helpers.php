<?php

use Illuminate\Support\Str;
use App\Support\Bases\BaseData;

if (!function_exists('formatDTO')) {
    function formatDTO(array $data, BaseData $DTOdata, ?string $key = 'id', ?string $id = null): BaseData
    {
        if (!$id) {
            $id = Str::orderedUuid()->toString();
        }

        unset($data[$key]);
        $data[$key] = $id;
        return $DTOdata::from($data);
    }
}

if (!function_exists('generateUuid')) {
    function generateUuid(): string
    {
        return Str::orderedUuid()->toString();
    }
}

