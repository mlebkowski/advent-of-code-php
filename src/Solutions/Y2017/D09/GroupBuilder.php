<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

final class GroupBuilder
{
    public static function of(array $input): Group
    {
        return Group::of(...array_map(self::of(...), $input));
    }
}
