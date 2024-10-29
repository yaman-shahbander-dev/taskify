<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait EnumTrait
{
    public static function getRandomName(): string
    {
        $arr = [];
        $arrDT = static::cases();

        for ($i = 0; $i < static::count(); $i++) {
            $arr[$i] = $arrDT[$i]->name;
        }
        $i = array_rand($arr, 1);
        return $arrDT[$i]->name;
    }

    public static function count(): int
    {
        return count(static::cases());
    }

    public static function getRandomValue(): mixed
    {
        $arr = [];
        $arrDT = static::cases();

        for ($i = 0; $i < static::count(); $i++) {
            $arr[$i] = $arrDT[$i]->value;
        }
        $i = array_rand($arr, 1);

        return $arrDT[$i]->value;
    }

    public static function getKeyValue(): array
    {
        $arr = [];
        $arrDT = static::cases();

        for ($i = 0; $i < static::count(); $i++) {
            $arr[$arrDT[$i]->value] = $arrDT[$i]->value;
        }
        return $arr;
    }

    public static function getHumanKeyValue(): array
    {
        $arr = [];
        $arrDT = static::cases();

        for ($i = 0; $i < static::count(); $i++) {
            $arr[$arrDT[$i]->value] = Str::title(Str::replace('_', ' ', $arrDT[$i]->value));
        }
        return $arr;
    }

    public static function getKeyTranslatedValue(string $langPath): array
    {
        $arr = [];
        $arrDT = static::cases();

        for ($i = 0; $i < static::count(); $i++) {
            $arr[$arrDT[$i]->value] = __($langPath . '.' . $arrDT[$i]->value);
        }
        return $arr;
    }

    public static function hasValue(?string $value): bool
    {
        return in_array($value, static::getValues());
    }

    public static function getValues(): array
    {
        return array_column(static::cases(), 'value');
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function is(self $enum): bool
    {
        return $this == $enum || $this->value == $enum->value;
    }
}
