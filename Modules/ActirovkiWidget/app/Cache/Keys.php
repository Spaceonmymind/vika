<?php

namespace Modules\ActirovkiWidget\Cache;

final class Keys
{
    private const string MODULE = 'actirovki';

    public static function cities(): string
    {
        return self::MODULE . "cities";
    }

    public static function city(int $id): string
    {
        return self::MODULE . ":city:{$id}";
    }

}
