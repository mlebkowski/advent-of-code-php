<?php
declare(strict_types=1);

namespace App\Lib\Filters;

use Closure;

final readonly class Text
{
    public static function equals(string $value): Closure
    {
        return static fn (string $other) => $other === $value;
    }

    public static function in(string ...$values): Closure
    {
        return static fn (string $other) => in_array($other, $values, true);
    }
}
