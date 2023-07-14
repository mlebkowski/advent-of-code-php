<?php
declare(strict_types=1);

namespace App\Lib\Filters;

use Closure;

final readonly class Number
{
    public static function greaterThan(int $value): Closure
    {
        return static fn (int $other) => $other > $value;
    }

    public static function greaterThanOrEqual(int $value): Closure
    {
        return static fn (int $other) => $other >= $value;
    }

    public static function lessThan(int $value): Closure
    {
        return static fn (int $other) => $other < $value;
    }
}
